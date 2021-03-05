<?php
require_once("models/Users.php");
class IndexController
{

	function __construct($params = null)
	{
		$this->showUsers();
		require_once("views/Index/IndexView.phtml");
	}
	


	private function showUsers( )
	{
		$resulset = $this->getUsers();
		require_once("views/Index/IndexView.phtml");
	}
	
	private function getUsers()
	{
		$objUser = new Users();
		$listUsers = $objUser->getAllUsers();
		return $listUsers;
	}

}

?>