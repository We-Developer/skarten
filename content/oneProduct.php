<?php
    include '../includes/header.php'
?>

<section class="row"><!--products section-->
    <div class="container"> 

      <?php
//        $query=" SELECT * FROM products ORDER BY id ASC";
//        $result=mysqli_query($connect,$query);
//
//        if(mysqli_num_rows($result)>0){
//          while ($row=mysqli_fetch_array($result)) {
//              
//          }
//        }
      ?>
               
        <div class="">
            <div class="jumbotron text-center">
<!--
              <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>"> 
                <h4> <?php echo $row[1]; ?> </h4>         
                <center>
                  <div class="" style="max-width:240px;float: center;">
                    <img src="<?php echo $row[4]; ?>" class="img-thumbnail">
                  </div>  
                </center>      
                <br>
                <p> <?php echo $row[3]; ?></p> 
                <h4>Price : $<?php echo $row[2]; ?> </h4> 
                <br>
                <button type="button" class="btn btn-success">Buy</button>

              </form>   
-->

            </div>    
        </div>
    </div>
</section>


<?php
    include '../includes/footer.php';
?>