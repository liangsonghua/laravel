<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\ChannelRepository;
class DoubanRepository extends Model
{
	protected $table='douban';
	
	public $timestamps = false;

	protected $fillable = [
        'url', 'title', 'time','channel_id',
    ];
	
	 public function channel() 
    {	
         return $this->belongsTo(ChannelRepository::class,'channel_id');
    }
}
?>