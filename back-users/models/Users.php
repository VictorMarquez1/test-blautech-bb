<?php

require_once("conexion/pdo.php");

class Users
{
	private $conexion_db;
	
	function __construct()
	{
		$this->conexion_db = new Mssql();
		$this->conexion_db->conectar();
	}

	public function getAllUsers()
	{
		$query = "SELECT * FROM users";
		$consulta = $this->conexion_db->consultar($query);
		return $consulta;
	}

	public function add( $values )
	{	
		$query = "INSERT INTO users (first_name, second_name, email, password) VALUES ('".$values[0]."','".$values[1]."','".$values[2]."','".$values[2]."')";

		$consulta = $this->conexion_db->changesInDB($query);
		return $consulta;
	}

	public function update( $values )
	{	
		$query = "UPDATE users SET  first_name='".$values[1]."', second_name='".$values[2]."', email='".$values[3]."', password='".$values[4]."' WHERE id=".$values[0];

		$consulta = $this->conexion_db->changesInDB($query);
		return $consulta;
	}

	public function delete( $values )
	{	

			$query = "DELETE FROM users WHERE id = ".$values[0];
			$delete = $this->conexion_db->changesInDB($query);

		return $delete;
	}

	public function getUser( $values )
	{
		$query = "SELECT * FROM users WHERE id =".$values[0];
		$consulta = $this->conexion_db->consultar($query);
		return $consulta;
	}



}
?>