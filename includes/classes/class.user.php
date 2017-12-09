<?php

include('class.password.php');

class User extends Password{

	#Variable to Store Database Connection
    private $db;
	
	#Constructor to Initialize the User Object and Initialize the $db Variable
	function __construct($db){
		parent::__construct();
	
		$this->_db = $db;
	}

	#Check if the User has logged if the Session is set to true
	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}		
	}

	#Get the HASHED password of the user with the username = $username
	private function get_user_hash($username){	

		try {

			$stmt = $this->_db->prepare('SELECT password FROM user WHERE username = :username');
			$stmt->execute(array('username' => $username));
			
			$row = $stmt->fetch();
			return $row['password'];

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	
	# Login to the user after verifying the username and the password
	public function login($username,$password){	

		$hashed = $this->get_user_hash($username);
		
		if($this->password_verify($password,$hashed) == 1){
		    
			$_SESSION['loggedin'] = true;
			$_SESSION['userName'] = $username;
		    return true;
		}		
	}
	
	#Destroy the user's current session if the user logs out
	public function logout(){
		session_destroy();
	}
	
}


?>