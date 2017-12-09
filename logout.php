
<?php
    include('includes/header.php');
    if(!isset($_SESSION['loggedin'])) {
        if($_SESSION['loggedin'] == false) {
            header('Location: index.php');
        }
            header('Location: index.php');
    }

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $user->logout();
        header('Location: index.php');
    }
?>


<img class="" style="width:100%; padding:15px;" src="data:image/jpeg;base64,<?php echo base64_encode( $row['logo'] )?>"/>    

</body>
</html> 
    