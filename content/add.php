<?php
    require '../includes/header.php';

    //id(s) declaration are down
    $pname = $_POST["pname"];
    // Slug declaration is down
    $descrip = $_POST["desc"];
    // image(s) declaration are down
    $price = $_POST["price"];
    $qty = $_POST["qty"];
    $shipping = $_POST["shipping"];
    $condition = $_POST["cond"];
    $slug = $user->create_url_slug($_POST['pname']);
    $cond = $_POST["cond"];
    $shipping = $_POST["shipping"];
    $discount = 0;
    if(isset($_POST["discount"])) {
        $discount = $_POST["discount"];
    } else {
        $discount = 0;
    }

    $empty = null;

    // posted declaration is down
    // cat and brand declaration are down
    // featured, sold and deal declarations are not there
    $cat = $_POST["cat"];
    $brand = $_POST["brand"];

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

    if($_FILES['image']['error']==0) {
        $image = "";
//    $image = addslashes($_FILES['image']['tmp_name']);
//    $name = addslashes($_FILES['image']['name']);
//    $image = file_get_contents($image);
//    $image = base64_encode($image);
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
                
                $username = $_SESSION['userName'];
    
                $stm = $dbConnection->prepare('SELECT id FROM user WHERE username = :username');
                $stm->execute(array(":username" => $username));
                $userData = $stm->fetch(PDO::FETCH_ASSOC);
                $id = $userData['id'];

                $posted = date('Y-m-d H:i:s', time());
                // Query for the product table
                $stmt = $dbConnection->prepare('INSERT INTO product (`name`, `slug`, `description`, `img`, `featImg`, `price`, `shipping`, `discount-price`, `qty`, `posted`, `cat`, `brand`, `cond`, `featured`, `sold`, `deal`, `postedBy`) VALUES(:name,:slug,:descrip,:image,:main,:price,:shipping,:discountprice,:qty,:posted,:cat,:brand,:cond,:featured,:sold,:deal,:userame)');
                $success = $stmt->execute(array(
                    ":name" => $pname,
                    ":slug" => $slug,
                    ":descrip" => $descrip,
                    ":image" => $image,
                    ":main" => $featimage,
                    ":price" => $price,
                    ":shipping" => $shipping,
                    ":discountprice" => $discount,
                    ":qty" => $qty,
                    ":posted" => $posted,
                    ":cat" => $cat,
                    ":brand" => $brand,
                    ":cond" => $cond,
                    ":featured" => 0,
                    ":sold" => 0,
                    ":deal" => 0,
                    ":userame" => $id
                ));
                
                if($success) {
                    header('Location: dashboard-seller.php');
                } else {
                    echo "<center><h3>Product couldn't be added!<br />Please Try again!</h3></center>";
                }
                
            }else{
                echo 'File is too big';
            }
        }else{
            echo "Cannot upload this file type";
        }
        
    } else {
        echo 'There was an error uploading the image';
    }

?>