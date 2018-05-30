<?php

//include
require_once ("../config/Database.php");
require_once ("../objects/Cliente.php");
require_once ("../objects/Regione.php");

//Connessione al database
$database = new Database();
$db = $database->GetConnection();


if (!@$request = json_decode(file_get_contents("php://input")))
{
	InvalidRequest($db, "You cannot access this API without an entitlement.");
}

//$request = json_decode($postdata);
$type = $request->type;

switch ($type)
{
	case "GetClienti":
		GetClienti($db, $db->real_escape_string($request->value));
		break;

	default:
		InvalidRequest($db, "Invalid request.");
		break;
}

/**
 * Metodo che ritorna tutte le tipologie
 * @param mysqli $db
 */
function GetClienti($db, $value)
{
	$cliente = new Cliente($db);
	echo json_encode($cliente->GetClienti($value));
}

/**
 * Metodo che restituisce il log dell'errore
 * @param mysqli $db
 * @param string $error
 */
function InvalidRequest($db, $error)
{
	$data = new stdClass();
	$data->success = false;
	$data->message = $error;

	echo json_encode($data);

	$db->close();

	header("Location: ../index.html");
}

$db->close();

?>