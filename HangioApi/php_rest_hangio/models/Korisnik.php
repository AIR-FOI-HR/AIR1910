<?php
class korisnik {
	private $conn;
	private $table = 'korisnik';

	public $id;
	public $ime;
	public $prezime;

	public function __construct($db) {
		$this->conn = $db;
	}


	public function read() {
		$query = 'SELECT * FROM korisnik';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}