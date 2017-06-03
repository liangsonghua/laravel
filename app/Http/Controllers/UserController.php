<?php
namespace App\Http\Controllers;
use App\Repositories\UsersRepository;
use App\Repositories\ChannelRepository;
use App\Repositories\FocusRepository;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
class UserController extends FormController
{
	
	public function __construct(UsersRepository $users) 
	{
		  $this->controller = 'User';
          $this->container = $users;
          parent::__construct();
	}

	public function index()
	{
	   $focuslist = Auth::user()->focus;
	   $data = array();
	   $focusChannel = array();
	   foreach ($focuslist as $focus) {
	   	 $channel = ChannelRepository::findOrFail($focus->channel_id);
	   	 $focusChannel[] = $channel;
	   	 $doubanlist = $channel->douban()->orderBy('time','desc')->get();
	   	  foreach ($doubanlist as $douban) {
	   	  	 $temp = array(
	   	  	 		'url'=>$douban->url,
	   	  	 		'title'=>$douban->title,
	   	  	 		'time'=>$douban->time,
	   	  	 		'keyword'=>$channel->keyword,
	   	  	 	);
	   	  	 $data[] = $temp;
	   	  }
	   }
	   return View::make('user/index', array('models' => $data,'focusChannel'=>$focusChannel));
	}

	public function addfocus(Request $Request)
	{
		  $channel = new ChannelRepository();
		  $c = $channel->where('type','like',$Request->type)->get();
		  $collects = $c->toArray();
		  $isExists = false;
		  foreach ($collects as $key => $value) {
		  	if(empty($value)) continue;
		  	 if($value['keyword']===$Request->keyword) {
		  	 	$channel_id = $value['id'];
		  	 	$isExists = true;
		  	 	continue;
		  	 }
		  }
		  $flag = false;
		  if($isExists) {
		  		$flag = true;
		  		$data['channel_id'] = $channel_id;
		  } else {
		  	$channel->fill($Request->all());
          	$flag = $channel->save();
          	$data['channel_id'] = $channel->id;
		  }
          if($flag) { 
          	 $data['user_id'] = Auth::user()->id;
          	  $focus = new FocusRepository();
          	  $focus->fill($data);
          	  $focus->save();
          }
          return redirect()->action('UserController@index');
	}


}

?>