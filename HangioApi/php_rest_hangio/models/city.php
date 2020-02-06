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

		public function read_param() {
			$query = 'SELECT
			* from city
			WHERE
			idcity = ?
			ORDER BY idcity';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(1, $this->idcity);

			$stmt->execute();

			return $stmt;
		}

		public function read_param_name() {
			$query = 'SELECT
			city_name from city
			WHERE
			idcity = ?
			ORDER BY idcity';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(1, $this->idcity);

			$stmt->execute();

			return $stmt;
		}
	}