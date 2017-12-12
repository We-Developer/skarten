<?php
    include('includes/header.php');
?>
    <script type="text/Javascript">
        function validateForm() {
            var div = document.getElementById("error");

            var x = document.forms["reg"]["email"].value;
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (reg.test(x) == false) {
                div.innerHTML = "Invalid Email Address";
                return false;
            } else {
                div.innerHTML = "";
            }
            
            var usernamev = /^[a-zA-Z0-9]+$/;
            if(!document.forms["reg"]["username"].value.match(usernamev)) {
                div.innerHTML = "Invalid Username";
                return false;
            } else {
                div.innerHTML = "";
            }

            var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
            if(!document.forms["reg"]["password"].value.match(passw)) {
                div.innerHTML = "Invalid Password";
                return false;
            } else {
                
                    var pwd = document.forms["reg"]["password"].value;
                    if(!pwd === document.forms["reg"]["confirmPass"].value) {
                        div.innerHTML = "Password don't match";
                        return false;
                    } else {
                        div.innerHTML = "";
                    }
                
            }

        }
    </script>

    <?php
        function validate_data($data)
        {
         $data = trim($data);
         $data = stripslashes($data);
         $data = strip_tags($data);
         $data = htmlspecialchars($data);
         return $data;    
        }

        if(isset($_POST['submit'])) {

            $username = validate_data( $_POST['username'] );
            
            $stmt = $dbConnection->prepare('SELECT username FROM user WHERE username = :username');
            $stmt->execute(array('username' => $username));
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row) {
                
                $email = validate_data($_POST['email']);
                
                $stmt = $dbConnection->prepare('SELECT email FROM user WHERE email = :email');
                $stmt->execute(array('email' => $email));

                $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if(!$row1) {
                    $password = $user->password_hash(validate_data($_POST['password']), PASSWORD_BCRYPT);
                    $confirmPass = validate_data($_POST['confirmPass']);
                    $name = validate_data($_POST['name']);
                    $hash = md5( rand(0,1000) );

                    $stmt = $dbConnection->prepare('INSERT INTO user (username,password,hash,name,email,registered) VALUES (:username, :password, :hash, :name, :email,:registered)') ;
				    $stmt->execute(array(
					    ':username' => $username,
                        ':password' => $password,
                        ':hash' => $hash,
					    ':name' => $name,
					    ':email' => $email,
					    ':registered' => date('Y-m-d H:i:s')
                    ));

                    echo '<div class="success">Account Created Successfully!<br />Check email for verification link.</div>';

                    $user->email_verify($email,$username,$hash);
                    
                } else {
                    echo '<div class="error">User with Email Already exists!</div>';
                }

            } else {
                echo '<div class="error">Username Already exists!</div>';
            }
        }
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1">
                <p></p>
            </div>
            <div class="col-sm-10 text-center" style="">
                <center>
                    <div class="logoContainer">
                    <img class="" style="width:70%; padding:8px;" src="assets/images/logo2.png"/>      
                </div>
                </center>
                
                </div>
                
            <div class="col-sm-1">
                <p></p>
            </div>
        </div>
        
        <div class="row ">
            
             <div class="col-sm-2 text-center">
                
                
            </div>
            
            <div class="col-sm-8 text-center  ">
                
                <div class="loginContainer">
                    
                    <h1 >Sign Up</h1> 
                        <form action="" onsubmit="return validateForm()" method="POST" name="reg">
                        <div class="error" id="error"></div>

                        <div class="formElementContainer">
                             <input name="name" type="text" class="tfLogin" placeholder="Full Name" required>   
                        </div>

                        <div class="formElementContainer">
                             <input name="email" type="text" class="tfLogin" placeholder="Email" required>   
                        </div>
                    
                        <div class="formElementContainer">
                             <input name="username" type="text" class="tfLogin" placeholder="Username" required>   
                        </div>
                    
                        <div class="formElementContainer">
                             <input name="password" type="password" class="tfLogin" placeholder="Password" required>   
                            
                        </div>
                    
                        <div class="formElementContainer">
                             <input name="confirmPass" type="password" class="tfLogin" placeholder="Confirm password" required>                      
                        </div>
                    
                        <div class="formElementContainer">
                             <input "agree" type="checkbox" class="tfLogin" placeholder="" required> <a href="" >Agree to terms and conditions  </a>                    
                        </div>
                    
                        <div class="formElementContainer">
                            
                            <input name="submit" type="submit" class="loginBtn" style="" value="Sign Up"> 
                            
                        </div>
                        </form>
                    
                        <div class="formElementContainer">
                            
                            <a href="login.php" >Already have an account ? Login </a>
                            
                        </div>
                    
            
                             
                </div>      
            </div>
            
            
             <div class="col-sm-2 text-center">
                 <p></p>      
            </div>
        </div>
        
        
        
    </div>