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
            
            $stm = $dbConnection->prepare('SELECT id FROM user WHERE username = :username');
            $stm->execute(array(':username' => $_SESSION['userName']));
            $userData = $stm->fetch(PDO::FETCH_ASSOC);

            ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm" style="">
                <div class="cart-content">
                    <?php 
                        $stm = $dbConnection->prepare('SELECT * FROM wishlist WHERE user_id = :userid');
                        $stm ->execute(array(
                            ':userid' => $userData['id']
                        ));
                        $wishlist = $stm->fetchAll();

                        echo "<div class='row'>";

                                    if(count($wishlist)>0) {
                                        try {
                                            echo "
                                            <div class='wishlist'>
                                                <table>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                    </tr>";
                                                    foreach($wishlist as $data) {
                                                        echo "<tr><td>".$data['title']."</td>
                                                              <td>".$data['description']."</td>
                                                              <td><a href='view-wishlist?id=".$data['id']."'>View List</a></td></tr>";
                                                    }
                                            echo "
                                                </table>
                                                <h3><a href='add-list.php' alt='create a new wishlist' class='link'>Create a List</a></h3>
                                            </div>
                                            ";
                                        } catch (PDOException $e) {
                                            echo $e->getMessage();
                                        }
                                    } else {
                                        echo "
                                            <div class='empty'>
                                                <i class='fa fa-exclamation-circle fa-5x' aria-hidden='true'></i>                            
                                                <h1>You don't have any lists!</h1>
                                                <h3><a href='add-list.php' alt='create a new wishlist' class='link'>Create a List</a></h3>
                                            </div>
                                        ";
                                    }
                                
                            echo "
                                </div>
                            <div class='row'>
                                <h1>Items of your Interest</h1>
                                ";
                                try {
                                    $stm = $dbConnection->prepare('SELECT * FROM search_history WHERE user_id = :userid ORDER BY time LIMIT 5');
                                    $stm ->execute(array(
                                        ':userid' => $userData['id']
                                    ));
                                    $productHistory = $stm->fetch(PDO::FETCH_ASSOC);
                                } catch (PDOException $e) {
                                    $e->getMessage();
                                }
                                if($productHistory) {
                                    echo " ";
                                } else {
                                    echo "
                                    <div class='empty'>
                                        <h3>No product history found!</h3>
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

            
            
            