<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\UsersRepository;
use App\Repositories\FocusRepository;
class RolesRepository extends Model
{
	protected $table='roles';

    // protected $primaryKey = 'id';
	protected $fillable = [
        'name', 'section', 'permissions',
    ];
    protected $casts = [
        'permissions' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(UsersRepository::class, 'user_roles', 'role_id', 'user_id');
    }


    public function hasAccess($permission)
    {
        return $this->hasPermission($permission);
    }

    private function hasPermission($permission)
    {
        return isset($this->permissions[$permission]) ? $this->permissions[$permission] : false;
    }
	
}
?>