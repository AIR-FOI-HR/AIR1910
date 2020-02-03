<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Rquested-With');

	include_once '../config/Database.php';
	include_once '../models/event.php';

	$database = new Database();
	$db = $database->connect();

	$event = new event($db);

	$data = json_decode(file_get_contents("php://input"));

	$event->idevent = $data->idevent;
	$event->title = $data->title;
	$event->start_date = $data->start_date;
	$event->address = $data->address;
	$event->description = $data->description;
	$event->capacity = $data->capacity;
	$event->registered = $data->registered;
	$event->creator_id = $data->creator_id;
	$event->city_id = $data->city_id;
	$event->event_category_id = $data->event_category_id;

	if($event->create()) {
		echo json_encode(
			array('message' => 'Event Created')
		);
	} else {
		echo json_encode(
		array('message' => 'Event not created')
		);
	}