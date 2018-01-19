<!DOCTYPE html>
<?php
  include('../includes/config.php');

  if(isset($_POST['value'])) {
    $catId = $_POST['value'];

    $stm = $dbConnection->prepare('SELECT * FROM brand WHERE catId = :catId');
    $stm ->execute(array(
      ":catId" => $catId
    ));
    $brandData = $stm->fetchAll();
    
    if($brandData) {
      echo "<select class='form-control' name='brand' required>";
      foreach($brandData as $brand) {
        echo "<option value='".$brand['id']."'>".$brand['name']."</option>";
      }
      echo "</select>";
    } else {
      echo "<p class='red'>No Brands</p>";
    }
  }
?>
