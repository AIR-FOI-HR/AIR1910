<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../config/Database.php';
	include_once '../models/event.php';

	$database = new Database();
	$db = $database->connect();

	$event = new event($db);

	$result = $event->read();
	$num = $result->rowCount();

	if($num > 0) {
		$event_arr = array();
		$event_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$event_item = array(
			'idevent' => $idevent,
			'title' => $title,
			'start_date' => $start_date,
			'address' => $address,
			'description' => $description,
			'capacity' => $capacity,
			'registered' => $registered,
			'creator_id' => $creator_id,
			'city_id' => $city_id,
			'event_category_id' => $event_category_id
			);

			array_push($event_arr['data'], $event_item);
		}
		$rez = json_encode($event_arr);
		$rez = trim($rez, '{"data":');
		$rez = rtrim($rez, '}');
		echo $rez;

	} else {
	echo json_encode(
		array('message' => 'Nema dogaðaja')
	);
}
