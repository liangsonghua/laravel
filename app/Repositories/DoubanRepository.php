<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
class DoubanRepository extends Model
{
	protected $table='douban';
	
	public $timestamps = false;

	protected $fillable = [
        'url', 'title', 'time','channel_id',
    ];
	
}
?>