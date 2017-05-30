<?php
namespace App\Http\Controllers;
use App\Repositories\UsersRepository;
use App\Http\Controllers\FormController;
class UserController extends FormController
{
	
	public function __construct(UsersRepository $users) 
	{
		  $this->controller = 'User';
          $this->container = $users;
          parent::__construct();
	}


}

?>