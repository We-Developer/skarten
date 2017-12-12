<?php 
    include('includes/header.php');
?>

<?php 
    function validate_data($data)
    {
     $data = trim($data);
     $data = stripslashes($data);
     $data = strip_tags($data);
     $data = htmlspecialchars($data);
     return $data;    
    }

    if($user->is_logged_in()) {
        header('Location: index.php');
    } else {
        if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
            // Verify data
            $email = validate_data($_GET['email']); // Set email variable
            $hash = validate_data($_GET['hash']); // Set hash variable

            //Fetch Website Details
            $stmt = $dbConnection->prepare('SELECT email,hash,emailVerify FROM user WHERE email= :email AND hash= :hash AND emailVerify= :emailVerify') ;
            $stmt->execute(array(
                ':email' => $email,
                ':hash' => $hash,
                ':emailVerify' => '0'
            ));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $stmt = $dbConnection->prepare('UPDATE user SET emailVerify = :emailVerify WHERE email = :email AND hash = :hash AND emailVerify = 0');
                $stmt->execute(array(
                    ':emailVerify' => 1,
                    ':email' => $email,
                    ':hash' => $hash
                ));

                echo '<div class="success">Account has been successfully activated!</div>';
            } else {
                echo '<div class="error">Account already active or invalid URL!</div>';
            }
        }else{
            echo '<div class="error">Invalid approach! Use link you received in email.</div>';
        }
    }
    ?>
<?php
    include ('includes/footer.php');
?>

            
            
            