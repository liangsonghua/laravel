<?php
namespace App\Util;
use App\Repositories\DoubanRepository;
use App\Repositories\ChannelRepository;
use App\Events\Broadcast;
class parserBody {

	public function __construct($type,$keyword,$body)
	{
		switch ($type) {
			case 'douban':
				$this->parserDouban($keyword,$body);
				break;
			default:
				# code...
				break;
		}
	}

	public function parserDouban($keyword, $body)
	{
		$channel = ChannelRepository::where('keyword','like',$keyword)->firstOrFail();
		$pattern  ='/<tr class=\"pl\">(.*?)<\/tr>/s';
		$p  ='/<td class=\"td\-subject\"><a class=\"\" href=\"(.*?)\" title=\"(.*?)\">(.*?)<\/a>(.*?)<td class=\"td\-time\" title=\"(.*?)\" nowrap=\"nowrap\"><span class=\"\">/s';
		preg_match_all($pattern, $body,$matches);
		foreach ($matches[0] as $key => $value) {	
			preg_match($p,$value,$res);
			if(date('Ymd',strtotime($res[5]))>=date('Ymd',time())) {
				$update = array(
						'url'=>$res[1],
						'title'=>$res[2],
						'time'=>$res[5],
						'channel_id'=>$channel->id
					);
				$daoDouban = new DoubanRepository();
				$daoDouban->fill($update);
				$daoDouban->save();
				event(new Broadcast($daoDouban));	
				
			}
		}
	}
}
?>