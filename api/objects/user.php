<?php
class User {
  
    // database connection and table name
    private $conn;
    private $table_users = "users";
    private $password = "fderoo";
    private $table_ip = "ip";
	private $version = "1.0";
  
    // object properties
    public $id;
    public $key;
    public $ip_limit;
    public $username;
    public $plugin;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	function validVersion($version_provided) {
		if ($this->version == $version_provided) {
			return true;
		}
		return false;
	}
	
	function addUserToDatabase($user, $plugin, $ip_limit, $password_provided){
		if ($password_provided != $this->password || $ip_limit == 0) {
			return null;
		}
		$generated_key = implode( '-', str_split( substr( strtoupper( md5( time() . rand( 1000, 9999 ) ) ), 0, 20 ), 4 ) );
		$query = "INSERT INTO users (`license_key`, `ip_limit`, `username`, `plugin`) VALUES ('" . $generated_key . "', '" . $ip_limit . "', '" . $user . "', '" . $plugin . "')";
		$query = $this->conn->prepare($query);
		$query->execute();
	  return $generated_key;
	}
	
	function readLicense($license){
		$query = "SELECT * FROM " . $this->table_users . " WHERE " . $this->table_users . ".license_key='" . $license."'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	function getAssociatedIP($id) {
		$query = "SELECT ip FROM " . $this->table_ip . " JOIN " . $this->table_users . " ON ip.id=users.user_id WHERE ip.id='" . $id . "'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	function addUserIP($user_id, $ip){
		$query = "INSERT INTO " . $this->table_ip . " (id, ip) VALUES ('" . $user_id . "', '" . $ip . "')";
		$query = $this->conn->prepare($query);
		$query->execute();
		
	}
	
	function read(){
		$query = "SELECT * FROM " . $this->table_users;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}

?>