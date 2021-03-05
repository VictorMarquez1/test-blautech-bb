<?php



class Mssql
{
	private $server;
	private $username;
	private $password;
	private $database;
	private $connection;
	
	public function __construct()
	{
		$this->server = 'localhost'; 
		$this->username = 'root';
		$this->password = 'UnoMas11##';
		$this->database = 'users';
	}
	
	public function conectar()
	{

		try {
		    return new PDO('mysql:host='.$this->server.';dbname='.$this->database, $this->username, $this->password);
		} catch (PDOException $e) {
		    print "¡Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}

	public function consultar($queryMssql)
	{
		$mbd =  $this->conectar();
		$respuesta = $mbd->prepare( $queryMssql );

		try 
		{	
			$respuesta->execute();
			$resultado = $respuesta->fetchAll();
		    return $resultado;
		} 
		catch (PDOException $e) 
		{
		    return $e->getMessage();
		}
	}

	public function changesInDB($queryMssql)
	{
		$mbd =  $this->conectar();
		$respuesta = $mbd->prepare( $queryMssql );

		try 
		{	
			
		    return $respuesta->execute();
		} 
		catch (PDOException $e) 
		{
		    return $e->getMessage();
		}
		
	}
	
} 

?>