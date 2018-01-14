<?php 
  include('../includes/header.php');

  if($user->is_logged_in()) {
      $username = $_SESSION['userName'];
?>

<body>

<!--
        
        <img src="../../public/public/images/slider/sell.png" alt="Chicago" style="width:100%;">
-->
        <form action="dashboard-seller.php">
            <div class="form-group">
                <div class="container">

                    <section class="row">


                        <div class="col-sm-12" style="padding:20px;">

                            <h1 >Enter product details :</h1>
                        </div>


                    </section>

                    <section class="row">


                        <div class="col-sm-12" style="padding:20px;">

                            <p id="formp"> Name of the product </p>
                            <input  type="text" class="form-control" style="min-width:100px; padding: 20px;" placeholder="" required>   

                        </div>


                    </section>


                     <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                                <p id="formp">Price </p>
                              <input  type="text" class="form-control" style="min-width:100px; padding: 20px;" placeholder="$" required>   

                        </div>


                    </section>

                      <section class="row">


                        <div class="col-sm-12" style="padding:20px;">

                            <p id="formp"> Upload Picture</p>
                            <input  type="file" class="" style="min-width:100px; padding: 2px;" placeholder="Upload" required>   

                        </div>


                    </section>


                     <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Description</p>
                              <input  type="text" class="form-control" style="min-width:100px; padding: 20px;" placeholder="" required>   

                        </div>


                    </section>

                     <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Condition</p>
                            <select class="form-control">
                                <option>Brand new</option>
                                <option>Good</option>
                                <option>Average</option>
                                <option>Bad</option>
                                <option>Very Bad</option>
                            </select>            
                        </div>

                    </section>


                    <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Catagory</p>
                            <select class="form-control">
                                <option>Technology</option>
                                <option>Property</option>
                                <option>Service</option>
                                <option>Music</option>
                                <option>Other</option>
                            </select>            
                        </div>

                    </section>

                     <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Available quanitity</p>
                              <input  type="text" class="form-control" style="min-width:100px; padding: 20px;" placeholder="" required>   

                        </div>

                    </section>

                    <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Selling price ($)</p>
                              <input  type="text" class="form-control" style="min-width:100px; padding: 20px;" placeholder="$" required>   

                        </div>

                    </section>

                    <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Shipping Charges (Enter $0 if shipping is free)</p>
                              <input  type="text" class="form-control" style="min-width:100px; padding: 20px;" placeholder="$">   

                        </div>

                    </section>

                      <section class="row">

                        <div class="col-sm-4 text-center" style="padding:20px;">

                               <p> </p> 

                        </div>

                        <div class="col-sm-4 text-center" style="padding:20px;">

                              <input  type="submit" class="btn btn-info" style="min-width:120px; padding: 20px;" value="Post add"> 
                              <input  type="button" class="btn btn-danger" style="min-width:120px; padding: 20px;" value="Cancel">   

                        </div>
                         <div class="col-sm-4 text-center" style="padding:20px;">

                               <p> </p> 

                        </div>


                    </section>
                    
                </div>
            </div>
    </form>
        
    
<?php
  } else {
?>
    <a href="../register.php" alt="Register for an Account">Register</a><br />
    <a href="../login.php" alt="Login to your Account">Login</a><br />
<?php
  }
    include('../includes/footer.php');
?>