<?php

class Regione
{
	private $db;

	public $id;
	public $nome;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function GetRegione($id)
	{
		$query = "SELECT `id`,`nome` FROM `regioni` WHERE `id` = ".$id;
	 
		$result = $this->db->query($query) or trigger_error($this->db->error." [$query]");

		$row = $result->fetch_array(MYSQLI_ASSOC);

		return $row;
	}

	public function GetRegioni()
	{
		$query = "SELECT `id`,`nome` FROM `regioni` ORDER BY `nome`";
	 
		$result = $this->db->query($query) or trigger_error($this->db->error." [$query]");

		$rows = array();
		while ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$rows[] = $row;
		}
	 
		return $rows;
	}

	public function Add()
	{
		$query = "INSERT INTO `regioni` (`id`, `nome`) VALUES (NULL, '".$this->nome."')";

		if ($this->db->query($query) or trigger_error($this->db->error." [$query]"))
		{
			return true;
		}
	}

	public function Update()
	{
		$query = "UPDATE `regioni` SET `nome` = '".$this->nome."' WHERE `regioni`.`id` = ".$this->id;

		if($this->db->query($query) or trigger_error($this->db->error." [$query]"))
		{
			return true;
		}
	}

	public function Delete()
	{
		$query = "DELETE FROM `regioni` WHERE `regioni`.`id` = ".$this->id;

		if($this->db->query($query) or trigger_error($this->db->error." [$query]"))
		{
			return true;
		}
	}
}

?>