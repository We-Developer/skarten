<!DOCTYPE html>
<?php
  include('../includes/config.php');

  if(isset($_POST['coupon'])) {
    $couponcode = $_POST['coupon'];

    $stm = $dbConnection->prepare('SELECT code,name,description,value,active FROM coupon WHERE code = :code');
    $stm ->execute(array(
      ':code' => $couponcode
    ));
    $couponDataAdd = $stm->fetch(PDO::FETCH_ASSOC);

    if($couponDataAdd) {
      if($couponDataAdd['active'] == 1) {
        echo "Valid Coupon Code";
      } else {
        echo "Coupon Code not Active";
      }
    } else {
      echo "Invalid Coupon Code";
      exit;
    }
  }
?>
