<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
class ProjectRepository extends Model
{
	protected $table='Project';

    // protected $primaryKey = 'id';

	public function test()
	{
		return "a";
	}

	
}
?>