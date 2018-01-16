<?php 
    include('../includes/header.php');
?>

<?php 
    if($user->is_logged_in()) {

        if($user->isLoginSessionExpired()) {
            header('Location: ../logout.php');
        }

        try {
            $stm = $dbConnection->prepare('SELECT username,avatar,name,email,paypal,phone,country,state,city,address,zipcode,registered,role FROM user WHERE username = :username');
            $stm->execute(array(':username' => $_SESSION['userName']));
            $userData = $stm->fetch(PDO::FETCH_ASSOC);

            if($userData['name'] == '') {
                header('Location: ../index.php');
            }
            ?>
            <center>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm" style="">
                <div class="dashboard">
                    <div class="left">
                        <div class="profileImage" style="background: url(<?php echo $row['baseDir'];?>content/<?php echo $userData['avatar'];?>); background-size: cover;">
                        <!--<img src="data:image/jpg;base64,<?php echo base64_encode(stream_get_contents($userData['avatar']))?>" alt="Avatar of <?php echo $userData['name']; ?>" class="avatar"/>-->
                        <div class="info">
                        <h1><?php echo $userData['name']; ?></h1>
                        <ul>
                            <ul>
                                <li style="font-weight: 600">Username </li>
                                <li>: <?php echo $userData['username']; ?></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 600">Email </li>
                                <li>: <?php echo $userData['email']; ?></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 600">Contact No. </li>
                                <li>: <?php echo $userData['phone']; ?></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 600">Registered </li>
                                <li>: <?php echo $userData['registered']; ?></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 600">Country </li>
                                <li>: <?php echo $userData['country']; ?></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 600">State </li>
                                <li>: <?php echo $userData['state']; ?></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 600">City </li>
                                <li>: <?php echo $userData['city']; ?></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 600">Address </li>
                                <li>: <?php echo $userData['address']; ?></li>
                            </ul>
                            <ul>
                                <li style="font-weight: 600">Zip Code </li>
                                <li>: <?php echo $userData['zipcode']; ?></li>
                            </ul>
                        </ul>
                        </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="card">
                            <i class="fa fa-dropbox fa-5x icon" aria-hidden="true"></i>
                            <h2>Order History</h2>
                            <p>
                                All your past orders in one place
                            </p>
                        </div>
                        <a href="<?php echo $row['baseDir']; ?>content/edit-profile" alt="Edit Your Profile">
                            <div class="card">
                                <i class="fa fa-user-o fa-5x icon" aria-hidden="true"></i>
                                <h2>Edit Profile</h2>
                                <p>
                                    Change your personal details
                                </p>
                            </div>
                        </a>
                        <div class="card">
                            <i class="fa fa-map-marker fa-5x icon" aria-hidden="true"></i>
                            <h2>Your Addresses</h2>
                            <p>
                                Add and View your addresses
                            </p>
                        </div>
                        <div class="card">
                            <i class="fa fa-bell-o fa-5x icon" aria-hidden="true"></i>                        
                            <h2>Alerts</h2>
                            <p>
                                View all past alerts
                            </p>
                        </div>
                        <div class="card">
                            <i class="fa fa-history fa-5x icon" aria-hidden="true"></i>
                            <h2>History</h2>
                            <p>
                                Product search history
                            </p>
                        </div>

                        <?php
                            if($user->role() == 1) {
                        ?>
                                <a href="<?php echo $row['baseDir']; ?>content/dashboard-seller" alt="Seller Dashboard">
                                    <div class="card-small text-center">
                                        <h2>Seller</h2>
                                        <p>Seller Dashboard</p>
                                        <i class="fa fa-usd fa-2x" aria-hidden="true"></i>
                                    </div>
                                </a>
                        <?php
                            } else {
                        ?>
                                <a href="<?php echo $row['baseDir']; ?>content/dashboard-seller" alt="Become a Seller">
                                    <div class="inactive card-small text-center">
                                        <h2>Seller</h2>
                                        <p>Become a Seller</p>
                                        <i class="fa fa-usd fa-2x" aria-hidden="true"></i>
                                    </div>
                                </a>
                        <?php
                            }
                        ?>

                        <?php
                            if($user->role() == 5) {
                        ?>
                                <a href="<?php echo $row['baseDir']; ?>admin/index.php" alt="Administrator Panel">
                                    <div class="card-wide text-center">
                                        <i class="fa fa-lock fa-4x" aria-hidden="true" style="display: inline-block; width: 20%;"></i>
                                        <div style="display: inline-block; width: 70%;">
                                            <h2>Administrator</h2>
                                            <p>Access Admin Panel</p>
                                        </div>
                                    </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
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
    } else {
        header('Location: '.$row["baseDir"].'index');
    }
?>

<?php
    include ('../includes/footer.php');
?>
                
                khkhkbkkhbs

            
            
            