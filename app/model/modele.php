<?php 

class BDD
{
	// déclaration des variables;
	private $pdo;


	// fonction qui permet de se connecter à la BDD keolivs_v1 (MySQL : serveur MariaDB)
	public function __construct()
	{
		$host='localhost';
		$dbname='keolis_v1';
		$loginBdd='root';
		$passwordBdd='';

		try
		{
			$this->pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $loginBdd, $passwordBdd);
		}

		catch(Exception $e)
		{
			die('Erreur : '. $e->getMessage());
		}
	}

	public function captureBus($busToCapture)
	{
		$newBusCapture = $this->pdo->prepare('INSERT INTO bus (idbus, etat, nomligne, codesens, destination, position, libellecapture, datecapture) 
		VALUES (:idbus, :etat, :nomligne, :codesens, :destination, :position, :libellecapture, :datecapture)' );
		$newBusCapture->bindValue(':idbus', $busToCapture['idBus'], PDO::PARAM_STR);
		$newBusCapture->bindValue(':etat', $busToCapture['etat'], PDO::PARAM_STR);
		$newBusCapture->bindValue(':nomligne', $busToCapture['nomLigne'], PDO::PARAM_STR);
		$newBusCapture->bindValue(':codesens', $busToCapture['codeSens'], PDO::PARAM_STR);
		$newBusCapture->bindValue(':destination', $busToCapture['destination'], PDO::PARAM_STR);
		$newBusCapture->bindValue(':position', $busToCapture['position'], PDO::PARAM_STR);
		$newBusCapture->bindValue(':libellecapture', $busToCapture['libelleCapture'], PDO::PARAM_STR);
		$newBusCapture->bindValue(':datecapture', $busToCapture['dateCapture'], PDO::PARAM_STR);
		$newBusCapture->execute();
	}

	// Fonction qui permet la récupération des id, libelle et date des enregistrements
	public function getListAllRecordBdd()
	{	
		$allReccord = $this->pdo->prepare('SELECT idcapture, libellecapture, datecapture 
		FROM bus ORDER BY idcapture, libellecapture, datecapture ');
		$allReccord->execute();
		$infos = $allReccord->fetchAll(PDO::FETCH_ASSOC);

		$return = array();

		foreach ($infos as $record)
		{
            $return[$record['idcapture']] = $record['libellecapture'] . ' le ' . $record['datecapture'];
		}
		return $return;
	}

	public function getAllBusRecordedBdd()
	{	
		$allBusReccorded = $this->pdo->prepare('SELECT *
		FROM bus ORDER BY idcapture, libellecapture, datecapture');
		$allBusReccorded->execute();
		$infos = $allBusReccorded->fetchAll(PDO::FETCH_ASSOC);
		return $infos;
	}

	public function getBusRecordedBdd($recordSelected)
	{	
		$busReccorded = $this->pdo->prepare('SELECT * FROM bus
		WHERE idcapture = :idcapture');
		$busReccorded->bindValue(':idcapture', $recordSelected, PDO::PARAM_STR);
		$busReccorded->execute();
		$infos = $busReccorded->fetchAll(PDO::FETCH_ASSOC);
		return $infos;
	}
	
}

?>