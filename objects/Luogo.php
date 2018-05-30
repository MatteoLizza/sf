<?php

class Luogo
{
	private $db;

	public $id;
	public $idRegione;
	public $nome;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function GetLuogo($id)
	{
		$query = "SELECT `luoghi`.`id`,`luoghi`.`nome`,`regioni`.`nome` as 'regione' FROM `luoghi` INNER JOIN `regioni` ON `luoghi`.`idRegione` = `regioni`.`id` WHERE `luoghi`.`id` = ".$id;

		$result = $this->db->query($query) or trigger_error($this->db->error." [$query]");

		$row = $result->fetch_array(MYSQLI_ASSOC);

		return $row;
	}

	public function GetLuoghi($idRegione)
	{
		if ($idRegione == 0)
		{
			$query = "SELECT `luoghi`.`id`,`luoghi`.`nome`,`regioni`.`nome` as 'regione' FROM `luoghi` INNER JOIN `regioni` ON `luoghi`.`idRegione` = `regioni`.`id` ORDER BY `luoghi`.`nome` ASC";
		}
		else
		{
			$query = "SELECT `luoghi`.`id`,`luoghi`.`nome`,`regioni`.`nome` as 'regione' FROM `luoghi` INNER JOIN `regioni` ON `luoghi`.`idRegione` = `regioni`.`id` WHERE `regioni`.`id` = ".$idRegione." ORDER BY `luoghi`.`nome` ASC";
		}
	 
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
		$query = "INSERT INTO `luoghi` (`id`, `idRegione`, `nome`) VALUES (NULL, ".$this->idRegione.", '".$this->nome."')";

		if ($this->db->query($query) or trigger_error($this->db->error." [$query]"))
		{
			return true;
		}
	}

	public function Update()
	{
		$query = "UPDATE `luoghi` SET `idRegione` = ".$this->idRegione.", `nome` = '".$this->nome."' WHERE `luoghi`.`id` = ".$this->id;

		if($this->db->query($query) or trigger_error($this->db->error." [$query]"))
		{
			return true;
		}
	}

	public function Delete()
	{
		$query = "DELETE FROM `luoghi` WHERE `luoghi`.`id` = ".$this->id;

		if($this->db->query($query) or trigger_error($this->db->error." [$query]"))
		{
			return true;
		}
	}
}

?>