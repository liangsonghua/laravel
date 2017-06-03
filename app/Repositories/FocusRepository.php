<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\UsersRepository;
class FocusRepository extends Model
{
	protected $table='focus';
	
	public $timestamps = false;

	 protected $fillable = [
        'user_id', 'channel_id'
    ];

    //该关注所属的用户模型
    public function user() 
    {	
         return $this->belongsTo(UsersRepository::class,'user_id');
    }
	
}
?>