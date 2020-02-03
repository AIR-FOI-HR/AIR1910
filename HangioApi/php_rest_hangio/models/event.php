	<?php
	class event {
		private $conn;

		public $idevent;
		public $title;
		public $start_date;
		public $address;
		public $description;
		public $capacity;
		public $registered;
		public $creator_id;
		public $city_id;
		public $event_category_id;

		public function __construct($db) {
			$this->conn = $db;
		}


		public function read() {
			$query = 'SELECT * FROM event';
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function create() {
			$query = 'INSERT INTO event
			SET
				idevent = :idevent,
				title = :title,
				start_date = :start_date,
				address = :address,
				description = :description,
				capacity = :capacity,
				registered = :registered,
				creator_id = :creator_id,
				city_id = :city_id,
				event_category_id = :event_category_id';

			$stmt = $this->conn->prepare($query);

			$this->idevent = htmlspecialchars(strip_tags($this->idevent));
			$this->title = htmlspecialchars(strip_tags($this->title));
			$this->start_date = htmlspecialchars(strip_tags($this->start_date));
			$this->address = htmlspecialchars(strip_tags($this->address));
			$this->description = htmlspecialchars(strip_tags($this->description));
			$this->capacity = htmlspecialchars(strip_tags($this->capacity));
			$this->registered = htmlspecialchars(strip_tags($this->registered));
			$this->creator_id = htmlspecialchars(strip_tags($this->creator_id));
			$this->city_id = htmlspecialchars(strip_tags($this->city_id));
			$this->event_category_id = htmlspecialchars(strip_tags($this->event_category_id));

			$stmt->bindParam(':idevent', $this->idevent);
			$stmt->bindParam(':title', $this->title);
			$stmt->bindParam(':start_date', $this->start_date);
			$stmt->bindParam(':address', $this->address);
			$stmt->bindParam(':description', $this->description);
			$stmt->bindParam(':capacity', $this->capacity);
			$stmt->bindParam(':registered', $this->registered);
			$stmt->bindParam(':creator_id', $this->creator_id);
			$stmt->bindParam(':city_id', $this->city_id);
			$stmt->bindParam(':event_category_id', $this->event_category_id);

			if($stmt->execute()){
				return true;
			}

			printf("Error: %S. \n", $stmt->error);
			return false;
		}
	}