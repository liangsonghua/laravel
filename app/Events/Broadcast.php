<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Contracts\Broadcasting\ShouldBrodcastNow;
use  App\Repositories\DoubanRepository;
class Broadcast implements ShouldBroadcast
{
   
    use InteractsWithSockets, SerializesModels;

    protected $douban;


    //默认队列驱动为同步队列syc
    // protected $broadcastQueue = 'database';

    public function __construct(DoubanRepository $douban)
    {
    	$this->douban = $douban;
    }

    //返回事件将要广播的频道
    public function broadcastOn() 
    {  	
    	return new PrivateChannel("douban.".$this->douban->channel_id);
    }

	// 指定广播数据,不指定则public属性都被广播
    public function broadcastWith()
    {
    	return ['title'=>$this->douban->title];
    	
    }

	 //事件的广播名称.
	public function broadcastAs()
	{
		 return 'server.douban';
	   
	}
}