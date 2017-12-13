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
			
			try {
				$stmt = $this->_db->prepare('SELECT emailVerify FROM user WHERE username = :username');
				$stmt->execute(array('username' => $username));

				$row = $stmt->fetch();
				
				if($row['emailVerify'] == 1) {
					$_SESSION['loggedin'] = true;
					$_SESSION['userName'] = $username;
					return true;
				} else {
					
				}

			} catch(PDOException $e) {
				echo '<p class="error">'.$e->getMessage().'</p>';
			}

		    return false;
		}		
	}
	
	#Destroy the user's current session if the user logs out
	public function logout(){
		session_destroy();
	}

	public function email_verify($email,$name,$hash) {
		$to      = $email; // Send email to our user
		$subject = 'Signup | Verification'; // Give the email a subject 
		$message = '
		 
		Thanks for signing up!
		Your account has been created, you can login with the registered credentials after verifying your account with the link below.
		 
		------------------------
		Username: '.$name.'
		Email: '.$email.'
		------------------------
		 
		Please click this link to activate your account:
		localhost:8081/skarten-ecommerce/verify.php?email='.$email.'&hash='.$hash.'
		 
		'; // Our message above including the link
							 
		$headers = 'From:noreply@skarten.com' . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers); // Send our email
	}
	
}


?>