	<?php
	class city {
		private $conn;

		public $idcity;
		public $city_name;

		public function __construct($db) {
			$this->conn = $db;
		}


		public function read() {
			$query = 'SELECT * FROM city';
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

	}