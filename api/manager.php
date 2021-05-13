<?php
include_once '/app/api/config/database.php';
include_once '/app/api/user/read.php';
include_once '/app/api/user/add.php';
include_once '/app/api/objects/user.php';

$database = new Database();
$db = $database->getConnection();
$userObject = new User($db);

$type = $_GET['type'];

if($type == 'read') {
	error_log("blyat:".$_SERVER['HTTP_X_FORWARDED_FOR']);
	read($userObject, $_GET['license'], $_GET['version'], $_GET['plugin'], $_SERVER['HTTP_X_FORWARDED_FOR']);
} else if ($type == 'add') {
	$key = addUser($userObject, $_GET['user'], $_GET['plugin'], $_GET['ip_limit'], $_GET['password']);
	if ($key == null) {
		header('location:/index.php?status=failed');
	} else {
		header('location:/index.php?status=' . $key);
	}
}
?>
