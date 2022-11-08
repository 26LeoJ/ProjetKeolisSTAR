<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;


class ApiDataExplore
{
	// déclaration des variables
	private $ak;
	private $base_url;
	private $clientGuzzle;


	// fonction constructeur
	public function __construct()
	{
		$this->ak = '9f1ce30a677e75644a93ff8478f0644b268058c6af98dab8c5ef9aed';
		$this->base_url = 'https://data.explore.star.fr/api/';
		$this->clientGuzzle = new Client(['base_uri' => $this->base_url]);
	}

	// fonction qui va lister tous les bus actifs de toutes les lignes
	public function getBusListApi() 
	{
		$parametres = array(
			'dataset' => 'tco-bus-vehicules-position-tr',
			'refine.etat' => 'En+ligne',
			'sort'	=> 'nomcourtligne',
            'rows' => '500'
        );
		$lstBus = $this->get('records/1.0/search//?', $parametres)['records'];

		$return = array();

		foreach ($lstBus as $bus) {
			$bus = $bus['fields'];
			$tab = array(
				'idBus' => $bus['idbus'],
				'numBus' => $bus['numerobus'],
				'etatBus' => $bus['etat'],
				'idLigne' => $bus['idligne'],
				'nomLigne' => $bus['nomcourtligne'],
				'codeSens' => $bus['sens'],
				'destination' => $bus['destination'],
				'coordonnees' => $bus['coordonnees'][0] . ', ' . $bus['coordonnees'][1],
				'ecart' => $bus['ecartsecondes'],
			);

			array_push($return, $tab);		// ==> $return[] = $tab
		}

		return $return;
	}

	// fonction qui va lister tous les bus actifs de la ligne sélectionnée
	public function getBusLigneListApi($idLigneSelected) 
	{
		$parametres = array(
			'dataset' => 'tco-bus-vehicules-position-tr',
			'refine.etat' => 'En+ligne',
			'refine.idligne' => $idLigneSelected,
			'sort'	=> 'nomcourtligne',
            'rows' => '500'
        );
		$lstBus = $this->get('records/1.0/search//?', $parametres)['records'];

		$return = array();

		foreach ($lstBus as $bus) {
			$bus = $bus['fields'];
			$tab = array(
				'idBus' => $bus['idbus'],
				'numBus' => $bus['numerobus'],
				'etatBus' => $bus['etat'],
				'idLigne' => $bus['idligne'],
				'nomLigne' => $bus['nomcourtligne'],
				'codeSens' => $bus['sens'],
				'destination' => $bus['destination'],
				'coordonnees' => $bus['coordonnees'][0] . ', ' . $bus['coordonnees'][1],
				'ecart' => $bus['ecartsecondes'],
			);

			array_push($return, $tab);		// ==> $return[] = $tab
		}

		return $return;
	}

	// fonction qui va lister toutes les lignes de bus
	public function getListLigneBusApi() 
	{
		$parametres = array(
			'dataset' => 'tco-bus-topologie-lignes-td',
			'sort'	=> 'nomcourt',
            'rows' => '200'
        );
		$lstLignes = $this->get('records/1.0/search//?', $parametres)['records'];

		$return = array();

		foreach ($lstLignes  as $ligne) {
			$ligne = $ligne['fields'];
            $return[$ligne['id']] = $ligne['nomcourt'];
        }
		return $return;
	}

	private function get($end_url, array $parametres = array())
	{
		if (!empty($parametres)) {
			foreach ($parametres as $paramNom => $paramValeur) {
				$end_url .= $paramNom . '=' . $paramValeur . '&';
			}
		}

		$end_url .= 'apikey=' . $this->ak;

		// Lister tous les bus avec GET sur API DATA EXPLORE
		$res = $this->clientGuzzle->get($end_url);

		if ($res->getStatusCode() !== 200) {
			echo $res->getStatusCode();      // >>> 200
			echo '<br>';
			echo $res->getReasonPhrase();    // >>> OK
			die();
		}

		/*echo '<pre>';
		var_dump($res);
		echo '</pre>';*/

		$body = $res->getBody();

		$return = (json_decode($body, true));

		return $return;
	}
}
