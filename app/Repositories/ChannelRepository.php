<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\DoubanRepository;
class ChannelRepository extends Model
{
	protected $table='channel';
	
	public $timestamps = false;

	protected $fillable = [
        'keyword', 'type',
    ];

    public function douban() 
    {
         return $this->hasMany(DoubanRepository::class,'channel_id');
    }
	
}
?>