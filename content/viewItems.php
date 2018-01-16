<?php   
    if($user->is_logged_in()) {

        try {
            $stm = $dbConnection->prepare(' SELECT name,img,price,qty  FROM product WHERE id=1');
            $stm->execute(array(':username' => $_SESSION['userName']));
            $userData = $stm->fetch(PDO::FETCH_ASSOC);
            
?>   

<h2> <b><center>Recent Add</center></b></h2>
<div class="container-fluid">
    <div class="raw">
        <div class="col-sm-6">
            <p>Name : <?php echo $userData['name']?></p>
        </div>
            
        <div class="col-sm-6"></div>
        
    </div>
</div>

<?php
        } catch (PDOException $e) {
            $e->getMessage();
        }
?>
<?php }?>