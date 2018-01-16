<?php
//database credentials
define('DBHOST2','localhost');
define('DBUSER2','root');
define('DBPASS2','');
define('DBNAME2','ecommerce');

$dbConnection = new PDO("mysql:host=".DBHOST2.";port=3306;dbname=".DBNAME2, DBUSER2, DBPASS2);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);