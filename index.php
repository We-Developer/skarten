<?php 
    include('includes/header.php');
?>

<?php 
    if($user->is_logged_in()) {
        if($user->isLoginSessionExpired()) {
            header('Location: logout.php');
        }
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
        <div class="row">
        
            <div class="col-sm" style="width: 90%;">
                
        <?php include('includes/slider1.php'); ?>
                <div class="content">
                <!--Categories-->
                    <div id="banner">
                        <?php
                            if($user->is_logged_in()) {
                                if($user->role() != 1) {
                                    echo "<a href='".$row['baseDir']."content/dashboard-seller' alt='Access Seller Dashboard'>";
                                } else {
                                    echo "<a href='".$row['baseDir']."content/seller-register' alt='Register to become a Seller'>";
                                }
                            } else {
                                echo "<a href='".$row['baseDir']."login' alt='Login to Access'>";
                            }
                        ?>
                        <img src="assets/images/uploads/banner-img-1.jpg" alt="banner-img-1" style="width: 100%;"/>
                        <?php
                            echo "</a>";
                        ?>
                    </div>
                <!--End of Categories-->
                <!-- Featured Products-->
                <section class="index-row">
                    <div id="featured-products">
                        <h1>Featured Products</h1>
                        <?php

                        $stmt = $dbConnection->prepare('SELECT * FROM product WHERE featured = 1 ORDER BY posted LIMIT 4');
                        $stmt->execute();

                        $featured = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if($featured) {
                            $i = 0;
                            foreach($featured as $feat) {
                                if($i == 0) {
                                    echo "<div class='product-large'>";
                                } else {
                                    echo "<div class='product'>";
                                }
                                echo "<img src='".$feat['img']."'/>";
                                echo "<span id='featured-text'>Featured</span>";
                                echo "<div class='content'>";
                                echo "<a href='content/view-product?id=".$feat['id']."'>";
                                echo "<h3>".$feat['name']."</h3></a>";
                                if($feat['discount-price'] > 0) {
                                    echo "<h4 style='text-decoration: line-through;'>$".number_format($feat['price'],2)."</h4><h4>$".number_format($feat['discount-price'],2)."</h4>";
                                } else {
                                    echo "<h4>$".number_format($feat['price'],2)."</h4>";
                                }
                                if($feat['shipping'] == 0) {
                                    echo "<p class='green'> + FREE Shipping</p>";
                                } else {
                                    echo "<p> + Shipping $".number_format($feat['shipping'],2)."</p>";
                                }
                                if($feat['qty'] == 0) {
                                    echo "<span class='red small bold'>Out of Stock</span>";
                                }
                                echo "</div></div>";
                                $i++;

                            }
                            if($i >= 4) {
                                echo "<a href=''><button class=''>View More</button></a>";
                            }
                        } else {
                            echo "<h2>No Featured Products</h2>";
                        }

                        ?>
                    </div>
                </section>
                <!-- End of Featured Prodcuts -->

                <!-- Popular Products-->
                <section class="index-row">
                    <div id="popular-products">
                        <h1>Popular Products</h1>
                        <?php

                        $stmt = $dbConnection->prepare('SELECT * FROM product ORDER BY sold LIMIT 4');
                        $stmt->execute();

                        $featured = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if($featured) {
                            $i = 0;
                            foreach($featured as $feat) {
                                if($i == 0) {
                                    echo "<div class='product-large'>";
                                } else {
                                    echo "<div class='product'>";
                                }
                                echo "<img src='".$feat['img']."'/>";
                                echo "<span id='popular-text'>Popular</span>";
                                echo "<div class='content'>";
                                echo "<a href='content/view-product?id=".$feat['id']."'>";
                                echo "<h3>".$feat['name']."</h3></a>";
                                if($feat['discount-price'] > 0) {
                                    echo "<h4 style='text-decoration: line-through;'>$".number_format($feat['price'],2)."</h4><h4>$".number_format($feat['discount-price'],2)."</h4>";
                                } else {
                                    echo "<h4>$".number_format($feat['price'],2)."</h4>";
                                }
                                if($feat['shipping'] == 0) {
                                    echo "<p class='green'> + FREE Shipping</p>";
                                } else {
                                    echo "<p> + Shipping $".number_format($feat['shipping'],2)."</p>";
                                }
                                if($feat['qty'] == 0) {
                                    echo "<span class='red small bold'>Out of Stock</span>";
                                }
                                echo "</div></div>";
                                $i++;

                            }
                        } else {
                            echo "<h2>No Featured Products</h2>";
                        }

                        ?>
                    </div>
                </section>
                <!-- End of Popular Products -->
                <!-- Deals-->
                <section class="index-row">
                    <div id="deals">
                        <h1>Top Deals</h1>
                        <?php

                        $stmt = $dbConnection->prepare('SELECT * FROM product WHERE deal = 1 ORDER BY posted LIMIT 4');
                        $stmt->execute();

                        $featured = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if($featured) {
                            $i = 0;
                            foreach($featured as $feat) {
                                if($i == 0) {
                                    echo "<div class='product-large'>";
                                } else {
                                    echo "<div class='product'>";
                                }
                                echo "<img src='".$feat['img']."'/>";
                                echo "<span id='deal-text'>Top Deal</span>";
                                echo "<div class='content'>";
                                echo "<a href='content/view-product?id=".$feat['id']."'>";
                                echo "<h3>".$feat['name']."</h3></a>";
                                echo "<h4 style='text-decoration: line-through;'>$".number_format($feat['price'],2)."</h4><h4>$".number_format($feat['discount-price'],2)."</h4>";
                                if($feat['shipping'] == 0) {
                                    echo "<p class='green'> + FREE Shipping</p>";
                                } else {
                                    echo "<p> + Shipping $".number_format($feat['shipping'],2)."</p>";
                                }
                                if($feat['qty'] == 0) {
                                    echo "<span class='red small bold'>Out of Stock</span>";
                                }
                                echo "</div></div>";
                                $i++;

                            }
                        } else {
                            echo "<h2>No Featured Products</h2>";
                        }

                        ?>
                    </div>
                </section>
                <!-- End of Popular Products -->
                <!-- Viewing History-->
                <section class="index-row">
                    <div id="history">
                        <h1>Recently Viewed Products</h1>
                        <?php
                        
                        if($user->is_logged_in()) {
                            $id = $user->get_id();
                            $stmt = $dbConnection->prepare('SELECT * FROM product_history WHERE user_id = :id ORDER BY time DESC');
                            $stmt->execute(array(":id" => $id));

                            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if($products > 0) {

                                foreach($products as $product) {
                                    $stmt = $dbConnection->prepare('SELECT * FROM product WHERE id = :id');
                                    $stmt->execute(array(
                                        ":id" => $product['product_id']
                                    ));
                                    $prod = $stmt->fetch(PDO::FETCH_ASSOC);

                                    echo "<div class='product-small'>";
                                    echo "<img src='".$prod['img']."'/>";
                                    echo "<div class='content'>";
                                    echo "<a href='content/view-product?id=".$prod['id']."'>";
                                    echo "<h3>".$prod['name']."</h3></a>";
                                    if($prod['discount-price'] > 0) {
                                        echo "<h4 style='text-decoration: line-through;'>$".number_format($prod['price'],2)."</h4><h4>$".number_format($prod['discount-price'],2)."</h4>";
                                    } else {
                                        echo "<h4>$".number_format($prod['price'],2)."</h4>";
                                    }
                                    if($prod['shipping'] == 0) {
                                        echo "<p class='green'> + FREE Shipping</p>";
                                    } else {
                                        echo "<p> + Shipping $".number_format($prod['shipping'],2)."</p>";
                                    }
                                    if($prod['qty'] == 0) {
                                        echo "<span class='red small bold'>Out of Stock</span>";
                                    }
                                    echo "</div></div>";
                                }

                            } else {
                                echo "<h3>You haven't viewed any Products!</h3>";
                            }

                        } else {
                            // $stmt = $dbConnection->prepare('SELECT * FROM product_history_ip WHERE ip = :ip ORDER BY time');
                            // $stmt->execute(array(
                            //     ":ip" => $user->get_client_ip()
                            // ));
                            // $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // echo $user->get_client_ip();

                            // if($products) {

                            //     foreach($products as $product) {
                                    
                            //         $stmt = $dbConnection->prepare('SELECT * FROM product WHERE id = :id');
                            //         $stmt->execute(array(":id" => $product['product_id']));
                            //         $prod = $stmt->fetch(PDO::FETCH_ASSOC);
                            //         echo "<div class='product-small'>";
                            //         echo "<img src='".$prod['img']."'/>";
                            //         echo "</div>";
                            //     }
                            // } else {
                            //     echo "<h3You haven't viewed any Products!</h3>";
                            // }
                            echo "<h3>Please <a href='login'>Login</a> to view your Product Viewing History</h3>";
                        }

                        ?>
                    </div>
                </section>
                <!-- End of Popular Products -->
                </div>
            </div>    
            <div class="col-sm-9">
                
            </div>

        </div>
    </center>

<?php
    include ('includes/footer.php');
?>

            
            
            