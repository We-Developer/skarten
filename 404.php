<?php require_once('includes/config.php'); ?>
<html>
    <head>
        <title>404 Page Not Found | <?php echo $row['title']; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir']; ?>assets/styles/stylesheet.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $row['baseDir']; ?>assets/styles/fonts.css"/>
        <link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    </head>
    <body>
        <div class="notfound">
            <h1>
                <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
                404 Page Not Found
            </h1>
            <h2>
                <a href="<?php echo $row['baseDir']; ?>" alt="Go back to home">Go to Home</a>
            </h2>
        </div>
    </body>
</html>
            
            
            