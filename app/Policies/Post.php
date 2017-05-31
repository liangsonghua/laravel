<?php
namespace App\Policies;
class Post 
{
	protected $controllerName;

	protected $actionName;

	protected $params;

	protected $userId;


	public function __construct($class,$method,$params){
		$c = explode("\\", $class);
		// $this->controllerName = end(explode("\\", $class));
		$this->controllerName = end($c);
		$this->actionName = $method;
		$this->params = $params;
	}

	// 设置该资源所属的用户
	public function setUserId() 
	{

	}

	public function getUserId()
	{

	}
}
?>