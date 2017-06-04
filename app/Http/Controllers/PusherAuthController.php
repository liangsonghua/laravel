<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\FocusRepository;
class PusherAuthController  extends Controller {

	public function check(Request $Request)
	{
	   $pusher = \Illuminate\Support\Facades\App::make('pusher');
	   $channel = explode(".", $Request->channel_name);
	  if(Auth::user()->id === FocusRepository::findOrFail(end($channel))->user_id) {
	  	$auth = $pusher->socket_auth($Request->channel_name, $Request->socket_id);
	  	return response($auth, 200)
                  ->header('Content-Type', 'text/plain');
	  } else {
	  		return response('Forbidden', 304)->header('Content-Type', 'text/plain');
		}
	}
}