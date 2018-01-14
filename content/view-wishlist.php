<?php 
    include('../includes/header.php');
?>
<?php 
    if($user->is_logged_in()) {

        if($user->isLoginSessionExpired()) {
            header('Location: ../logout.php');
        }

        ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm" style="">
                <div class="cart-content">
                    <div class="row">
                    <?php

                        if(isset($_GET['id'])) {
    
                        try {
                            $stm = $dbConnection->prepare('SELECT id FROM user WHERE username = :username');
                            $stm->execute(array(':username' => $_SESSION['userName']));
                            $userData = $stm->fetch(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo $e->getMessage();
                        }

                        try {
                            $stm = $dbConnection->prepare('SELECT * FROM wishlist_product WHERE list_id = :list_id AND user_id = :user_id');
                            $stm->execute(array(
                                ':list_id' => $_GET['id'],
                                ':user_id' => $_SESSION['userName']
                            ));
                            $listData = $stm->fetchAll(PDO::FETCH_ASSOC);
                            
                            echo "
                            <div class='empty'>";

                            if(count($listData) > 0) {
                                foreach($listData as $data) {
                                    echo "
                                    <!--Products-->
                                    
                                    ";
                                }
                            } else {
                                echo "<h1>No Items in List</h1><br /><h3><a href='all-product' alt='View all the products'>Add Items</a></h3>";
                            }

                            echo "</div>";
        

                        } catch (PDOException $e) {
                            echo $e;
                        }

                        }

                    ?>
            </div>
        </div>
    </div>
    </center>
<?php
    } else {
        header('Location: '.$row["baseDir"].'index');
    }
?>

<?php
    include ('../includes/footer.php');
?>

            
            
            