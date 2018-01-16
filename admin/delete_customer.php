<?php
include '../includes/config.php';

if(isset($_GET['delete_cus'])){
    $id=$_GET['delete_cus'];
    $stmt = $dbConnection->prepare("DELETE FROM user WHERE id='$id'");
    $stmt->execute();
    echo "<script>window.open('index.php?view_customers','_self')</script>";
}