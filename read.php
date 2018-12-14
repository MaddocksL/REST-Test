<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// includes for database and objects
include_once 'config/dbh.php';
include_once 'objects/user.php';

//create Database and User object
$dbh = new DBH();
$db = $dbh->connect();

//init new object
$user = new User($db);

//query database for users
$stmt = $user->read();
$numRows = $stmt->rowCount();

if($numRows>0){
	$user_arr = array();
	$user_arr["data"]=array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$user_data=array(
			"id" => $ID,
			"username" => $Username,
			"age" => $Age,
			"gender" => $Gender
		);

		array_push($user_arr["data"], $user_data);
	}

	echo json_encode($user_arr);

} else {
	echo json_encode(array("message" => "No Users Found."));
}
?>