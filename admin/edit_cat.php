<?php
//
//include ('includes/db.inc.php');

if(isset($_GET['edit_cat'])){
    $id=$_GET['edit_cat'];
    $stmt= $dbConnection->prepare("SELECT*FROM cat WHERE id='$id'");
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $id=$row['id'];
        $catTitle= $row['catTitle'];
        $catSlug= $row['catSlug'];
        $catDesc= $row['catDesc'];    
    }   
}
?>



<?php
include ('includes/config.php');
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
                    <input class="form-control" type="text" placeholder="Electroinic" required="" name="catTitle" value="<?php echo $catTitle ?>">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input class="form-control" type="text" placeholder="Electroinic" required="" name="catdDes" value="<?php echo $catDesc ?>">
                </div>
                <div class="form-group">
                    <label for="">Search tag</label>
                    <input class="form-control" type="text" placeholder="Electroinic" required="" name="catSlug" value="<?php echo $catSlug ?>">
                </div>
                <div class="form-group">
                    <input class="btn btn-info" type="submit" name="submit" value="Update">
                    <input class="btn btn-info" type="reset" name="reset" value="Clear">
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>


<?php

if(isset($_POST['submit'])){
    
    $stmt= $dbConnection->prepare("UPDATE cat SET catTitle=:catTitle,catSlug=:catSlug,catDesc=:catDesc WHERE id=:id");
    
    $stmt->bindParam(':id',$id);
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