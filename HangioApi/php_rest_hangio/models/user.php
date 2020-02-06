	<?php
	class user {
		private $conn;

		public $iduser;
		public $first_name;
		public $last_name;
		public $email;
		public $password;
		public $dob	;
		public $photo;
		public $notifications;
		public $language;
		public $city_id;

		public function __construct($db) {
			$this->conn = $db;
		}


		public function read() {
			$query = 'SELECT * FROM user';
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function create() {
			$query = 'INSERT INTO user
			SET
				iduser = :iduser,
				first_name = :first_name,
				last_name = :last_name,
				email = :email,
				password = :password,
				dob = :dob,
				photo = :photo,
				notifications = :notifications,
				language = $language,
				city_id = :city_id';

			$stmt = $this->conn->prepare($query);

			$this->iduser = htmlspecialchars(strip_tags($this->iduser));
			$this->first_name = htmlspecialchars(strip_tags($this->first_name));
			$this->last_name = htmlspecialchars(strip_tags($this->last_name));
			$this->email = htmlspecialchars(strip_tags($this->email));
			$this->password = htmlspecialchars(strip_tags($this->password));
			$this->dob = htmlspecialchars(strip_tags($this->dob));
			$this->photo = htmlspecialchars(strip_tags($this->photo));
			$this->notifications = htmlspecialchars(strip_tags($this->notifications));
			$this->language = htmlspecialchars(strip_tags($this->language));
			$this->city_id = htmlspecialchars(strip_tags($this->city_id));

			$stmt->bindParam(':iduser', $this->iduser);
			$stmt->bindParam(':first_name', $this->first_name);
			$stmt->bindParam(':last_name', $this->last_name);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':password', $this->password);
			$stmt->bindParam(':dob', $this->dob);
			$stmt->bindParam(':photo', $this->photo);
			$stmt->bindParam(':notifications', $this->notifications);
			$stmt->bindParam(':language', $this->language);
			$stmt->bindParam(':city_id', $this->city_id);

			if($stmt->execute()){
				return true;
			}

			printf("Error: %S. \n", $stmt->error);
			return false;
		}
	}