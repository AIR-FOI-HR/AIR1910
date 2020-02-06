	<?php
	class user_event {
		private $conn;

		public $user_id;
		public $event_id;

		public function __construct($db) {
			$this->conn = $db;
		}

		public function create() {
			$query = 'INSERT INTO user_event
			SET
				user_id = :user_id,
				event_id = :event_id';

			$stmt = $this->conn->prepare($query);

			$this->user_id = htmlspecialchars(strip_tags($this->user_id));
			$this->event_id = htmlspecialchars(strip_tags($this->event_id));

			$stmt->bindParam(':user_id', $this->user_id);
			$stmt->bindParam(':event_id', $this->event_id);

			if($stmt->execute()){
				return true;
			}

			printf("Error: %S. \n", $stmt->error);
			return false;
		}
	}