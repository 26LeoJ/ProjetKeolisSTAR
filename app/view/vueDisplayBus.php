<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/style_tab.css" /> 
</head>

<body>
	<header>
	</header>
	<br>

	<?php

	// Afficher les erreurs à l'écran
	ini_set('display_errors', 1);

	require_once 'model/modele.php';
	require_once 'ApiDataExplore.php';

	echo '<title>Bus en circulation réseau Keolis STAR</title>';

	echo '<h1>Carte des bus en circulation</h1>';
	echo '<div class = map>';
	echo '<iframe src="https://data.explore.star.fr/explore/embed/dataset/tco-bus-vehicules-position-tr/map/?disjunctive.numerobus&disjunctive.nomcourtligne&location=11,48.09597,-1.68812&basemap=jawg.streets&static=false&datasetcard=false&scrollWheelZoom=true" width="800" height="600" frameborder="0">
		</iframe>';
	echo '</div>';

	echo "<br> <br> <br> <br>";

	$Bdd = new BDD();
	$Api = new ApiDataExplore();

	// ------------ Partie Api ------------ //

	echo '<h1>Affichage des bus en circulation</h1>';
	if (isset($busToCapture))
	{
		echo '<div class = captureMsg>';
		echo '<p class = captureMsg>La capture du bus n°' . $idBus . ' a bien été prise en compte !</p>';
		echo '</div>';
	}

	$bus_ligne_result = $Api->getListLigneBusApi();
	?>

	<fieldset>
		<p>
			<h2>Sélectionnez la ligne de bus à afficher : </h2>
			<form id="id" action="<?= "index.php?action=affichBusLigne" ?>" method="post">
				<SELECT id="idligne" name="idligne" autocomplete="off" size="1">
					<option selected>Toutes les lignes</option>
					<?php
					foreach ($bus_ligne_result as $idLigne => $nomLigne)
					{
					?>
						<option value="<?php echo $idLigne; ?>"><?php echo $nomLigne; ?></option>
					<?php } ?>
				</SELECT>				
				<input type="submit" id="submitRecord" name="submitRecord" value="Valider">
			</form>
		</p>
	</fieldset>

	<?php
				
	if ($idLigneSelected == null) {
		//echo '<h3><i>Veuillez sélectionner une ligne de bus à afficher</i><h3>';
	}
	elseif($idLigneSelected == 'Toutes les lignes')
	{
		$bus_result = $Api->getBusListApi();
		//echo 'Affichage de tous les bus en ligne !';
		echo '<p style="text-align: center;">Il y a actuellement ' . count($bus_result) . ' bus en circulation !</p>';

		echo "<table>";
			echo "<tr>";
				echo "<th>ID Bus</th>";
				echo "<th>Numéro Bus</th>";
				echo "<th>Etat</th>";
				echo "<th>ID ligne</th>";
				echo "<th>Nom ligne</th>";
				echo "<th>Code du sens </th>";
				echo "<th>Destination</th>";
				echo "<th>Coordonnées</th>";
				echo "<th>Avance/Retard</th>";
				echo "<th>Capturer position</th>";
		echo "</tr>";

		foreach ($bus_result as $bus)
		{
			echo "<tr>";

			echo "<td>";
			echo $bus['idBus'];
			echo "</td>";

			echo "<td>";
			echo $bus['numBus'];
			echo "</td>";

			echo "<td>";
			echo $bus['etatBus'];
			echo "</td>";

			echo "<td>";
			echo $bus['idLigne'];
			echo "</td>";

			echo "<td>";
			echo $bus['nomLigne'];
			echo "</td>";

			echo "<td>";
			echo $bus['codeSens'];
			echo "</td>";

			echo "<td>";
			echo $bus['destination'];
			echo "</td>";

			echo "<td>";
			echo $bus['coordonnees'];
			echo "</td>";

			echo "<td>";
			echo $bus['ecart'];
			echo "</td>";

			echo "<td>";

			date_default_timezone_set('Europe/Paris'); 
			$current_date = date('d/m/Y H:i:s');
			?>
			<span class="capture"> 
			<a href="<?php echo "index.php?action=capture&idBus=".$bus['idBus'].
			"&etat=".$bus['etatBus'].
			"&nomLigne=".$bus['nomLigne'].
			"&codeSens=".$bus['codeSens'].
			"&destination=".$bus['destination'].
			"&position=".$bus['coordonnees'].
			"&libelleCapture=".$bus['idBus']. '-L' . $bus['nomLigne'].
			"&dateCapture=". $current_date ?>">
			 
			(+)</a> </span>
			<?php
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
	} 
	else 
	{
		$bus_result = $Api->getBusLigneListApi($idLigneSelected);
		echo '<h4>Ligne sélectionnée : ' . $idLigneSelected.'</h4>';

		echo '<h4>Il y a actuellement ' . count($bus_result) . ' bus en circulation !</h4>';

		echo "<table>";
		echo "<tr>";
		echo "<th>ID Bus</th>";
		echo "<th>Numéro Bus</th>";
		echo "<th>Etat</th>";
		echo "<th>ID ligne</th>";
		echo "<th>Nom ligne</th>";
		echo "<th>Code du sens </th>";
		echo "<th>Destination</th>";
		echo "<th>Coordonnées</th>";
		echo "<th>Avance/Retard</th>";
		echo "<th>Capturer position</th>";


		echo "</tr>";


		foreach ($bus_result as $bus) {
			echo "<tr>";

			echo "<td>";
			echo $bus['idBus'];
			echo "</td>";

			echo "<td>";
			echo $bus['numBus'];
			echo "</td>";

			echo "<td>";
			echo $bus['etatBus'];
			echo "</td>";

			echo "<td>";
			echo $bus['idLigne'];
			echo "</td>";

			echo "<td>";
			echo $bus['nomLigne'];
			echo "</td>";

			echo "<td>";
			echo $bus['codeSens'];
			echo "</td>";

			echo "<td>";
			echo $bus['destination'];
			echo "</td>";

			echo "<td>";
			echo $bus['coordonnees'];
			echo "</td>";

			echo "<td>";
			echo $bus['ecart'];
			echo "</td>";

			echo "<td>";

			$datetime=date("d-m-Y H:i:s");
			?>
			<span class="capture"> 
			<a href="<?php echo "index.php?action=capture&idBus=".$bus['idBus'].
			"&etat=".$bus['etatBus'].
			"&nomLigne=".$bus['nomLigne'].
			"&codeSens=".$bus['codeSens'].
			"&destination=".$bus['destination'].
			"&position=".$bus['coordonnees'].
			"&libelleCapture=".$bus['idBus']. '-L' . $bus['nomLigne'].
			"&dateCapture=". $datetime ?>">
			 
			(+)</a> </span>
			<?php
			echo "</td>";

			echo "</tr>";
		}
		echo "</table>";
	}
	echo "<br>";




	// ------------ Partie BDD ------------ //

	echo "<br> <br> <br> <br>";

	//echo '<h1><i>Affichage des bus capturés dans la BDD</i></h1>';

	$list_all_record = $Bdd->getListAllRecordBdd();

	?>

	<fieldset>
		<p>
			<h2>Sélectionnez l'enregistrement à afficher : </h2>

			<form id="id" action="<?= "index.php?action=affichBusRegistered" ?>" method="post">
				<SELECT id="recordselect" name="recordselect" autocomplete="off" size="1">
					<option selected>Tous les enregistrements</option>
					<?php
					foreach ($list_all_record as $record => $recordDate)
					{
					?>
						<option value="<?php echo $record; ?>"><?php echo '(' . $record . ') ' . $recordDate; ?></option>
					<?php } ?>
				</SELECT>
				<input type="submit" name="submitBus" id="submitBus" value="Valider">
			</form>
		</p>
	</fieldset>

	<?php


	if ($recordSelected == null) {
		//echo '<h3><i>Veuillez sélectionner un enregistrement à afficher</i></h3>';
	}
	elseif($recordSelected == 'Tous les enregistrements')
	{
		$all_bus_recorded = $Bdd->getAllBusRecordedBdd();

		//echo '<h4>Affichage de tous les bus capturés en BDD !</h4>';

		echo '<h4>Il y a actuellement ' . count($all_bus_recorded) . ' bus capturés !</h4>';


		echo "<table>";
		echo "<tr>";
		echo "<th>ID capture</th>";
		echo "<th>ID Bus</th>";
		echo "<th>Etat</th>";
		echo "<th>Nom ligne</th>";
		echo "<th>Code du sens </th>";
		echo "<th>Destination</th>";
		echo "<th>Coordonnées</th>";
		echo "<th>Libellé capture</th>";
		echo "<th>Date capture</th>";


		echo "</tr>";


		foreach ($all_bus_recorded as $bus)
		{
			echo "<tr>";

			echo "<td>";
			echo $bus['idcapture'];
			echo "</td>";

			echo "<td>";
			echo $bus['idbus'];
			echo "</td>";

			echo "<td>";
			echo $bus['etat'];
			echo "</td>";

			echo "<td>";
			echo $bus['nomligne'];
			echo "</td>";

			echo "<td>";
			echo $bus['codesens'];
			echo "</td>";

			echo "<td>";
			echo $bus['destination'];
			echo "</td>";

			echo "<td>";
			echo $bus['position'];
			echo "</td>";

			echo "<td>";
			echo $bus['libellecapture'];
			echo "</td>";

			echo "<td>";
			echo $bus['datecapture'];
			echo "</td>";

			echo "</tr>";
		}
		echo "</table>";
	} 
	else 
	{
		$bus_recorded = $Bdd->getBusRecordedBdd($recordSelected);
		//echo 'Affichage de l"enregistrement n° ' . $recordSelected;

		echo '<br>';
		echo '<br>';

		echo "<table>";
		echo "<tr>";
		echo "<th>ID capture</th>";
		echo "<th>ID Bus</th>";
		echo "<th>Etat</th>";
		echo "<th>Nom ligne</th>";
		echo "<th>Code du sens </th>";
		echo "<th>Destination</th>";
		echo "<th>Coordonnées</th>";
		echo "<th>Libellé capture</th>";
		echo "<th>Date capture</th>";


		echo "</tr>";

			echo "<tr>";

			echo "<td>";
			echo $bus_recorded[0]['idcapture'];
			echo "</td>";

			echo "<td>";
			echo $bus_recorded[0]['idbus'];
			echo "</td>";

			echo "<td>";
			echo $bus_recorded[0]['etat'];
			echo "</td>";

			echo "<td>";
			echo $bus_recorded[0]['nomligne'];
			echo "</td>";

			echo "<td>";
			echo $bus_recorded[0]['codesens'];
			echo "</td>";

			echo "<td>";
			echo $bus_recorded[0]['destination'];
			echo "</td>";

			echo "<td>";
			echo $bus_recorded[0]['position'];
			echo "</td>";

			echo "<td>";
			echo $bus_recorded[0]['libellecapture'];
			echo "</td>";

			echo "<td>";
			echo $bus_recorded[0]['datecapture'];
			echo "</td>";

			echo "</tr>";
		
		echo "</table>";
	}
	echo "<br>";


	?>


