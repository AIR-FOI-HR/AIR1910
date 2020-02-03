<?php

	header('Access-Control-Allow-Origin');
	header('Content-Type: application/json');

	include_once '../config/Database.php';
	include_once '../models/Korisnik.php';

	$database = new Database();
	$db = $database->connect();

	$korisnik = new Korisnik($db);

	$result = $korisnik->read();
	$num = $result->rowCount();

	if($num > 0) {
		$korisnici_arr = array();
		$korisnici_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$korisnik_item = array(
			'id' => $id,
			'ime' => $ime,
			'prezime' => $prezime
			);

			array_push($korisnici_arr['data'], $korisnik_item);
		}
		echo json_encode($korisnici_arr);

	} else {
	echo json_encode(
		array('message' => 'Nema korisnika')
	);
}
