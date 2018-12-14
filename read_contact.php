<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// includes for database and objects
include_once 'config/dbh.php';
include_once 'objects/contacts.php';

//create Database and Contact object
$dbh = new DBH();
$db = $dbh->connect();

//init new object
$contact = new Contact($db);

//query database for Contacts
$stmt = $contact->readContact();
$numRows = $stmt->rowCount();

if($numRows>0){
	$contact_arr = array();
	$contact_arr["data"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$contact_data=array(
			"id" => $UserID,
			"username" => $Username,
			"contact_type" => $Type,
			"contact_value" => $Value
		);

		array_push($contact_arr["data"], $contact_data);
	}

	echo json_encode($contact_arr);

} else {
	echo json_encode(array("message" => "No Contacts Found."));
}
?>