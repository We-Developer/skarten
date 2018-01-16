<?php
//include ('includes/db.inc.php');
?>

<link rel="stylesheet" type="text/css" href="style/table.css"> 

<table width="950px" align="center">
    
    <tr >
<!--        <th>Image</th>-->
        <th>User Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Country</th>
        <th>Phone No</th>
        <th>Paypal</th>
        <th>Zip Code</th>
        <th>Role</th>
        <th>Confirm</th>
        <th>Delete</th>
    </tr>
    
    <?php
        
    $stmt = $dbConnection->prepare("SELECT * FROM user");

    $stmt->execute();
                             
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		if($row['role']==5){
            continue;
        }else{
//        $image=$row['avatar'];
        $id=$row['id'];    
        $name=$row['name'];
        $email= $row['email'];
        $country=$row['country'];
        $phone=$row['phone'];
        $paypay=$row['paypal'];
        $zipCode= $row['zipcode'];
        $confirm= $row['emailVerify'];
        $role= $row['role'];
        }
	?>
	<tr>
<!--    <td><img src="<?php echo $row['baseDir'];?>content/uploads<?php echo $image;?>" width="50" height="50"/></td>-->
    <td><?php echo $id;?></td>    
    <td><?php echo $name;?></td>
    <td><?php echo $email;?></td>
    <td><?php echo $country;?></td>
    <td><?php echo $phone;?></td>
    <td><?php echo $paypay;?></td>
    <td><?php echo $zipCode;?></td>
    <td><?php echo $role;?></td>
    <td><?php echo $confirm;?></td>    
    <td><a href="delete_customer.php?delete_cus=<?php echo $id?>">Delete</a></td>    
    </tr>
	<?php } ?>
    
</table>