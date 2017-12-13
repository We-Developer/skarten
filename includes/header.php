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
    </head>
    <body>
    
    <header class="row" style="background-color: #f4f4f4; margin-left:0px; margin-right:0px;">
      <div class="col-sm-3">
        <a href="<?php echo $row['baseDir']; ?>" alt="Home">
          <img style="width:300px; padding:8px;" src="data:image/png;base64,<?php echo base64_encode($row['logo'])?>"/>
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
              echo "<a href='".$row['baseDir']."content/dashboard'><i class='fa fa-user-circle-o fa-3x' aria-hidden='true'></i></a>";
              echo "<a href='".$row['baseDir']."content/dashboard'>DASHBOARD</a><br><a href='".$row['baseDir']."logout'>LOGOUT</a>";
            } else {
              echo "<a href='".$row['baseDir']."login'><i class='fa fa-user-circle-o fa-3x' aria-hidden='true'></i></a>";
              echo "<a href='".$row['baseDir']."register'>SIGN UP</a><br><a href='".$row['baseDir']."login'>LOGIN</a>";
            }
          ?>
        </div>
      </div>
    </header>
    
    <header class="row" style="margin-left: 0px; margin-right: 0px; background-color:rgba(0,230,64,1.0);">
      <nav>
          <h2>Skarten Navigation</h2>
      </nav>
    </header>

    <div class="container-fluid"> 
    
      <div class="container-stretch">
        
     </div>