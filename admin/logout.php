<?php
include '../includes/config.php';

if(!isset($_SESSION['loggedin'])) {
    if($_SESSION['loggedin'] == false) {
        header('Location: index');
    }
        header('Location: index');
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $user->logout();
    header('Location: index');
}

if(isset($_GET['session_expired'])) {
    if($_GET['session_expired'] == 1) {
        $user->logout();
        header('Location: index');
    }
}
