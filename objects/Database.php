<?php

require_once ("../config/GlobalConfig.php");

class Database
{
	private $db_host = DB_HOST;
	private $db_username = DB_USERNAME;
	private $db_password = DB_PASSWORD;
	private $db_name = DB_NAME;

	private $connection; 
 
	public function GetConnection()
	{
		$this->connection = null;
		 
		try
		{
			$this->connection = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);
			$this->connection->set_charset("utf8");
		}
		catch(Exception $e)
		{
			echo "Connection error: ".$e->getMessage();
		}
		 
		return $this->connection;
	}
}

?>