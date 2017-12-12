<?php 
    include('includes/header.php');
?>

<?php 
    if($user->is_logged_in()) {

        try {
            $stm = $dbConnection->prepare('SELECT name,avatar,email,phone,registered,role FROM user WHERE username = :username');
            $stm->execute(array(':username' => $_SESSION['userName']));
            $userData = $stm->fetch(PDO::FETCH_ASSOC);

            if($userData['name'] == '') {
                header('Location: index.php');
            }
            ?>
            <center>
    <br />
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1">
                <p></p>
            </div>
            <div class="col-sm-10 text-center" style="">
            <div style="background-color: #fff; padding: 25px; margin: 2px auto;">
                <center>
                    <h1>Welcome, <?php echo $userData['name']; ?></h1>                
                    <img src="data:image/jpg;base64,<?php echo base64_encode(stream_get_contents($userData['avatar']))?>" alt="Avatar of <?php echo $userData['name']; ?>" style="width: 30%;"/>
                    <br />
                    <ul style="list-style-type:none">
                    <li><?php echo $userData['email']; ?></li>
                    <li><?php echo $userData['phone']; ?></li>
                    <li><?php echo $userData['registered']; ?></li>
                    <?php 
                        if($userData['role'] == 1) {
                            echo '<li><a href="content/editProfile.php">Edit Profile</a></li>';
                        } else if($userData['role'] == 0) {
                            echo '<li><a href="admin/">Administrator</a></li>';
                        }
                    ?>
                    </ul>
                </center>
                </div>
                </div>
                
            <div class="col-sm-1">
                <p></p>
            </div>
        </div>
    </div>
    </center>
    <?php
        } catch (PDOException $e) {
            $e->getMessage();
        }
?>
<?php
    }
?>

<?php
    include ('includes/footer.php');
?>

            
            
            