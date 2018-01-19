<?php 
include('../includes/header.php');

if($user->is_logged_in()) {
    
  if($user->isLoginSessionExpired()) {
      header('Location: ../logout.php');
  }

}

  if(!isset($_GET['id'])) {
      header('Location: ../404');
  }
?>


<body>

<div class="container-fluid">
      <div class="content-90">
<!--
      
      <img src="../../public/public/images/slider/sell.png" alt="Chicago" style="width:100%;">
-->
        <?php 
            $stmt = $dbConnection->prepare('SELECT * FROM product WHERE id = :id');
            $success = $stmt->execute(array(":id" => $_GET['id']));
            if($success) {
                echo "<div class='product-page'>";
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if($product['featImg'] != NULL) {
                    echo "<div class='featured-img'><img src='../".$product['featImg']."' alt='".$product['slug']."' /></div>";
                }

                echo "<div class='img'><img src='../".$product['img']."' alt='".$product['slug']."'/></div>";

                echo "</div>";

            } else {
                header('Location: ../404');
            }
        ?>
      </div></div>
  

<?php

  include('../includes/footer.php');
?>