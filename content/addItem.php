<?php 
  include('../includes/header.php');

  if($user->is_logged_in()) {
      
    if($user->isLoginSessionExpired()) {
        header('Location: ../logout.php');
    }

    $stmt = $dbConnection->prepare('SELECT role FROM user WHERE username = :username');
    $stmt->execute(array(":username" => $_SESSION['userName']));
    $role = $stmt->fetch(PDO::FETCH_ASSOC);

    if($role) {
        if($role['role'] == 1) {
            header('Location: dashboard.php');
        }
    }
?>

<script>
            function showHint(str) {
                if (str.length == 0) {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "add-item-validate.php?q=" + str, true);
                    xmlhttp.send();
                }
            }

            function brands(value) {
                console.log(value);
                var xhr;
                if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) { // IE 8 and older
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
    
                var data = "value=" + value;
	
                xhr.open("POST", "../includes/get-brands.php", true); 
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
                xhr.send(data);
                xhr.onreadystatechange = display_data;

                function display_data() {
	                if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            document.getElementById("brands").innerHTML = xhr.responseText;
                        } else {
                            alert('There was a problem with the request.');
                        }
                    }
                }  

            }
</script>
<body>

<div class="container-fluid">
        <div class="content-90">
<!--
        
        <img src="../../public/public/images/slider/sell.png" alt="Chicago" style="width:100%;">
-->
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <div class="container">

                    <section class="row">

                    <h3><a href="dashboard-seller"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>  Go Back</a></h3>

                        <div class="col-sm-12" style="padding:20px;">

                            <h1 >Enter product details :</h1>
                        </div>


                    </section>

                    <section class="row">


                        <div class="col-sm-12" style="padding:20px;">

                            <p id="formp"> Name of the product </p>
                            <input  type="text" class="form-control" style="min-width:100px; padding: 20px;" placeholder="Name of the product" name="pname" required>   

                        </div>


                    </section>

                     <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                                <p id="formp">Price </p>
                              <input  type="text" class="form-control" style="min-width:100px; padding: 20px;" placeholder="$" name="price" required>   

                        </div>


                    </section>

                    <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                                <p id="formp">Discounted Price </p>
                              <input  type="text" class="form-control" style="min-width:100px; padding: 20px;" placeholder="$" name="discount">   

                        </div>


                    </section>

                    <section class="row">


                        <div class="col-sm-12" style="padding:20px;">

                            <p id="formp"> Upload Main Picture</p>
                            <input  type="file" class="" style="min-width:100px; padding: 2px;" placeholder="Upload" name="image" required>   

                        </div>


                    </section>

                    <section class="row">


                        <div class="col-sm-12" style="padding:20px;">

                            <p id="formp"> Upload Featured Picture</p>
                            <input  type="file" class="" style="min-width:100px; padding: 2px;" placeholder="Upload" name="featimg" required>   

                        </div>


                    </section>

                     <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Description</p>
                              <textarea rows="5" cols="30" class="form-control" style="min-width:100px; padding: 20px;" placeholder="Description" name="desc" required></textarea>

                        </div>


                    </section>

                    <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                            <p id="formp">Condition</p>
                            <select class="form-control" name="cond" required>
                                <?php 
                                    $stmt = $dbConnection->prepare('SELECT * FROM cond');
                                    $stmt->execute();
                                    while($cond = $stmt->fetch()) {
                                        echo "<option value=".$cond['id'].">".$cond['name']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </section>

                    <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Category</p>
                            <select class="form-control" onclick = "brands(this.value)" name="cat" required>
                                <?php
                                    $stmt = $dbConnection->prepare('SELECT * FROM cat');
                                    $stmt->execute();
                                    while($cat = $stmt->fetch()) {
                                        echo "<option value=".$cat['id'].">".$cat['catTitle']."</option>";
                                    }
                                ?>
                            </select>            
                        </div>

                    </section>

                    <section class="row">
                            
                        <div class="col-sm-12" style="padding: 20px;">
                            <p id="formp">Sub Category</p>
                            <div id="subcat">

                            </div>    
                        </div>

                    </section>


                    <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Brand</p>
                           <div id="brands">
                               <p class='red'>Please Pick a Category</p>
                            </div>                
                        </div>

                    </section>

                     <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Available quanitity</p>
                              <input  type="number" class="form-control" style="min-width:100px; padding: 20px;" name="qty" placeholder="" required>   

                        </div>

                    </section>

                    <section class="row">
                        
                        <div class="col-sm-12" style="padding: 20px;">
                            <p id="formp">Shipping Charge</p>
                                <input type="text" class="form-control" style="min-weight: 100px; padding: 20px;" name="shipping" placeholder="($)" required>
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
        </div></div>
    
<?php
  } else {
?>
    <a href="../register.php" alt="Register for an Account">Register</a><br />
    <a href="../login.php" alt="Login to your Account">Login</a><br />
<?php
  }
    include('../includes/footer.php');
?>