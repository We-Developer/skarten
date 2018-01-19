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

    if(!$_GET['id']) {
        header('Location: dashboard.php');
    }

    $stmt = $dbConnection->prepare('SELECT id FROM user WHERE username =:username');
    $stmt->execute(array(":username" => $_SESSION['userName']));
    $userId = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_POST) {
        $id = $_GET['id'];
        $p_name = $_POST['pname'];     
        $p_slug = $user->create_url_slug($_POST['pname']);
        $p_desc = $_POST['desc'];
        $p_price = $_POST['price'];
        $p_cond = $_POST['conditions'];
        $p_cat = $_POST['cat'];
        $p_brand = $_POST['brand'];
        $p_qty = $_POST['qty'];
        $p_shipping = $_POST['shipping'];
        $image = "";
        
        $p_edited = date('Y-m-d H:i:s', time()); // Last Edited Time
        echo "<h1>".$p_cond;
        $stmt = $dbConnection->prepare('UPDATE product SET name = :name, slug = :slug, description = :description, img=:image, featImg = :main, price = :price, shipping = :shipping, qty = :qty, edited = :edited, cat = :cat, brand = :brand, cond = :cond WHERE id = :id');
        
        
        
        if($_FILES['image']['error']==0) {
        $imgName=$_FILES['image']['name'];
        $imgTmp=$_FILES['image']['tmp_name'];
        $imgSize=$_FILES['image']['size'];
        $imgType=$_FILES['image']['type'];
        
        $fileExt = explode('/',$imgType);
        $fileActualExt =strtolower(end($fileExt));
        
        $allowed = array('jpg','jpeg','png');
        
        if(in_array($fileActualExt,$allowed)){
            if($imgSize < 524880){
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                $image= "assets/images/uploads/".$fileNameNew;
                $fileDestination="../assets/images/uploads/".$fileNameNew;
                move_uploaded_file($imgTmp,$fileDestination);
                
                }else{
                echo 'File is too big';
                }
            }else{
                echo "Cannot upload this file type";
            }

        } else {
            echo 'There was an error uploading the image';
        }

        if(isset($_FILES["featimg"])) {
            if($_FILES['featimg']['error'] == 0) {
                $featimage = "";
                //    $image = addslashes($_FILES['image']['tmp_name']);
                //    $name = addslashes($_FILES['image']['name']);
                //    $image = file_get_contents($image);
                //    $image = base64_encode($image);
                        $imgName=$_FILES['featimg']['name'];
                        $imgTmp=$_FILES['featimg']['tmp_name'];
                        $imgSize=$_FILES['featimg']['size'];
                        $imgType=$_FILES['featimg']['type'];
                        
                        $fileExt = explode('/',$imgType);
                        $fileActualExt =strtolower(end($fileExt));
                        
                        $allowed = array('jpg','jpeg','png');
                        
                        if(in_array($fileActualExt,$allowed)){
                            if($imgSize < 524880){
                                $fileNameNew = uniqid('',true).".".$fileActualExt;
                                $featimage= "assets/images/uploads/".$fileNameNew;
                                $fileDestination="../assets/images/uploads/".$fileNameNew;
                                move_uploaded_file($imgTmp,$fileDestination);
                            } else {
                                $featimage = NULL;
                                echo 'File is too big';
                            }
                        } else {
                            $featimage = NULL;
                            echo "Cannot upload this file type";
                        }
            } else {
                $featimage = NULL;
                echo 'There was an error uploading the image';
            }
        }
        
        $sucess = $stmt->execute(array(
            ":name" => $p_name,
            ":slug" => $p_slug,
            ":description" => $p_desc,
            ":image" => $image,
            ":main" => $featimage,
            ":price" => $p_price,
            ":shipping" => $p_shipping,
            ":qty" => $p_qty,
            ":edited" => $p_edited,
            ":cat" => $p_cat,
            ":brand" => $p_brand,
            ":cond" => $p_cond,
            ":id" => $id
        ));

        if($sucess) {
            header('Location: dashboard-seller.php?view_add');
        } else {
            echo "<center><h3>Product couldn't be edited!<br />Please Try again!</h3></center>";
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
                    xmlhttp.open("GET", "test.php?q=" + str, true);
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
        
        <?php 

            $stmt = $dbConnection->prepare('SELECT postedBy FROM product WHERE id = :productId');
            $stmt->execute(array(":productId" => $_GET['id']));

            $postedBy = $stmt->fetch(PDO::FETCH_ASSOC);

            if($postedBy) {
                if(!$postedBy['postedBy'] == $userId['id']) {
                    header('Location: dashboard.php');
                }
            } else {
                header('Location: dashboard.php');
            }

        ?>

        <?php

            $stmt = $dbConnection->prepare('SELECT * FROM product WHERE id = :productId');
            $stmt->execute(array(":productId" => $_GET['id']));
            $productData = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$productData) {
                header('Location: dashboard.php');
            }

        ?>
        
        <div class="container-fluid">
            
        <div class="content-90">

        <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <div class="container">

            <section class="row">

            <h3><a href="dashboard-seller"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>  Go Back</a></h3>

                <div class="col-sm-12" style="padding:20px;">

                    <h1 >Edit Product</h1>
                </div>


            </section>

            <section class="row">


                <div class="col-sm-12" style="padding:20px;">

                    <p id="formp"> Name of the product </p>
                    <input  type="text" class="form-control" value="<?php echo $productData['name']; ?>" style="min-width:100px; padding: 20px;" placeholder="Name of the product" name="pname" required>   

                </div>


            </section>

             <section class="row">

                <div class="col-sm-12" style="padding:20px;">
                        <p id="formp">Price </p>
                      <input  type="text" class="form-control" value="<?php echo $productData['price']; ?>" style="min-width:100px; padding: 20px;" placeholder="$" name="price" required>   

                </div>


            </section>

            <section class="row">

                <div class="col-sm-12" style="padding:20px;">
                        <p id="formp">Discounted Price </p>
                      <input  type="text" class="form-control" value="<?php echo $productData['discount-price']; ?>" style="min-width:100px; padding: 20px;" placeholder="$" name="discount">   

                </div>


            </section>

            <section class="row">


                <div class="col-sm-12" style="padding:20px;">

                    <p id="formp"> Upload Main Picture</p>
                    <input  type="file" class="" value="<?php echo $productData['img']; ?>" style="min-width:100px; padding: 2px;" placeholder="Upload" name="image" required>   

                </div>


            </section>

            <section class="row">


                <div class="col-sm-12" style="padding:20px;">

                    <p id="formp"> Upload Featured Picture</p>
                    <input  type="file" class="" value="<?php echo $productData['featImg']; ?>" style="min-width:100px; padding: 2px;" placeholder="Upload" name="featimg">   

                </div>


            </section>

             <section class="row">

                <div class="col-sm-12" style="padding:20px;">
                   <p id="formp"> Description</p>
                      <textarea rows="5" cols="30" class="form-control" style="min-width:100px; padding: 20px;" placeholder="Description" name="desc" required>
                          <?php
                            echo $productData['description'];
                          ?>
                      </textarea>

                </div>


            </section>

            <section class="row">

                <div class="col-sm-12" style="padding:20px;">
                    <p id="formp">Condition</p>
                    <select class="form-control" name="conditions" required>
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
                      <input  type="number" value="<?php echo $productData['qty']; ?>" class="form-control" style="min-width:100px; padding: 20px;" name="qty" placeholder="" required>   

                </div>

            </section>

            <section class="row">
                
                <div class="col-sm-12" style="padding: 20px;">
                    <p id="formp">Shipping Charge</p>
                        <input type="text" value="<?php echo $productData['shipping']; ?>" class="form-control" style="min-weight: 100px; padding: 20px;" name="shipping" placeholder="($)" required>
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
    </div>
    </div>
        
    
<?php
  } else {
?>
    <a href="../register.php" alt="Register for an Account">Register</a><br />
    <a href="../login.php" alt="Login to your Account">Login</a><br />
<?php
  }

?>