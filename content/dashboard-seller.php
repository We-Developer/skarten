<?php

include('../includes/header.php');

?>

<?php 
if($user->is_logged_in()){ 
  $stmt = $dbConnection->prepare('SELECT role FROM user WHERE username = :username');
  $stmt->execute(array(':username' => $_SESSION['userName']));
  $username = $stmt->fetch(PDO::FETCH_ASSOC);
  if($username['role'] != 2) {
    header('Location: '.$row["baseDir"].'index');
  }
?>


<div class="container-fluid">
    <div class="row">
        <div class="jumbotron text-center">
          <h3>Welcome to skarten selling page</h3> 
          <p>We specialize in advertisment</p> 
          <form>
            <div class="input-group">
              <input type="email" class="form-control" size="50" placeholder="Email Address" required>
              <div class="input-group-btn">
                <button type="button" class="btn btn-danger">Subscribe</button>
              </div>
            </div>
          </form>
        </div>
    </div>

    <div class="row ">
        <div class="col-sm-2 jumbotron" style="background-color:lavender;">
            <a type="button"  class="btn btn-primary btn-block" id="yourAdd">Your add</a>
            <a type="button" href="addItem.php" class="btn btn-primary btn-block">Add new</a>
            <a type="button" class="btn btn-primary btn-block">Remove add </a>
        </div>
        <div class="col-sm-10 jumbotron" style="background-color:lavenderblush;"><?php
    
                        try {
                            $stm = $dbConnection->prepare('SELECT id FROM user WHERE username = :username');
                            $stm->execute(array(':username' => $_SESSION['userName']));
                            $userData = $stm->fetch(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo $e->getMessage();
                        }

                        try {
                            $stm = $dbConnection->prepare('SELECT * FROM product WHERE postedBy = :user_id');
                            $stm->execute(array(
                                ':user_id' => $userData['id']
                            ));
                            $allProducts = $stm->fetchAll(PDO::FETCH_ASSOC);
                            
                            echo "
                            <div class='empty'><center>";
                            
                            echo "<h2>All Products</h2><br>";
                            if(count($allProducts) > 0) {
                                echo "<center><table border='2'><tr><th>Name</th><th>Description</th><th>Price</th><th>Shipping</th><th>Quantity</th><th>Posted On</th><th>Last Edited</th><th>Category</th><th>Brand</th><th>Number Sold</th><th>Edit</th><th>Delete</th></tr>";
                                foreach($allProducts as $data) {
                                    echo "<tr>";
                                    echo "<td>".$data['name']."</td>";
                                    echo "<td>".$data['description']."</td>";
                                    echo "<td>".$data['price']."</td>";
                                    echo "<td>".$data['shipping']."</td>";
                                    echo "<td>".$data['qty']."</td>";
                                    echo "<td>".$data['posted']."</td>";
                                    echo "<td>".$data['edited']."</td>";
                                    echo "<td>".$data['cat']."</td>";
                                    echo "<td>".$data['brand']."</td>";
                                    echo "<td>".$data['sold']."</td>";
                                    echo "<td><a href='edit-product?id=".$data['id']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";
                                    echo "<td><a href='delete-product?id=".$data['id']."'><i class='fa fa-times' aria-hidden='true'></i></a></td>";
                                    echo "</tr>";
                                }
                                echo "</table></center>";
                            } else {
                                echo "<h2>No Items in List</h2><br /><h3><a href='addItem' alt='Add a Product'>Add a Product</a></h3>";
                            }

                            echo "</center></div>";
        

                        } catch (PDOException $e) {
                            echo $e;
                        }


                    ?>
        </div>
    </div>
</div>


<?php }else{
    header('Location: '.$row["baseDir"].'index');
}?>


<?php
    include ('../includes/footer.php');
?>



<script>
document.getElementById('yourAdd').addEventListener('click', function(){
    window.alert("hi");
                                                       
});    
    
    
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>
