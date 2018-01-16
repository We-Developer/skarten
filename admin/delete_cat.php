<?php

//include ('includes/db.inc.php');
include '../includes/config.php';

if(isset($_GET['delete_cat'])){
    $id=$_GET['delete_cat'];
    $stmt= $dbConnection->prepare("DELETE FROM cat WHERE id='$id'");
    $stmt->execute();
    echo "<script>window.open('index.php?view_category','_self')</script>";
}
?>

