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
        $p_cond = $_POST['cond'];
        $p_cat = $_POST['cat'];
        $p_brand = $_POST['brand'];
        $p_qty = $_POST['qty'];
        $p_shipping = $_POST['shipping'];

        $p_edited = date('Y-m-d H:i:s', time()); // Last Edited Time
        echo "<h1>".$p_cond;
        $stmt = $dbConnection->prepare('UPDATE product SET name = :name, slug = :slug, description = :description, price = :price, shipping = :shipping, qty = :qty, edited = :edited, cat = :cat, brand = :brand, cond = :cond WHERE id = :id');
        $sucess = $stmt->execute(array(
            ":name" => $p_name,
            ":slug" => $p_slug,
            ":description" => $p_desc,
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
            header('Location: view-all.php');
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
                <div class="content">

        <form action="" method="POST">
            <div class="form-group">
                <div class="container">

                    <section class="row">

                        <h3><a href="dashboard-seller">Go Back</a></h3>

                        <div class="col-sm-12" style="padding:20px;">

                            <h1 >Enter product details :</h1>
                        </div>


                    </section>

                    <section class="row">


                        <div class="col-sm-12" style="padding:20px;">

                            <p id="formp"> Name of the product </p>
                            <input  type="text" class="form-control" value="<?php echo $productData['name']; ?>" style="min-width:100px; padding: 20px;" placeholder="Name of the product" name="pname" required>   

                        </div>


                    </section>

                    <section class="row">

                        <div class="col-sm-12" style="padding: 20px;">

                            <p id="formp"> Slug (Example: iphone-10-new-for-sale) </p>
                            <input type="text" class="form-control" value="<?php echo $productData['slug']; ?>" style="min-width: 100px; padding: 20px;" placeholder="Slug Of the Product Name" name="slug" required>

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

                            <p id="formp"> Upload Picture</p>
                            <input  type="file" class="form-control" value="<?php echo $productData['img']; ?>" style="min-width:100px; padding: 2px;" placeholder="Upload" name="image" required>   

                        </div>


                    </section>


                     <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Description</p>
                              <textarea rows="5" cols="30" class="form-control" value="" style="min-width:100px; padding: 20px;" placeholder="Description" name="desc" required><?php echo $productData['description']; ?></textarea>

                        </div>


                    </section>

                    <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                            <p id="formp">Condition</p>
                            <select class="form-control" name="cond">
                                <?php 
                                    $stmt = $dbConnection->prepare('SELECT * FROM cond');
                                    $stmt->execute();

                                    while($cond = $stmt->fetch()) {
                                        if($cond['id'] != $productData['cond']) {
                                            echo "<option value=".$cond['id'].">".$cond['name']."</option>";
                                        } else {
                                            echo "<option value=".$cond['id']." selected>".$cond['name']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </section>

                    <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Category</p>
                            <select class="form-control" onchange = "showHint(this.value)" name="cat">
                                <?php
                                    $stmt = $dbConnection->prepare('SELECT * FROM cat');
                                    $stmt->execute();
                                    while($cat = $stmt->fetch()) {
                                        if($cat['id'] != $productData['cat']) {
                                            echo "<option value=".$cat['id'].">".$cat['catTitle']."</option>";
                                        } else {
                                            echo "<option value=".$cat['id']." selected>".$cat['catTitle']."</option>";
                                        }
                                    }
                                ?>
                            </select>            
                        </div>

                    </section>

                    <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Brand</p>
                            <select class="form-control" onchange = "showHint(this.value)" name="brand">
                                <?php
                                    $stmt = $dbConnection->prepare('SELECT * FROM brand');
                                    $stmt->execute();

                                    $stm = $dbConnection->prepare('SELECT name FROM brand WHERE id = :id');
                                    $stm->execute(array(":id" => $productData['brand']));
                                    $brandId = $stm->fetch(PDO::FETCH_ASSOC);
                                    echo "<option value=".$productData['brand']." selected>".$brandId['name']."</option>";
                                    
                                    while($brand = $stmt->fetch()) {
                                        if($productData['brand'] != $brand['id']) {
                                            echo "<option value=".$brand['id'].">".$brand['name']."</option>";
                                        }
                                    }

                                ?>
                            </select>            
                        </div>

                    </section>

                     <section class="row">

                        <div class="col-sm-12" style="padding:20px;">
                           <p id="formp"> Available quanitity</p>
                              <input  type="text" class="form-control" value="<?php echo $productData['qty']; ?>" style="min-width:100px; padding: 20px;" name="qty" placeholder="" required>   

                        </div>

                    </section>

                    <section class="row">
                        
                        <div class="col-sm-12" style="padding: 20px;">
                            <p id="formp">Shipping Charge</p>
                                <input type="text" class="form-control" value="<?php echo $productData['shipping']; ?>" style="min-weight: 100px; padding: 20px;" name="shipping" placeholder="($)" required>
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
    include('../includes/footer.php');
?>