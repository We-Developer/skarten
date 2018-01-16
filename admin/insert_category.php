<?php
//include ('includes/config.php');
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <div class="container-fluid">
        <form method="POST" action="">
            <div class="row">
                <div class="form-group">
                    <label for="">Enter the category Title</label>
                    <input class="form-control" type="text" placeholder="Electroinic" required="" name="catTitle">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input class="form-control" type="text" placeholder="Electroinic" required="" name="catdDes">
                </div>
                <div class="form-group">
                    <label for="">Search tag</label>
                    <input class="form-control" type="text" placeholder="Electroinic" required="" name="catSlug">
                </div>
                <div class="form-group">
                    <input class="btn btn-info" type="submit" name="submit" value="Submit">
                    <input class="btn btn-info" type="reset" name="reset" value="Clear">
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>

<?php

if(isset($_POST['submit'])){
    
    $stmt= $dbConnection->prepare("INSERT INTO cat VALUES('',:catTitle,:catSlug,:catDesc)");
    
    $stmt->bindParam(':catTitle',$catTitle);
    $stmt->bindParam(':catSlug',$catSlug);
    $stmt->bindParam(':catDesc',$catDesc);
    
    $catTitle=$_POST['catTitle'];
    $catSlug=$_POST['catSlug'];
    $catDesc= $_POST['catdDes'];
    
    $stmt->execute();
    echo "<script>window.open('index.php?view_category','_self')</script>";
}

?>