<!DOCTYPE html>
<?php
  include('config.php');
?>
<html lang="em">
    <head>
      <title><?php echo $row['title']." | ".$row['description'];; ?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta property='og:url' content="<?php echo $row['baseDir'];?>"/>
      <meta name="description" content="<?php echo $row['description'];?>"/> 
      <meta name='keywords' content="<?php echo $row['keywords'];?>"/>
      <meta name="author" content="<?php echo $row['title'];?>"/> 
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel='shortcut icon' href="data:image/png;base64,<?php echo base64_encode($row['favicon'])?>" type='image/x-icon'/ >
      <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/fonts.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/stylesheet.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/loginStyle.css"/>
      <link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
      <script type="text/Javascript" src="<?php echo $row['baseDir'];?>assets/country.js"></script>

      <script type="text/JavaScript">
        $(document).ready(function() {
  
          $(window).scroll(function () {
            //if you hard code, then use console
            //.log to determine when you want the 
            //nav bar to stick.  
            console.log($(window).scrollTop())
            if ($(window).scrollTop() > $('#main-header').height()) {
              $('#secondary-nav').addClass('navbar-fixed');
            }
            if ($(window).scrollTop() < $('#main-header').height()+1) {
              $('#secondary-nav').removeClass('navbar-fixed');
            }
          });
        });
      </script>

    </head>
    <body>
    
    <header class="row" id="main-header" style="background-color: #f4f4f4; margin-left:0px; margin-right:0px;">

      <div class="col-sm-3">
        <a href="<?php echo $row['baseDir']; ?>" alt="Home">
          <div class="col-sm-3">
            <a href="<?php echo $row['baseDir']; ?>" alt="Home">
              <img style="width:300px; padding:8px;" src="data:image/png;base64,<?php echo base64_encode($row['logo'])?>"/>
            </a>
          </div>
        </a>
      </div>
      <form action="search.php" method="POST" class="search">
        <div style="padding: 20px;" class=" col-xs-5">
          <input type="text" class="form-control" style="min-height:200%; padding: 20px;" placeholder="Search">   
        </div>
        
        <div style="padding:20px 0px 20px 0px;" class=" col-sm-1">      
          <input style="min-height:40px;" type="submit" class="btn btn-alert" value="Search">
        </div>
      </form>
        <div class="col-sm-2" style="float: right;">
          <div class="user">
          <?php
            if($user->is_logged_in()) {
              echo "<div class='right'>";
              echo "<a href='".$row['baseDir']."content/dashboard'><img src='".$row['baseDir'].'content/'.$_SESSION['avatar']."' class='avatar-tiny'/></a>";
              echo '</div>';
            } else {
              echo "<a href='".$row['baseDir']."login'><i class='fa fa-user-circle-o fa-3x' aria-hidden='true'></i></a>";
              echo "<a href='".$row['baseDir']."register'>SIGN UP</a><br><a href='".$row['baseDir']."login'>LOGIN</a>";
            }
          ?>
        </div>
      </div>
    </header>
    
    <header class="row" id="secondary-nav" style="margin-left: 0px; margin-right: 0px; background: -moz-linear-gradient(45deg, rgba(0,176,59,1) 0%, rgba(0,230,77,1) 100%); /* ff3.6+ */
background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, rgba(0,176,59,1)), color-stop(100%, rgba(0,230,77,1))); /* safari4+,chrome */
background: -webkit-linear-gradient(45deg, rgba(0,176,59,1) 0%, rgba(0,230,77,1) 100%); /* safari5.1+,chrome10+ */
background: -o-linear-gradient(45deg, rgba(0,176,59,1) 0%, rgba(0,230,77,1) 100%); /* opera 11.10+ */
background: -ms-linear-gradient(45deg, rgba(0,176,59,1) 0%, rgba(0,230,77,1) 100%); /* ie10+ */
background: linear-gradient(45deg, rgba(0,176,59,1) 0%, rgba(0,230,77,1) 100%); /* w3c */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00E64D', endColorstr='#00B03B',GradientType=1 ); /* ie6-9 */">
      <nav>
        <!--Add Navigation Here-->
        <!-- Content Float to Left-->
        <div class="left">
            <ul>
              <li><a href="<?php echo $row['baseDir']; ?>content/cat" alt="Product Categories">Categories</li>
              <li><a href="<?php echo $row['baseDir']; ?>register" alt="Become a Seller">Sell</a></li>
            </ul>
        </div>
        <!-- Content Float to Left-->
        <div class="right">
          <ul>
            <?php
              # If the user is logged in, allow the user to view their cart
              if($user->is_logged_in()) {
            ?>
              <li><a href="<?php echo $row['baseDir'];?>content/cart" alt="Shopping Cart"><i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i></a></li>
              <li><a href="<?php echo $row['baseDir'];?>content/wishlist" alt="Wish List"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></a></li>
              <li><a href="<?php echo $row['baseDir'];?>content/alerts" alt="New Alerts"><i class="fa fa-bell-o fa-2x" aria-hidden="true"></i></a></li>  
              <li><a href="<?php echo $row['baseDir'];?>logout" alt="Logout of Account"><i class='fa fa-sign-out fa-2x' aria-hidden='true'></i></a></li>
            <?php
              } else {
              # Link the Cart icon to the Login Page
            ?>
              <li><a href="<?php echo $row['baseDir'];?>login" alt="Login to View Shopping Cart"><i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i></a></li>
            <?php
              }
            ?>
          </ul>
        </div>
      </nav>
    </header>

    <div class="container-fluid"> 
    
      <div class="container-stretch">
        <header class="row">
          <div class="col-sm">
           
          </div>      
        </header>
     </div>