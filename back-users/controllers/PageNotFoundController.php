<?php


class PageNotFoundController
{

	function __construct($params = null)
	{
		//Obtenci�n de todos los p�rametros de la URL
		$this->arrayParams = $params;
		
		if( isset($this->arrayParams['metodo']) && $this->arrayParams['metodo'] != '' )
		{
			$this->$params['metodo']();
		}
		else
		{
			$this->index();
		}
	}
	
	public function index()
	{
		require_once("views/PageNotFound/PageNotFoundView.phtml");
	}

}

$obj_PageNotFound = new PageNotFoundController($params);

?>