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
      <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/stylesheet.responsive.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/loginStyle.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/carousel.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir'];?>assets/styles/sellerDashdboard.css"/>  
      <link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
      <script type="text/Javascript" src="<?php echo $row['baseDir'];?>assets/country.js"></script>
      <script type="text/Javascript" src="<?php echo $row['baseDir'];?>assets/js/carousel.js"></script>

      <script type="text/JavaScript">
        $(document).ready(function() {
  
          $(window).scroll(function () {
            //if you hard code, then use console
            //.log to determine when you want the 
            //nav bar to stick.  
            console.log($(window).scrollTop())
            if ($(window).scrollTop() > $('#main-header').height()) {
              $('#navigation').addClass('navbar-fixed');
            }
            if ($(window).scrollTop() < $('#main-header').height()+1) {
              $('#navigation').removeClass('navbar-fixed');
            }
          });
        });
      </script>

    </head>
    <body>
    
    <header class="row" id="main-header" style="background-color: #f4f4f4; margin-left:0px; margin-right:0px;">
    <div class="top-header">
      <a href="<?php echo $row['baseDir']; ?>" alt="Home">
        <img src="data:image/png;base64,<?php echo base64_encode($row['logo'])?>" class="mainLogo"/>
      </a>
      
      <form action="search.php" method="POST" class="search">
        <input type="text" id="searchTerm" class="form-control" style="min-height:200%; padding: 20px;" placeholder="Search">   
        <input style="min-height:40px;" type="submit" class="btn btn-alert" value="Search" id="searchBtn">
      </form>

      <div class="user">
        <?php
          if($user->is_logged_in()) {
            echo "<div class='right'>";
            echo "<a href='".$row['baseDir']."content/dashboard'><img src='".$row['baseDir'].'content/'.$_SESSION['avatar']."' class='avatar-tiny'/></a>";
            echo '</div>';
          } else {
            echo "<a href='".$row['baseDir']."login'><i class='fa fa-user-circle-o fa-3x' aria-hidden='true'></i></a>";
            echo "<a href='".$row['baseDir']."register.php'>SIGN UP</a><br><a href='".$row['baseDir']."login.php'>LOGIN</a>";
          }
        ?>
      </div>
    </div>
  </header>
      
  <nav class="navbar navbar-inverse" id="navigation">
<div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>                        
    </button>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php
            $stmt = $dbConnection->prepare('SELECT id,catTitle FROM cat ORDER BY id ASC');
            $stmt->execute();
            $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($cats as $cat) {
              echo "<li><a href='view-cat?id=".$cat['id']."'>".$cat['catTitle']."</a></li>";
            }
          ?>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Brand<span class="caret"></span></a>
        <ul class="dropdown-menu">
        <?php
          $stmt = $dbConnection->prepare('SELECT id,name FROM brand ORDER BY id ASC');
          $stmt->execute();
          $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);

          foreach($brands as $brand) {
            echo "<li><a href='view-brand?id=".$brand['id']."'>".$brand['name']."</a></li>";
          }
        ?>
        </ul>
      </li>  
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
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
</div>
</nav>


<script>
$(document).ready(function(){
  $(".dropdown").hover(            
      function() {
          $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
          $(this).toggleClass('open');        
      },
      function() {
          $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
          $(this).toggleClass('open');       
      }
  );
});
  
  </script>    
  
  

  <div class="container-fluid"> 
  
    <div class="container-stretch">
      <header class="row">
        <div class="col-sm">
         
        </div>      
      </header>
   </div>