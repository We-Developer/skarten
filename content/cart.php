<?php 
    include('../includes/header.php');
?>
<script>
function submitcoupon() {

    var couponVal = document.getElementById("coupon").value;

    var xhr;
    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) { // IE 8 and older
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    var data = "coupon=" + couponVal;
	
    xhr.open("POST", "../includes/add-coupon-validate.php", true); 
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
    xhr.send(data);
    xhr.onreadystatechange = display_data;

    function display_data() {
	    if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                document.getElementById("couponerror").innerHTML = xhr.responseText;
            } else {
                alert('There was a problem with the request.');
            }
        }
    }

}

function valid() {
    document.getElementById("couponsuccess").innerHTML = "Coupon Added";
}

function invalid() {
    document.getElementById("couponerror").innerHTML = "Invalid Coupon Code";
}

function remove(id) {

    var xhr;
    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) { // IE 8 and older
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    var data = "id=" + id;
	
    xhr.open("POST", "../includes/delete-item-cart.php", true); 
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
    xhr.send(data);
    xhr.onreadystatechange = display_data;

    function display_data() {
	    if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                document.getElementById("success").innerHTML = xhr.responseText;
            } else {
                alert('There was a problem with the request.');
            }
        }
    }

}

</script>
<?php 
    if($user->is_logged_in()) {

        if($user->isLoginSessionExpired()) {
            header('Location: ../logout.php');
        }

        if(isset($_POST['addcoupon'])) {
            
            try {
                $stm = $dbConnection->prepare('SELECT coupon_id FROM user WHERE username = :username');
                $stm->execute(array(
                    ':username' => $_SESSION['userName']
                ));
                $couponId = $stm->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e;
            }

            if($couponId == NULL) { 
                try {
                    $stm = $dbConnection->prepare('SELECT id,code,active FROM coupon WHERE code = :code');
                    $stm->execute(array(':code' => $_POST['coupon']));
                    $couponData = $stm->fetch(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo $e;
                }

                if($couponData) {
                    
                    if($couponData['active'] == 1) {
                        
                        try {
                            $stm = $dbConnection->prepare('UPDATE user SET coupon_id=:coupon WHERE username=:username');
                            $stm->execute(array(
                                ':coupon' => $couponData['id'],
                                ':username' => $_SESSION['userName']
                            ));
                        } catch (PDOException $e) {
                            echo $e;
                        }

                    }

                } else {

                }
            }
        }

        try {
            $stm = $dbConnection->prepare('SELECT id,username,avatar,name,email,paypal,phone,country,state,city,address,zipcode,registered,role FROM user WHERE username = :username');
            $stm->execute(array(':username' => $_SESSION['userName']));
            $userData = $stm->fetch(PDO::FETCH_ASSOC);

            if($userData['name'] == '') {
                header('Location: ../index.php');
            }
            ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm" style="">
                <div class="cart-content">
                    <?php 
                        $stm = $dbConnection->prepare('SELECT * FROM cart WHERE user_id = :userid');
                        $stm ->execute(array(
                            ':userid' => $userData['id']
                        ));
                        $cartData = $stm->fetchAll(PDO::FETCH_ASSOC);
                        
                        $stm = $dbConnection->prepare('SELECT coupon_id FROM user WHERE username = :username');
                        $stm ->execute(array(
                            ':username' => $_SESSION['userName']
                        ));
                        $coupon = $stm->fetch(PDO::FETCH_ASSOC);

                        echo "<div class='row'>
                                <div class='left'>";

                                    if($cartData) {
                                        echo "<table>";
                                        echo "<tr><th>Name</th><th>Quantity</th><th>Price</th><th>Shipping</th><th>Total Price</th><th>Delete</th></tr>";
                                        foreach($cartData as $obj) {

                                            $stmt = $dbConnection->prepare('SELECT * FROM product WHERE id = :id');
                                            $stmt->execute(array(
                                                ":id" => $obj['product_id']
                                            ));

                                            $objData = $stmt->fetch(PDO::FETCH_ASSOC);

                                            echo "<tr><td>".$objData['name']."</td>";
                                            echo "<td>".$obj['qty']."</td>";
                                            echo "<td>".$objData['price']."</td>";
                                            echo "<td>".$objData['shipping']."</td>";
                                            echo "<td>".$obj['cost']."</td>";
                                            echo "<td><a href='' onclick='remove(".$obj['id'].")'><i class='fa fa-times' aria-hidden='true'></i></a></td></tr>";
                                        }
                                        echo "</table>";
                                    } else {
                                        echo "
                                            <div class='empty'>
                                                <i class='fa fa-exclamation-circle fa-5x' aria-hidden='true'></i>                            
                                                <h1>Your cart seems to be empty!</h1>
                                                <h3><a href='all-product.php' alt='all the products on the website'>Find Items</a></h3>
                                                <button type='button' class='btn btn-lg btn-primary' disabled>Proceed to Checkout</button>
                                            </div>
                                        ";
                                    }

                                    echo "
                                </div>";
                                
                                echo "
                                <div class='right'>
                                    <form id='addcoupon' action='' method='POST'>
                                        <h3>Add Coupon</h3>
                                        <div class='error' id='couponerror'>
                                        <!---ADD COUPON FORM ERRORS APPEAR HERE-->
                                        </div>
                                        <div class='success' id='couponsuccess'>
                                        <!---ADD COUPON FORM ERRORS APPEAR HERE-->
                                        </div>
                                        <input type='text' name='coupon' id='coupon' placeholder='Coupon Code' onKeyUp='submitcoupon()' required/>
                                        <input type='submit' value='Add Coupon' name='addcoupon' class='btn btn-info'/>
                                        ";
                                        if($coupon['coupon_id'] != null) {
                                            $stm = $dbConnection->prepare('SELECT code,value FROM coupon WHERE id = :id');
                                            $stm ->execute(array(
                                                ':id' => $coupon['coupon_id']
                                            ));
                                            $couponData = $stm->fetch(PDO::FETCH_ASSOC);
                                            echo "<p>Current Coupon: ".$couponData['code']."</p>";
                                            echo "<p>Coupon Value: ".$couponData['value']."%</p>";
                                        } else {
                                            echo "<p>Current Coupon: None</p>";
                                        }
                                echo "</form>";
                                
                            echo "
                                </div>
                            </div>
                            <div class='row'>
                                <h1>Recently Viewed Items</h1>
                                ";
                                
                                $stmt = $dbConnection->prepare('SELECT * FROM product_history WHERE user_id = :user_id ORDER BY time LIMIT 5');
                                $stmt->execute(array(":user_id" => $userData['id']));
                                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if($products) {
                                    echo "<center>";
                                    foreach($products as $product) {
                                        $stmt = $dbConnection->prepare('SELECT * FROM product WHERE id = :product_id');
                                        $stmt->execute(array(":product_id" => $product['product_id']));
                                        $prod = $stmt->fetch(PDO::FETCH_ASSOC);
                                        
                                        echo "<a href='content/view-item?id=".$prod['id']."' alt='".$prod['name']."'>";
                                        echo "<div class='product'>";
                                        echo "<img src='../".$prod['img']."' alt='".$prod['name']."'/>";
                                        echo "<h3>".$prod['name']."</h3>";
                                        
                                        echo "<h4>$".$prod['price']."</h4><p> + Shipping of $".$prod['shipping']."</p>";
                                        echo "</div></a>";
                                    }
                                    echo "</center>";
                                } else {
                                    echo "
                                    <div class='empty'>
                                        <h3>No recently viewed items found!</h3>
                                    </div>
                                ";
                                }
                            

                            echo "</div>";

                    ?>
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

            
            
            