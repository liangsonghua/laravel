<?php
namespace App\Policies;
class Post 
{
	protected $modelName;

	protected $actionName;

	protected $params;

	protected $userId;


	public function __construct($url){
		//这样判断很奇怪啊？？
		$u = explode("/", $url);
		$this->modelName = $u[3];
		if(count($u)==(int)6) {
			$this->actionName =  $u[5];
			$this->params = $u[4];
		} else {
			$this->actionName =  $u[4];
		}
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