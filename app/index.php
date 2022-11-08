<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
require_once 'controller/controleur.php';

// attention : toutes les urls prennent index.php comme referentiel, 
//on se considere toujours dans le dossier contenant index.php

	if(isset($_GET['action'])==false)
	{
		$_GET['action']=null;
	}

	$action = $_GET['action'];

	if($action==null)
	{
		affichBusLigne();
	}

	elseif($action == 'affichBusLigne')
	{
		$idLigneSelected = isset($_POST['idligne']) ? $_POST['idligne'] : null;
		affichBusLigne($idLigneSelected);
		
	}

	elseif($action == 'capture')
	{
		captureBus($_GET['idBus'],
		$_GET['etat'],
		$_GET['nomLigne'],
		$_GET['codeSens'],
		$_GET['destination'],
		$_GET['position'],
		$_GET['libelleCapture'],
		$_GET['dateCapture']
		);
	}

	elseif($action == 'affichBusRegistered')
	{
		$recordSelected = $_POST['recordselect'];
		affichBusRegistered($recordSelected);
	}

	
?>
