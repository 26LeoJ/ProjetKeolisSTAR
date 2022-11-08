<?php

require_once 'model/modele.php';
require_once 'ApiDataExplore.php';

function affichBusLigne($idLigneSelected = null, $busToCapture = null, $recordSelected = null)
{
	require_once 'view/vueDisplayBus.php';
}


function captureBus($idBus, $etat, $nomLigne, $codeSens, $destination, $position, $libelleCapture, $dateCapture, $idLigneSelected = null, $recordSelected = null)
{
	$busToCapture = 
	array(
	'idBus' => $idBus,
	'etat'=> $etat,
	'nomLigne' => $nomLigne,
	'codeSens' => $codeSens,
	'destination' => $destination, 
	'position' => $position,
	'libelleCapture' => $libelleCapture, 
	'dateCapture' => $dateCapture
	 );
	$bdd = new Bdd();
	$bdd->captureBus($busToCapture);
	require_once 'view/vueDisplayBus.php';
}

function affichBusRegistered($recordSelected = null, $busToCapture = null, $idLigneSelected = null)
{
	require_once 'view/vueDisplayBus.php';
}


?>