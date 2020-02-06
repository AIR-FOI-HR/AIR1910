<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../config/Database.php';
	include_once '../models/user.php';

	$database = new Database();
	$db = $database->connect();

	$user = new user($db);

	$result = $user->read();
	$num = $result->rowCount();

	if($num > 0) {
		$user_arr = array();
		$user_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$user_item = array(
			'iduser' => $iduser,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'password' => $password,
			'dob' => $dob,
			'photo' => $photo,
			'notifications' => $notifications,
			'language' => $language,
			'city_id' => $city_id
			);

			array_push($user_arr['data'], $user_item);
		}
		$rez = json_encode($user_arr);
		$rez = trim($rez, '{"data":');
		$rez = rtrim($rez, '}');
		echo $rez;

	} else {
	echo json_encode(
		array('message' => 'Nema korisnika')
	);
}
