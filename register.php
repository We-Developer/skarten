<?php
    include('includes/header.php');
?>
    <script type="text/Javascript">
        function validateForm() {
            var div = document.getElementById("error");
            var x = document.forms["reg"]["email"].value;
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (reg.test(x) == false) {
                div.innerHTML += "Invalid Email Address";
                return false;
            } else {
                div.innerHTML = "";
            }
            var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
            if(!document.forms["reg"]["password"].value.match(passw)) {
                div.innerHTML += "Invalid Password";
                return false;
            } else {
                var pwd = document.forms["reg"]["password"].value;
                if(!pwd === document.forms["reg"]["confirmPass"].value) {
                    div.innerHTML += "Password don't match";
                    return false;
                } else {
                    div.innerHTML = "";
                }
            }

        }
    </script>
    <?php
        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPass = $_POST['confirmPass'];
            
            if($confirmPass == $password) {
                echo "<h1>ADDED</h1>";
            } else {
                echo "<h3>Passwords don't match</h3>";
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