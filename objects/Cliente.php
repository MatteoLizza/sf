<?php

class Cliente
{
	private $db;

	public $id;
	public $idRegione;
	public $nome;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function GetClienti($idRegione)
	{
		if ($idRegione == 0)
		{
			$query = "SELECT `clienti`.`id`,`clienti`.`nome`,`regioni`.`nome` as 'regione' FROM `clienti` INNER JOIN `regioni` ON `clienti`.`idRegione` = `regioni`.`id` ORDER BY `clienti`.`nome` ASC";
		}
		else
		{
			$query = "SELECT `clienti`.`id`,`clienti`.`nome`,`regioni`.`nome` as 'regione' FROM `clienti` INNER JOIN `regioni` ON `clienti`.`idRegione` = `regioni`.`id` WHERE `regioni`.`id` = ".$idRegione." ORDER BY `clienti`.`nome` ASC";
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
		$query = "INSERT INTO `clienti` (`id`, `idRegione`, `nome`) VALUES (NULL, ".$this->idRegione.", '".$this->nome."')";

		if ($this->db->query($query) or trigger_error($this->db->error." [$query]"))
		{
			return true;
		}
	}

	public function Update()
	{
		$query = "UPDATE `clienti` SET `idRegione` = ".$this->idRegione.", `nome` = '".$this->nome."' WHERE `clienti`.`id` = ".$this->id;

		if($this->db->query($query) or trigger_error($this->db->error." [$query]"))
		{
			return true;
		}
	}

	public function Delete()
	{
		$query = "DELETE FROM `clienti` WHERE `clienti`.`id` = ".$this->id;

		if($this->db->query($query) or trigger_error($this->db->error." [$query]"))
		{
			return true;
		}
	}
}

?>