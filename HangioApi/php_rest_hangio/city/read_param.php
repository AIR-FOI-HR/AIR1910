<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../config/Database.php';
	include_once '../models/city.php';

	$database = new Database();
	$db = $database->connect();

	$city = new city($db);

	$city->idcity = isset($_GET['idcity']) ? $_GET['idcity'] : die();

	$result = $city->read_param();
	$num = $result->rowCount();

	if($num > 0) {
		$city_arr = array();
		$city_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$city_item = array(
			'idcity' => $idcity,
			'city_name' => $city_name,
			);

			array_push($city_arr['data'], $city_item);
		}
		$rez = json_encode($city_arr);
		$rez = trim($rez, '{"data":');
		$rez = rtrim($rez, '}');
		echo $rez;

	} else {
	echo json_encode(
		array('message' => 'Ne postoji grad s tim id brojem')
	);
	}



