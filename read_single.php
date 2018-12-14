<?php
//Required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header('Content-Type: application/json');

// includes for database and objects
include_once 'config/dbh.php';
include_once 'objects/user.php';

//create Database and User object
$dbh = new DBH();
$db = $dbh->connect();

//init new object
$user = new User($db);

//Get ID input
$user->id = isset($_GET['id']) ? $_GET['id'] : die();

$user->readSingle();

//Data array of user
$user_arr=array(
	"id" => $user->id,
	"username" => $user->username,
	"age" => $user->age,
	"gender" => $user->gender
);

//JSON array
print_r(json_encode($user_arr));
?>