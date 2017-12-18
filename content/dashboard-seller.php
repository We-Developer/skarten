<?php

include('../includes/header.php');

?>

<?php 
if($user->is_logged_in()){ ?>


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
            <a type="button"  class="btn btn-primary btn-block">Your add</a>
            <a type="button" href="addItem.php" class="btn btn-primary btn-block">Add new</a>
            <a type="button" class="btn btn-primary btn-block">Remove add </a>
        </div>
        <div class="col-sm-10 jumbotron" style="background-color:lavenderblush;">
            <?php include 'viewItems.php'?>
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
