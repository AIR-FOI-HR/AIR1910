<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../config/Database.php';
	include_once '../models/user_event.php';

	$database = new Database();
	$db = $database->connect();

	$ue = new user_event($db);

	$ue->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

	$result = $ue->read_param();
	$num = $result->rowCount();

	if($num > 0) {
		$ue_arr = array();
		$ue_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$ue_item = array(
			'user_id' => $user_id,
			'event_id' => $event_id,
			);

			array_push($ue_arr['data'], $ue_item);
		}
		$rez = json_encode($ue_arr);
		$rez = trim($rez, '{"data":');
		$rez = rtrim($rez, '}');
		echo $rez;

	} else {
	echo json_encode(
		array('message' => 'Korisnik nije prijavio dolazak ni na jedan dogaðaj')
	);
	}



