<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("plugins/krumo-master/class.krumo.php");

class Index
{

	private $partesUrl;
	private $params;
	private $obj;

	function __construct()
	{
		$this->partesUrl = explode("/", $_SERVER['REQUEST_URI']);
		$this->params['proyecto']=$this->partesUrl[1];
		if( strlen($this->partesUrl[2]) )
			$this->params['controlador']=explode("?", $this->partesUrl[2] )[1];
		else
			$this->params['controlador']='';
		if( isset($this->partesUrl[3]) && strlen($this->partesUrl[3]) )
		{
			$this->params['metodo']=$this->partesUrl[3];
		}
		else
		{
			$this->params['metodo']='';
		}
		
		
		//Almacenamiento de parametros
		if( isset($this->partesUrl[4]) )
		{
			for($i=4; $i<count($this->partesUrl); $i++)
			{
				$this->params['parametros'][]=$this->partesUrl[$i];
			}
		}
		
		$this->callingController();

	}


	private function callingController()
	{

		if( $this->params['controlador'] == '' ||  
			$this->params['controlador'] == NULL || 
			$this->params['controlador'] == 'Index' || 
			$this->params['controlador'] == 'index' 
		  )
		{
			require_once("controllers/IndexController.php");
			new IndexController( $this->params );
		}
		else
		{	
			if( file_exists("controllers/".$this->params['controlador']."Controller.php") )
			{
				require_once("controllers/".$this->params['controlador']."Controller.php");
				
				$this->obj = ucfirst($this->params['controlador']).'Controller';
				new $this->obj( $this->params );
			} 
			else 
			{
				require_once("controllers/PageNotFoundController.php");
				new PageNotFoundController( $this->params );
			}	
		}		

	}



}

new Index();
?>
