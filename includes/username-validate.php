<!DOCTYPE html>
<?php
  include('config.php');

  if(isset($_POST['username'])) {
    $username = $_POST['username'];

    $stm = $dbConnection->prepare('SELECT id FROM user WHERE username = :username');
    $stm ->execute(array(
      ':username' => $username
    ));
    $usernameDB = $stm->fetch(PDO::FETCH_ASSOC);

    if($usernameDB) {
      echo "Username already taken";
    } else {
      echo "Username available";
      exit;
    }
  }
?>
