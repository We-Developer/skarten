<?php 
    include('../includes/header.php');

    if(!$user->is_logged_in()) {
        header ('Location: ../index.php');
    } else {
        $stmt = $dbConnection->prepare('SELECT username,password,avatar,name,email,paypal,phone,country,state,city,address,zipcode,role FROM user WHERE username = :username');
        $stmt->execute(array(
            ':username' => $_SESSION['userName']
        ));

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    if(isset($_POST['submit'])) {
        if(!($_POST['name'] === null)) {
            
            $active = 1;
            
            $avatar = $result['avatar'];
            
            if(empty($_POST['name'])) {
                $name = $result['name'];
            } else {
                $name = $_POST['name'];
            }
            
            if(empty($_POST['email'])) {
                $email = $result['email'];
            } else {
                $email = $_POST['email'];
            }
            
            if(empty($_POST['password'])) {
                $password = $result['password'];
            } else {
                $password = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);
            }

            if(empty($_POST['phone'])) {
                $phone = $result['phone'];
            } else {
                $phone = $_POST['phone'];
            }
            
            if(empty($_POST['paypal'])) {
                $paypal = $result['paypal'];
            } else {
                $paypal = $_POST['paypal'];
            }
            
            if($_POST['country'] == -1) {
                $country = $result['country'];
            } else {
                $country = $_POST['country'];
            }
            
            if(empty($_POST['address'])) {
                $address = $result['address'];
            } else {
                $address = $_POST['address'];
            }
            
            if(empty($_POST['city'])) {
                $city = $result['city'];
            } else {
                $city = $_POST['city'];
            }
            
            if(empty($_POST['state'])) {
                $state = $result['state'];
            } else {
                $state = $_POST['state'];
            }
            
            if(empty($_POST['zipcode'])) {
                $zipcode = $result['zipcode'];
            } else {
                $zipcode = $_POST['zipcode'];
            }

            if($_FILES['avatar']['size'] != 0) {
                $error = false;
                $maxsize = 10485760;
                $acceptable = array(
                    'image/jpeg',
                    'image/jpg',
                    'image/gif',
                    'image/png'
                );

                if($_FILES['avatar']['size'] > $maxsize || $_FILES['avatar']['size'] == 0) {
                    echo '<div class="error">File Size too large</div>';
                    $error = true;
                }

                if((!in_array($_FILES['avatar']['type'], $acceptable)) && (!empty($_FILES["avatar"]["type"]))) {
                    echo '<div class="error">Invalid file type. Only JPG, GIF and PNG types are accepted.</div>';
                    $error = true;
                }

                if($error != true) {
                    $avatar = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
                }

            }

            try {
                $stmt = $dbConnection->prepare('SELECT email FROM user WHERE username = :username');
                $stmt->execute(array(
                    ':username' => $_SESSION['userName']
                ));

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if($row['email'] != $email) {
                    
                    $stmt = $dbConnection->prepare('SELECT email FROM user WHERE email = :email');
                    $stmt->execute(array(
                        ':email' => $email
                    ));
                    
                    $emailRow = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if($emailRow['email'] != $email) {
                        $hash = md5( rand(0,1000) );
                        $active = 0;
                    } else {
                        $email = $result['email'];
                        echo '<div class="error">Email ID already in use</div>';
                    }
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            try {
            //update into database
                if($active == 0) {
					$stmt = $dbConnection->prepare('UPDATE user SET password = :password, hash = :hash, avatar = :avatar, name = :name, email = :email, paypal = :paypal, phone = :phone, country = :country, state = :state, city = :city, address = :address, zipcode = :zipcode, emailVerify = :emailVerify WHERE username = :username') ;
					$stmt->execute(array(
                        ':password' => $password,
						':hash' => $hash,
						':avatar' => $avatar,
                        ':name' => $name,
                        ':email' => $email,
                        ':paypal' => $paypal,
                        ':phone' => $phone,
                        ':country' => $country,
                        ':state' => $state,
                        ':city' => $city,
                        ':address' => $address,
                        ':zipcode' => $zipcode,
                        ':emailVerify' => $active,
						':username' => $_SESSION['userName']
                    ));

                    $user->email_verify($email,$_SESSION['userName'],$hash);
                } else {
                    $stmt = $dbConnection->prepare('UPDATE user SET password = :password, avatar = :avatar, name = :name, email = :email, paypal = :paypal, phone = :phone, country = :country, state = :state, city = :city, address = :address, zipcode = :zipcode WHERE username = :username');
                    $stmt->execute(array(
                        ':password' => $password,
                        ':avatar' => $avatar,
                        ':name' => $name,
                        ':email' => $email,
                        ':paypal' => $paypal,
                        ':phone' => $phone,
                        ':country' => $country,
                        ':state' => $state,
                        ':city' => $city,
                        ':address' => $address,
                        ':zipcode' => $zipcode,
                        ':username' => $_SESSION['userName']
                    ));
                }
                    $success = true;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
        }
    }


?>
<script type="text/Javascript">
    function validateForm() {
            var div = document.getElementById("error");

            var x = document.forms["update"]["email"].value;
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (reg.test(x) == false) {
                div.innerHTML = "Invalid Email Address";
                return false;
            } else {
                div.innerHTML = "";
            }

            var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
            if(!document.forms["update"]["password"].value.match(passw)) {
                div.innerHTML = "Invalid Password";
                return false;
            } else {
                
                    var pwd = document.forms["update"]["password"].value;
                    if(!pwd === document.forms["update"]["confirmPass"].value) {
                        div.innerHTML = "Password don't match";
                        return false;
                    } else {
                        div.innerHTML = "";
                    }
                
            }

            if(document.forms["update"]["state"].value == -1) {
                div.innerHTML = "Please pick a state!";
                return false;
            } else {
                div.innerHTML = "";
            }

</script>

<title>Update Profile - <?php echo $row['title']; ?></title>
<body>
    <div class="container-fluid">
        <div class="content">
            
            <form method="POST" action="" name="update" enctype="multipart/form-data" onsubmit="return validateForm()" class="data">
                
            <section class="row">
                <?php
                    if(isset($success)) {
                        if($success == true) {
                            echo "<h1>Updated</h1>";
                        }
                    }
                ?>

                <div class="col-sm-12" style="padding:20px;">
                    <h1 >Settings</h1>
                </div>
                <div class="error" id="errorForm"></div>
            </section>

            <section class="row">
                <div class="col-sm-8" style="padding:20px;">
                    <label for="image"> Avatar</label>
                    <input type="file" name="avatar"/>
                </div>
            </section>
            <section class="row">
                <div class="col-sm-6" style="padding:20px;">
                    <label for="name"> Full Name </label>
                    <input  type="text" name="name" class="form-control" style="min-width:100px; padding: 20px;" value="<?php echo $result['name'];?>">
                </div>
                <div class="col-sm-6" style="padding: 20px;">
                    <label for="email"> Email </label>
                    <input  type="text" name="email" class="form-control" style="min-width:100px; padding: 20px;" value="<?php echo $result['email'];?>">                   
                </div>
            </section>
            
            <section class="row">
                <div class="col-sm-6" style="padding:20px;">
                    <label for="password"> Password</label>
                    <input type="password" name="password" class="form-control" style="min-width: 100px; padding: 20px;" value=""/>
                </div>
                <div class="col-sm-6" style="padding:20px;">
                    <label for="confirmPass"> Confirm Password</label>
                    <input type="password" name="confirmPass" class="form-control" style="min-width: 100px; padding: 20px;" value=""/>
                </div>
            </section>
            
            <section class="row">
                <div class="col-sm-6" style="padding:20px;">
                    <label for="phone"> Phone </label>
                    <input type="text" name="phone" class="form-control" style="min-width: 100px; padding: 20px;" value="<?php echo $result['phone']; ?>">
                </div>
                <div class="col-sm-6" style="padding:20px;">
                    <label for="paypal"> Paypal Email</label>
                    <input  type="text" name="paypal" class="form-control" style="min-width:100px; padding: 20px;" value="<?php echo $result['paypal']; ?>">   
                </div>
            </section>

            <section class="row">
                <div class="col-sm-5" style="padding:20px;">
                    <label for="country"> Country</label>
                    <select name="country" class="form-control" id="country">
                        <option value="<?php echo $result['country'];?>"><?php echo $result['country'];?></option>
                    </select>   
                </div>
                
                <div class="col-sm-4" style="padding:20px;">
                    <label for="city"> City</label>
                    <input  type="text" name="city" class="form-control" style="min-width:100px; padding: 20px;" value="<?php echo $result['city']; ?>">   
                </div>
                
                <div class="col-sm-3" style="padding:20px;">
                    <label for="zipcode"> Zip Code</label>
                    <input  type="text" name="zipcode" class="form-control" style="min-width:100px; padding: 20px;" value="<?php echo $result['zipcode']; ?>">   
                </div>
            </section>

            <section class="row">
                <div class="col-sm" style="padding:20px;">
                    <label for="state"> State</label>
                    <select name="state" id="state" class="form-control"></select> 
                </div>
                <div class="col-sm" style="padding:20px;">
                    <label for="address"> Address</label>
                    <input  type="text" name="address" class="form-control" style="min-width:100px; padding: 20px;" value="<?php echo $result['address']; ?>">   
                </div>
            </section>
            <section class="row">
                <div class="col-sm-12 text-center" style="padding:20px;">
                    <input type="submit" name="submit" class="btn btn-info" style="min-width:120px; padding: 20px;" value="Update Settings">    
                </div>
                
                <script type="text/Javascript">
                    populateCountries("country", "state");
                </script>

            </section>
            </form>
          

            
        </div>    
        </div>
        
    
<?php
    include('../includes/footer.php');
?>