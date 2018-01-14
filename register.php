<?php
    include('includes/config.php');

    if($user->is_logged_in()) {
        if($user->isLoginSessionExpired()) {
            header('Location: logout.php');
        }
        header('Location: index.php');
    }
?>
<html lang="en">
    <head>
        <title>Register | <?php echo $row['title']; ?> | <?php echo $row['description']; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property='og:url' content="<?php echo $row['baseDir'];?>"/>
        <meta name="description" content="<?php echo $row['description'];?>"/> 
        <meta name='keywords' content="<?php echo $row['keywords'];?>"/>
        <meta name="author" content="<?php echo $row['title'];?>"/> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel='shortcut icon' href="data:image/png;base64,<?php echo base64_encode($row['favicon'])?>" type='image/x-icon'/ >
      <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/fonts.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/registerStyle.css">
        <link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <script type="text/Javascript" src="<?php echo $row['baseDir'];?>assets/country.js"></script>
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

            function usernameDB() {

                var username = document.getElementById("usernametxt").value;

                var xhr;
                if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) { // IE 8 and older
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
    
                var data = "username=" + username;
	
                xhr.open("POST", "includes/username-validate.php", true); 
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
                xhr.send(data);
                xhr.onreadystatechange = display_data;

                function display_data() {
	                if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            document.getElementById("usernameerror").innerHTML = xhr.responseText;
                        } else {
                            alert('There was a problem with the request.');
                        }
                    }
                }  

            }

            function emailDB() {

                var email = document.getElementById("emailtxt").value;

                var xhr;
                if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) { // IE 8 and older
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
    
                var data = "email=" + email;
	
                xhr.open("POST", "includes/email-validate.php", true); 
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
                xhr.send(data);
                xhr.onreadystatechange = display_data;

                function display_data() {
	                if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            document.getElementById("emailerror").innerHTML = xhr.responseText;
                        } else {
                            alert('There was a problem with the request.');
                        }
                    }
                }  

            }

        </script>
    </head>
    <body>
        <?php
            function validate_data($data) {
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
                            <a href="<?php echo $row['baseDir'];?>" alt="Skarten - <?php echo $row['description'];?>">
                                <img class="" style="width:50%; padding:15px;" src="data:image/jpeg;base64,<?php echo base64_encode( $row['logo'] )?>"/>
                            </a>    
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
                
                    <div class="formContainer">
                    
                        <h1>SIGN UP</h1> 
                            <form action="" onsubmit="return validateForm()" method="POST" name="reg">
                            <div class="error" id="error"></div>

                            <div class="formElementContainer">
                                <input name="name" type="text" class="tfLogin" placeholder="Full Name" required>   
                            </div>

                            <div class="formElementContainer">
                                <input name="email" type="text" class="tfLogin" placeholder="Email" onKeyUp='emailDB()' id='emailtxt' required>
                                <div id='emailerror' class='error'></div>
                            </div>
                    
                            <div class="formElementContainer">
                                <input name="username" type="text" class="tfLogin" placeholder="Username" onKeyUp='usernameDB()' id='usernametxt' required>
                                <div id='usernameerror' class='error'></div>
                            </div>
                    
                            <div class="formElementContainer">
                                <input name="password" type="password" class="tfLogin" placeholder="Password" required>     
                            </div>

                            <div class="formElementContainer">
                                <input name="confirmPass" type="password" class="tfLogin" placeholder="Confirm password" required>                      
                            </div>
                    
                            <div class="formElementContainer">
                                <input name="agree" type="checkbox" class="tfLogin" required>Agree to Terms and Conditions                    
                            </div>
                    
                            <div class="formElementContainer">
                                <input name="submit" type="submit" class="btn" style="" value="Sign Up"> 
                            </div>
                        
                        </form>
                    
                        <div class="formElementContainer">
                            <a href="login.php" >Already have an account? Login </a>
                        </div>

                    </div>      
                </div>

                <div class="col-sm-2 text-center">
                    <p></p>      
                </div>
            
            </div>
        
        </div>
    </body>
</html>