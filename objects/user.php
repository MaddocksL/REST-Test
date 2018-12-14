<?php

class User
{
	//DB connection
	private $conn;

	//User attributes
	public $id;
	public $username;
	public $age;
	public $gender;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function read()
	{
		//Query for all Users
		$query = "SELECT user.ID, Username, Age, gender.Gender 
				FROM user 
				INNER JOIN gender on user.GenderID = gender.ID
				ORDER BY user.ID ASC";
		//Prepare and Run SQL
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function readSingle()
	{
		$query = "SELECT user.ID, Username, Age, gender.Gender 
				FROM user 
				INNER JOIN gender on user.GenderID = gender.ID
				WHERE user.ID = ?
				LIMIT 0,1";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1, $this->id);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		//set label on data
		$this->id = $row['ID'];
		$this->username = $row['Username'];
		$this->age = $row['Age'];
		$this->gender = $row['Gender'];
	}
}

?>