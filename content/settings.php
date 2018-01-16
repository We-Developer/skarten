<?php 
    include('includes/header.php');

    if(!$user->is_logged_in()) {
        header ('Location: index.php');
    }
    if($user->is_logged_in()) {
        $stmt = $dbConnection->prepare('SELECT role FROM user WHERE username = :username');
        $stmt->execute(array(
            ':username' => $_SESSION['userName']
        ));
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        if($role['role'] != 0) {
            header ('Location: index.php');
        }
    }
    if(isset($_POST['submit'])) {
        if(!($_POST['title'] === null || $_POST['title'] == " ")) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $keywords = $_POST['keywords'];
            $copyright = $_POST['copyright'];

            try {
            //update into database
					$stmt = $dbConnection->prepare('UPDATE settings SET title = :title, description = :description, keywords = :keywords, copyright = :copyright WHERE id = :id') ;
					$stmt->execute(array(
						':title' => $title,
						':description' => $description,
                        ':keywords' => $keywords,
                        ':copyright' => $copyright,
						':id' => 1
                    ));

                    $success = true;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
        }
    } else {
        echo "YO YO";
    }


?>
<title>Settings - <?php echo $row['title']; ?></title>
<body>

    <div class="container-fluid">
<!--
        
        <img src="../../public/public/images/slider/sell.png" alt="Chicago" style="width:100%;">
-->

        <?php 

        #$stmt = $dbConnection->prepare('SELECT * FROM settings WHERE id=1') ;
        #$stmt->execute(array(':title' => (isset($_GET['title'])) ? $_GET['title'] : null));
        #$row = $stmt->fetch(); 
        

        ?>
        
        <div class="container">
            
            <section class="row">
                
                <?php
                    if(isset($success)) {
                        if($success == true) {
                            echo "<h1>Updated</h1>";
                        }
                    }
                ?>

                <div class="col-sm-12" style="padding:20px;">
                   
                    <h1 >Settings</h1>
                </div>


            </section>
            <form method="POST" action="">
            <section class="row">
                

                <div class="col-sm-12" style="padding:20px;">
                   
                    <p id="formp"> Website Title </p>
                    <input  type="text" name="title" class="form-control" style="min-width:100px; padding: 20px;" value="<?php echo $row['title'];?>" required>   
                    
                </div>


            </section>

            
             <section class="row">

                <div class="col-sm-12" style="padding:20px;">
             
                    <p id="formp"> Description </p>
                    <input  type="text" name="description" class="form-control" style="min-width:100px; padding: 20px;" value="<?php echo $row['description'];?>" required>   
              
                </div>


            </section>
            
              <section class="row">
                

                <div class="col-sm-12" style="padding:20px;">
                   
                    <p id="formp"> Keywords </p>
                    <input type="text" name="keywords" class="form-control" style="min-width: 100px; padding: 20px;" value="<?php echo $row['keywords']; ?>" required>
                    
                </div>


            </section>
            
            
             <section class="row">

                <div class="col-sm-12" style="padding:20px;">
                   <p id="formp"> Copyright</p>
                      <input  type="text" name="copyright" class="form-control" style="min-width:100px; padding: 20px;" value="<?php echo $row['copyright']; ?>" required>   
                    
                </div>


            </section>
              <section class="row">
             
                <div class="col-sm-4 text-center" style="padding:20px;">
        
                       <p> </p> 
                    
                </div>

                <div class="col-sm-4 text-center" style="padding:20px;">
        
                      <input type="submit" name="submit" class="btn btn-info" style="min-width:120px; padding: 20px;" value="Update Settings">    
                    
                </div>
                 <div class="col-sm-4 text-center" style="padding:20px;">
        
                       <p> </p> 
                    
                </div>

            </section>
            </form>
          

            
        </div>    
        
    
<?php
    include('includes/footer.php');
?>