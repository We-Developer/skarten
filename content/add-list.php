<?php 
    include('../includes/header.php');

    if(!$user->is_logged_in()) {
        header ('Location: ../index.php');
    } else {
        $stmt = $dbConnection->prepare('SELECT username,password,avatar,name,email,paypal,phone,country,state,city,address,zipcode,role FROM user WHERE username = :username');
        $stmt->execute(array(
            ':username' => $_SESSION['userName']
        ));

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    if(isset($_POST['submit'])) {
        
        $title = trim($_POST['title']);
            
        $description = trim($_POST['description']);

        try {
            $stmt = $dbConnection->prepare('SELECT id FROM user WHERE username = :username');
            $stmt->execute(array(
                ':username' => $_SESSION['userName']
            ));

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        try {
            //update into database
            $stmt = $dbConnection->prepare('INSERT INTO wishlist(title,description,user_id) VALUES(:title,:description,:user_id)') ;
			$stmt->execute(array(
                ':title' => $title,
                ':description' => $description,
                ':user_id' => $userData['id']
            ));

            header ('Location: wishlist');
                
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
?>

<title>Create a List - <?php echo $row['title']; ?></title>
<body>
    <div class="container-fluid">
        <div class="content">
            
            <form method="POST" action="" name="createlist" enctype="multipart/form-data" class="data">
                
            <section class="row">

                <div class="col-sm-12" style="padding:20px;">
                    <h1>Create a List</h1>
                </div>

                <div class="error" id="errorForm">
                    <!---Create a List Error-->
                </div>
            </section>

            <section class="row">
                <div class="col-sm-6" style="padding:20px;">
                    <label for="title">Name</label>
                    <input type="text" name="title" class="form-control" style="min-width: 100px; padding: 20px;" placeholder="Name of List" required/>
                </div>
                <div class="col-sm-12" style="padding:20px;">
                    <label for="title">Description</label>
                    <textarea name="description" class="form-control" style="min-width: 100px; padding: 20px;" placeholder="Description of List" resizable="false" required></textarea>
                </div>
            </section>
            
            <section class="row">
                <div class="col-sm-12 text-center" style="padding:20px;">
                    <input type="submit" name="submit" class="btn btn-info" style="min-width:120px; padding: 20px;" value="Create List">    
                </div>
            </section>
            </form>
          

            
        </div>    
        </div>
        
    
<?php
    include('../includes/footer.php');
?>