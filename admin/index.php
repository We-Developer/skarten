<?php 

include '../includes/config.php';

if($user->is_logged_in()){
    
}else{
    echo "<script>window.open('login.php','_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/index.css">
    
    <title></title>
</head>

<body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="#">AdminPanel</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Statics<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Page 1-1</a></li>
                <li><a href="#">Page 1-2</a></li>
                <li><a href="#">Page 1-3</a></li>
              </ul>
            </li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-sm-2 header1 ">
<!--                add a user pi here-->
            </div>
            
            <div class="col-sm-8 header2">
                <h1 class="text-center">Admin Page</h1>
            </div>
            <div class="col-sm-2 header3"></div>
            
        </div>
        
    </div>
    
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-2 content">
                <h4>Controlers</h4>
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#section1">Home</a></li>
                    <li><a href="#section2">View Orders</a></li>
                    <li><a href="index.php?view_customers">View Customers</a></li>
                    <li><a href="#section2">View Payments</a></li>
                    <li><a href="index.php?view_category">View All Categories</a></li>  
                    <li><a href="#section3">View All Products</a></li>
                    <li><a href="index.php?insert_category">Insert new Categories</a></li>
                    <li><a href="#section2">Insert New Product</a></li>
                    
                  </ul><br>
            </div>
                
            <div class="col-sm-8">
                <?php
                if(isset($_GET['insert_category'])){
                    include ('insert_category.php');
                }
                if(isset($_GET['view_customers'])){
                    include ('view_customers.php');
                }
                if(isset($_GET['view_category'])){
                    include ('view_category.php');
                }
                if(isset($_GET['edit_cat'])){
                    include ('edit_cat.php');
                }
                ?>
            
                
            </div>
            

            <div class="col-sm-2"></div>  
        </div> 
    </div>
    
</body>
</html>