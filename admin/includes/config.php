<?php
ob_start();
//session_start();

include ('db.inc.php');

//set timezone
date_default_timezone_set('Europe/London');

//load classes as needed
//function __autoload($class) {
//    
//    $class = strtolower($class);
// 
//    //if call from within assets adjust the path
//    $classpath = 'includes/classes/class.'.$class . '.php';
//    if ( file_exists($classpath)) {
//       require_once $classpath;
//    }  
//    
//    //if call from within admin adjust the path
//    $classpath = '../includes/classes/class.'.$class . '.php';
//    if ( file_exists($classpath)) {
//       require_once $classpath;
//    }
//    
//    //if call from within admin adjust the path
//    $classpath = '../../includes/classes/class.'.$class . '.php';
//    if ( file_exists($classpath)) {
//       require_once $classpath;
//    }     
//     
// }


//Fetch Website Details
$stmt = $dbConnection->prepare('SELECT * FROM settings WHERE id=1') ;
$stmt->execute(array(':title' => (isset($_GET['title'])) ? $_GET['title'] : null));
$row = $stmt->fetch(); 

#Object of the User class
//$user = new User($dbConnection);
