<?php

class Contact
{
	//DB connection
	private $conn;

	//Contact attributes
	public $id;
	public $username;
	public $contact_type;
	public $contact_value;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function readContact()
	{
		//Query for all User contacts
		$query = "SELECT user_contacts.UserID, user.Username, contact_type.Type, user_contacts.Value
			FROM user_contacts
			INNER JOIN user ON user_contacts.UserID = user.ID
			INNER JOIN contact_type On user_contacts.ContactID = contact_type.ID
			ORDER BY user.ID ASC";
		//Prepare and Run SQL
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function readContactSingle()
	{
		$query = "SELECT user_contacts.UserID, user.Username, contact_type.Type, user_contacts.Value
				FROM user_contacts
				INNER JOIN user ON user_contacts.UserID = user.ID
				INNER JOIN contact_type On user_contacts.ContactID = contact_type.ID
				WHERE user.ID = ?";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1, $this->id);

		$stmt->execute();

		return $stmt;

		// $row = $stmt->fetch(PDO::FETCH_ASSOC);

		// //set label on data
		// $this->id = $row['UserID'];
		// $this->username = $row['Username'];
		// $this->contact_type = $row['Type'];
		// $this->contact_value = $row['Value'];
	}
}

?>