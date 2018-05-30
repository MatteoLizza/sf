<?php

class Referente
{
	private $db;

	public $id;
	public $idCliente;
	public $nome;
	public $cognome;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function GetReferente($id)
	{
		$query = "SELECT `referenti`.`id`,`referenti`.`nome`,`referenti`.`cognome`,GROUP_CONCAT(`telefonireferente`.`telefono` SEPARATOR '<br>') as 'telefono' FROM `referenti` INNER JOIN `telefonireferente` ON `referenti`.`id` = `telefonireferente`.`idReferente` WHERE `referenti`.`idCliente` = ".$idCliente." GROUP BY `referenti`.`id` ORDER BY `referenti`.`cognome`,`referenti`.`nome` ASC";
	}

	public function GetReferenti($idCliente)
	{
		$query = "SELECT `referenti`.`id`,`referenti`.`nome`,`referenti`.`cognome`,GROUP_CONCAT(`telefonireferente`.`telefono` SEPARATOR '<br>') as 'telefono' FROM `referenti` INNER JOIN `telefonireferente` ON `referenti`.`id` = `telefonireferente`.`idReferente` WHERE `referenti`.`idCliente` = ".$idCliente." GROUP BY `referenti`.`id` ORDER BY `referenti`.`cognome`,`referenti`.`nome` ASC";
	 
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