<!DOCTYPE html>
<?php
  include('config.php');
?>
<html lang="em">
    <head>
      <title><?php echo $row['title']." | ".$row['description'];; ?></title>
        
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!--<meta property='og:image' content="<?php echo $r['logo'];?>"/>-->
      <meta property='og:url' content="<?php echo $r['baseDir'];?>"/>
      <meta name="description" content="<?php echo $q['description'];?>"/> 
      <meta name='keywords' content="<?php echo $q['keywords'];?>"/>
      <meta name="author" content="<?php echo $r['title'];?>"/> 
      <link rel='shortcut icon' href="data:image/png;base64,<?php echo base64_encode($row['favicon'])?>" type='image/x-icon'/ >
      <link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        
      <link rel="stylesheet" type="text/css" href="../../../Fiverr/skarten_master/assets/styles/stylesheet.css">
      <!-- <title><?php echo $row['title']." | ".$row['description'];; ?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <meta property='og:url' content="<?php echo $row['baseDir'];?>"/>
      <meta name="description" content="<?php echo $row['description'];?>"/> 
      <meta name='keywords' content="<?php echo $row['keywords'];?>"/>
      <meta name="author" content="<?php echo $row['title'];?>"/> 
      <link rel='shortcut icon' href="data:image/png;base64,<?php echo base64_encode($row['favicon'])?>" type='image/x-icon'/ >
      <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/loginStyle.css">
      <link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
      <script type="text/Javascript" src="<?php echo $row['baseDir'];?>assets/country.js"></script> -->
    </head>
    <body>
    <div class="container-fluid">
    
    <header class="row" style="background-color: #f4f4f4; margin-left:0px; margin-right:0px;">

    <div class="col-sm-3">
          <a href="<?php echo $row['baseDir']; ?>" alt="Home">
<!--                    <img style="width:70%; padding:8px;" src="data:image/png;base64,<?php echo base64_encode($row['logo'])?>"/>-->
                <img style="width:70%; padding:8px;" src="../../../Fiverr/skarten_master/assets/images/logo2.png"/>

        </a>
    </div>

       <div style="padding: 20px;" class=" col-xs-6">

          <input  type="text" class="form-control" style="min-height:200%; padding: 20px;" placeholder="Search">   
      </div>

    <div style="padding:20px 0px 20px 0px;" class=" col-sm-1">      
          <button style="min-height:40px;" type="submit" class="btn btn-alert" >Search</button>

    </div>
    </header> 
    
    
      <div class="container-stretch">


        <header class="row">
         <!--  <div  class="align-Left border col-xs-2">
            <img src="images/logo.png" style="width:25%; padding:10px; float: left;">
          </div> -->
           <div class="col-xs-12 ">

            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand " href="../../../Fiverr/skarten_master">
<!--                          <img style="width:20px;" src="data:image/jpeg;base64,<?php echo base64_encode( $row['logo'] )?>"/></a>-->
                      <img style="width:90px;" src="../../../Fiverr/skarten_master/assets/images/logo2.png"/></a>
                </div>
                <ul class="nav navbar-nav">
                  <li class=""><a href="../../../Fiverr/skarten_master/content/addItem.php">Buy</a></li>
                  <li><a href="../../../Fiverr/skarten_master/content/oneProduct.php">Sell</a></li> 
                  <?php 
                      if($user->is_logged_in()) {
                        echo '<li><a href="../../../Fiverr/skarten_master/dashboard.php">'.$_SESSION['userName'].'</a></li>';
                        echo '<li><a href="../../../Fiverr/skarten_master/logout.php">Logout</a></li>';

                      } else {
                        echo '<li><a href="../../../Fiverr/skarten_master/login.php">Login</a></li>';
                      }
                  ?>
                </ul>
              </div>
            </nav>

          </div>      
        </header>
     </div>