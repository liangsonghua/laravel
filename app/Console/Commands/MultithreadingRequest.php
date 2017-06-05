<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use App\Util\parserBody;
use App\Repositories\ChannelRepository;
class MultithreadingRequest extends Command
{

    private $counter        = 1;
    private $concurrency    = 4;  // 同时并发抓取

    // private $kewords ;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:multithreading-request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
 public function handle()
    {
        $channelCollections = ChannelRepository::all();

        // $client = new \GuzzleHttp\Client();
        // $request = new \GuzzleHttp\Psr7\Request('GET', 'https://www.douban.com/group/search?cat=1013&q=2%E5%8F%B7%E7%BA%BF&sort=time');
        // $promise = $client->sendAsync($request)->then(function ($response) {
        //     $parser =  new parserBody('douban','2号线',$response->getBody());
        // });
        // $promise->wait();

        $totalPageCount = $channelCollections->count();
        $this->concurrency = $totalPageCount/2;
        if($totalPageCount===0) {
            $this->info("数据为空");
            return ;
        }
        $client = new Client();

        $requests = function ($total) use ($client,$channelCollections) {
            foreach ($channelCollections as  $channel) {
                if($channel->type==='豆瓣') {  
                    $uri = 'https://www.douban.com/group/search?cat=1013&q='.urlencode($channel->keyword).'&sort=time';
                      yield function() use ($client, $uri) {
                        return $client->getAsync($uri, ['debug' => false]);
                     };
                } 
            }
        };

        $pool = new Pool($client, $requests($totalPageCount), [
            'concurrency' => $this->concurrency,
            'fulfilled'   => function ($response, $index) use ($channelCollections,$totalPageCount) {
                $channel = $channelCollections->get($index);
                if($channel->type==='豆瓣') {
                    $parser =  new parserBody('douban',$channel->id,$response->getBody()->getContents());
                }
                $this->countedAndCheckEnded($totalPageCount);
            },
            'rejected' => function ($reason, $index) use ($totalPageCount){
                $this->error("rejected" );
                $this->error("rejected reason: " . $reason );
                $this->countedAndCheckEnded($totalPageCount);
            },
        ]);

        // 开始发送请求
        $promise = $pool->promise();
        $promise->wait();
    }

    public function countedAndCheckEnded($totalPageCount)
    {
        if ($this->counter < $totalPageCount){
            $this->counter++;
            return;
        }
        $this->info("请求结束！");
    }
}
