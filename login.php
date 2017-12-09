
<?php
    include('includes/header.php');
    if(isset($_SESSION['loggedin'])) {
        if($_SESSION['loggedin'] == true) {
            header('Location: index.php');
        }
    }

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($user->login($username,$password)) {
            
            header('Location: index.php');
            exit;
            
        } else {
            
            #Login Error Displayed
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
                    <img class="" style="width:50%; padding:15px;" src="data:image/jpeg;base64,<?php echo base64_encode( $row['logo'] )?>"/>      
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
                    
                    <h1 >Login</h1> 
                        <form method="POST" action=""> 
                        <div class="formElementContainer">
                             <input name="username" type="text" class="tfLogin" placeholder="Username" required>   
                            
                        </div>
                    
                        <div class="formElementContainer">
                             <input name="password" type="password" class="tfLogin" placeholder="Password" required>   
                            
                        </div>
                    
                        <div class="formElementContainer">
                            
                            <input type="submit" name="submit" class="loginBtn" style="" value="Login"> 
                            
                        </div>
                    
                    
                        <div class="formElementContainer">
                            
                            <a href="register.php" >Do not have an account ? Sign Up </a>
                            
                        </div>
                        </form>
            
                             
                </div>      
            </div>
            
            
             <div class="col-sm-2 text-center">
                 <p></p>      
            </div>
        </div>
        
        
        
    </div>
    
    
      
</body>
</html> 
    