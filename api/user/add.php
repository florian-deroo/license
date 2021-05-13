<?php
function addUser($userObject, $username, $plugin, $ip_limit, $password_provided){
	$key = $userObject->addUserToDatabase($username, $plugin, $ip_limit, $password_provided);
	return $key;
}

