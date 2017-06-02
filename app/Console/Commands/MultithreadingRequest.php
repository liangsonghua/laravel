<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use App\Util\parserBody;
class MultithreadingRequest extends Command
{

    private $totalPageCount;
    private $counter        = 1;
    private $concurrency    = 2;  // 同时并发抓取

    private $kewords = ['2号线','4号线'];
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
       $client = new \GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://www.douban.com/group/search?cat=1013&q=2%E5%8F%B7%E7%BA%BF&sort=time');
        $promise = $client->sendAsync($request)->then(function ($response) {
            $parser =  new parserBody('douban','2号线',$response->getBody());
        });
        $promise->wait();

        // $this->totalPageCount = count($this->kewords);

        // $client = new Client();

        // $requests = function ($total) use ($client) {
        //     foreach ($this->kewords as $key => $keword) {

        //         $uri = 'https://www.douban.com/group/search?cat=1013&q='.urlencode($keword).'&sort=relevance';
        //          // $uri = 'https://api.github.com/users/'.$keword;
        //         yield function() use ($client, $uri) {
        //             return $client->getAsync($uri, ['debug' => false]);
        //         };
        //     }
        // };

        // $pool = new Pool($client, $requests($this->totalPageCount), [
        //     'concurrency' => $this->concurrency,
        //     'fulfilled'   => function ($response, $index){

        //         $res = json_decode($response->getBody()->getContents());
        //         var_dump($response->stream);
        //         // $this->info("请求第 $index 个请求，用户 " . $this->users[$index] . " 的 Github ID 为：" .$res->id);

        //         $this->countedAndCheckEnded();
        //     },
        //     'rejected' => function ($reason, $index){
        //         $this->error("rejected" );
        //         $this->error("rejected reason: " . $reason );
        //         $this->countedAndCheckEnded();
        //     },
        // ]);

        // // 开始发送请求
        // $promise = $pool->promise();
        // $promise->wait();
    }

    // public function countedAndCheckEnded()
    // {
    //     if ($this->counter < $this->totalPageCount){
    //         $this->counter++;
    //         return;
    //     }
    //     $this->info("请求结束！");
    // }
}
