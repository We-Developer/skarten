
<?php
    include('includes/config.php');

    $error;

    if(isset($_SESSION['loggedin'])) {
        if($_SESSION['loggedin'] == true) {
            header('Location: index');
        }
    }

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($user->login($username,$password)) {
            
            header('Location: content/dashboard.php');
            exit;
            
        } else {
            
            #Login Error Displayed
            $error = "Invalid Username or Password!";
        }
    }
?>
<html lang="em">
    <head>
        <title>Login | <?php echo $row['title']." | ".$row['description'];; ?></title>
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
    </head>
    <body>

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
            </div>
            
            <div class="row ">
                <div class="col-sm-2 text-center">
                </div>
                
                <div class="col-sm-8 text-center  ">
                    
                    <div class="formContainer">
                        
                        <h1>LOGIN</h1> 
                        
                        <form method="POST" action=""> 
                            
                            <div class="error">
                                <?php
                                    if(isset($error)) {
                                        echo $error;
                                    }
                                ?>
                            </div>
                            
                            <div class="formElementContainer">
                                <input name="username" type="text" class="tfLogin" placeholder="Username" required>   
                            </div>
                    
                            <div class="formElementContainer">
                                <input name="password" type="password" class="tfLogin" placeholder="Password" required><br><br>  
                                <a href="forgot.php">Forgot your password?</a>
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

            </div>

        </div>
        
    </body>
</html> 
    