<?php

namespace App\Listeners;

use App\Events\Broadcast;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use  App\Jobs\SendBroadcast;
class BroadCastListener
{
    /**
     * 创建事件监听器。
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 处理事件
     *
     * @param  Broadcast  $event
     * @return void
     */
    public function handle(Broadcast $event)
    {
        //分发任务
        dispatch(new SendBroadcast($event));
         // dispatch(new SendBroadcast($event)->onQueue('database'));
    }
}