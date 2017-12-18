<!DOCTYPE html>
<?php
  include('config.php');

  if(isset($_POST['email'])) {
    $email = $_POST['email'];

    $stm = $dbConnection->prepare('SELECT id FROM user WHERE email = :email');
    $stm ->execute(array(
      ':email' => $email
    ));
    $emailDB = $stm->fetch(PDO::FETCH_ASSOC);

    if($emailDB) {
      echo "Email already in use";
    } else {
      echo "Email valid";
      exit;
    }
  }
?>
