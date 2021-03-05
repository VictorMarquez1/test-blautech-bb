<?php
require_once("models/Users.php");

class UsersController
{
	private $arrayParams;

	function __construct($params = null)
	{
		$this->arrayParams = $params;

		if( isset($this->arrayParams['metodo']) && 
			$this->arrayParams['metodo'] != '' )
		{
			$this->{$params['metodo']}();
		}
		else
		{
				$this->showUsers();
		}
	}
	
	public function showUsers( )
	{
		$resulset = $this->getAllUsers();
		require_once("views/Users/IndexView.phtml");
	}
	

	public function view( )
	{
		//$resulset = $this->arrayParams;
		if( isset($this->arrayParams['parametros']) )
		{
			$userData = $this->getUser( $this->arrayParams['parametros'][0] );
			$resulset = array('status'=>true,'message'=>'', 'user'=>$userData);
		}
		else
		{
			$resulset = array('status'=>false,'message'=>'El identificador de usuario no existe');
		}


		//$resulset = $userData;
		require_once("views/Users/ViewView.phtml");
	}


	public function add()
	{

		if( $_SERVER["REQUEST_METHOD"] == "POST" )
		{

			//$resulset = $this->arrayParams;
			
			if( count($this->arrayParams['parametros']) == 4 &&  
				strlen($this->arrayParams['parametros'][0]) > 0 &&
				strlen($this->arrayParams['parametros'][1]) > 0 &&
				strlen($this->arrayParams['parametros'][2]) > 0 &&
				strlen($this->arrayParams['parametros'][3]) > 0
			  )
			{
				$objUser = new Users();
				//krumo( $arrayData );
				if( $objUser->add( $this->arrayParams['parametros'] ) )
				{
					$resulset = array('status'=>true,'message'=>'Registro Guardado');
				}
				else
				{
					$resulset = array('status'=>false,'message'=>'Hubo un error al intentar guardar la información');
				}

			}
			else
			{
				$resulset = array('status'=>false,'message'=>'Todos los campos son obligatorios');
			}
			
			//$resulset = array('status'=>true,'message'=>'Registro Guardado');
		}
		else
		{
			$resulset = array('status'=>false,'message'=>'Use el método POST para esta acción');
		}

		require_once("views/Users/addView.phtml");	
	}


	public function edit()
	{


		if( $_SERVER["REQUEST_METHOD"] == "POST" )
		{
			if( count($this->arrayParams['parametros']) == 5 &&  
				strlen($this->arrayParams['parametros'][0]) > 0 &&
				strlen($this->arrayParams['parametros'][1]) > 0 &&
				strlen($this->arrayParams['parametros'][2]) > 0 &&
				strlen($this->arrayParams['parametros'][3]) > 0 &&
				strlen($this->arrayParams['parametros'][3]) > 0
			  )
			{
				$objUser = new Users();
				//krumo( $arrayData );
				if( $objUser->update( $this->arrayParams['parametros'] ) )
				{
					$resulset = array('status'=>true,'message'=>'Usuario actualizado');
				}
				else
				{
					$resulset = array('status'=>false,'message'=>'Hubo un error al intentar guardar la información');
				}
			} 
			else
			{
				$resulset = array('status'=>false,'message'=>'Todos los campos son obligatorios');
			}

		}
		else
		{
			$resulset = array('status'=>false,'message'=>'Use el método POST para esta acción');
		}


		require_once("views/Users/editView.phtml");	
	}


	public function delete()
	{
		if( $_SERVER["REQUEST_METHOD"] == "POST" )
		{
			if( isset($this->arrayParams['parametros']) )
			{
				$objUser = new Users();
				if( $objUser->delete( $this->arrayParams['parametros'] ) )
				{

					$resulset = array('status'=>true,'message'=>'Usuario eliminado');
				}
				else
				{
					$resulset = array('status'=>false,'message'=>'Hubo un error al intentar eliminar al usuario');
				}
			} 
			else
			{
				$resulset = array('status'=>false,'message'=>'No existe identificador de usuario');
			}


		}
		else
		{
			$resulset = array('status'=>false,'message'=>'Use el método POST para esta acción');
		}


		require_once("views/Users/deleteView.phtml");	
		
	}


	public function getAllUsers()
	{
		$objUser = new Users();
		$listUsers = $objUser->getAllUsers();
		return $listUsers;
	}


	public function getUser( $arrayData = null )
	{
		$objUser = new Users();
		$userData = $objUser->getUser( $arrayData );
		return $userData;
	}

}



?>