<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Rquested-With');

	include_once '../config/Database.php';
	include_once '../models/user_event.php';

	$database = new Database(); 
	$db = $database->connect();

	$user_event = new user_event($db);

	$data = json_decode(file_get_contents("php://input"));

	$user_event->user_id = $data->user_id;
	$user_event->event_id = $data->event_id;

	if($user_event->create()) {
		echo json_encode(
			array('message' => 'user_event created')
		);
	} else {
		echo json_encode(
		array('message' => 'user_event not created')
		);
	}