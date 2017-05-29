<?php
namespace App\Repositories;
use Illuminate\Support\Facades\Hash;
// use Hash;
// use Illuminate\Hashing\BcryptHasher;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Repositories\RolesRepository;
class UsersRepository extends Authenticatable
{
	protected $table='users';

	public $timestamps = false;

    // protected $Hasher;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'password', 'role','remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token'
    ];

    // protected $salt = 'pidan';

    // public function getAuthSalt()
    // {
    //     return $this->salt;
    // }

    //saving前自动调用
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password)?Hash::make($password):$password;
         // $this->attributes['password'] = md5($password.$this->getAuthSalt());
    //     $this->attributes['password'] =  bcrypt($password);
    }

    public function roles()
    {
        return $this->belongsToMany(RolesRepository::class, 'user_roles', 'user_id', 'role_id');
    }

    /**
     * Checks if User has access to $permission.
     */
    public function hasAccess($permission)
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the user belongs to role.
     */
    public function inRole($section)
    {
        return $this->roles()->where('section', $section)->count() == 1;
    }


	
}
?>