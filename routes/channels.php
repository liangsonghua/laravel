<?php
use App\Repositories\FocusRepository;
use App\Events\Broadcast;
Broadcast::channel('douban.{channel_id}', function ($user, $channel_id) {
	var_dump($user->id === FocusRepository::findOrFail($channel_id)->user_id);
    return $user->id === FocusRepository::findOrFail($channel_id)->user_id;
});
?>