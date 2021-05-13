<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

function read($user, $license, $version, $plugin, $ip) {
	if (!isset($license) || !isset($version) || !isset($plugin) || !isset($ip)) {
		http_response_code(401);
	} else {
		$stmt = $user->readLicense($license);
		$isValidVersion = $user->validVersion($version);
		$num = $stmt->rowCount();
	
		$id_user;
		$isValidPlugin = false;
		$isValidLicence = false;
		$ip_limit_user = 0;
	
		$containsIP = false;
		$ip_limit_reached = false;
		
		if($num>0){
			$isValidLicence = true;
			
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				if($plugin == $plugin) {
					$isValidPlugin = true;
				}
				$id_user = $user_id;
				$ip_limit_user = $ip_limit;
			}

			if ($isValidPlugin && $isValidLicence) {
				$associated_ip = $user->getAssociatedIP($id_user);
				$ip_amount = $associated_ip->rowCount();
				$user_ip = $ip;
				
				while ($row = $associated_ip->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					if($ip == $ip) {
						$containsIP = true;
					}
				
				}
	
				if (!$containsIP) {
					if ($ip_amount >= $ip_limit_user) {
						$ip_limit_reached = true;
					} else {
						$user->addUserIP($id_user, $user_ip);
					}
				}
			}
		}
		if (!$isValidPlugin && $isValidLicence) {
			$isValidLicence = false;
		}
		
		$product_item=array(
			"license_valid" => $isValidLicence,
			"up_to_date" => $isValidVersion,
			"ip_authorized" => $containsIP, 
			"ip_limit_reached" => $ip_limit_reached
		);
			
		http_response_code(200);
		echo json_encode($product_item);
	}
}

