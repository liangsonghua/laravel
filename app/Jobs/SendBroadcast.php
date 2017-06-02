<?php

namespace App\Jobs;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Broadcast;
class SendBroadcast implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
     
     protected $broadcast;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Broadcast $broadcast)
    {
        $this->broadcast = $broadcast;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(4);
        echo "处理队列中".date("Y-m-d H:i:s")."\n";
    }

    public function failed(Exception $exception)
    {
        var_dump($exception);
    }
}
