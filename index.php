<?php 
    include('includes/header.php');
?>

<?php 
    if($user->is_logged_in()) {

        try {
            $stm = $dbConnection->prepare('SELECT username,avatar,name,email,paypal,phone,country,state,city,address,zipcode,registered,role FROM user WHERE username = :username');
            $stm->execute(array(':username' => $_SESSION['userName']));
            $userData = $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
            ?>
            <center>
    <br />
    <br />
        <div class="row">
            <div class="col-sm" style="">
                <div class="content">
                    <div class="top-content">
                        <div class="sidebar left">
                            <h1> Categories </h1>
                            <ul>
                                <li>Phone and Accessories</li>
                                <li>Cameras and Photos</li>
                                <li>Computers and Tablets</li>
                                <li>Men's Clothing</li>
                                <li>Women's Clothing</li>
                            </ul>
                        </div>
                        <?php include('includes/slider1.php'); ?>
                    </div>
                </div> 
            </div>    
            <div class="col-sm-1">
                <p></p>
            </div>

        </div>
    </center>

<?php
    include ('includes/footer.php');
?>

            
            
            