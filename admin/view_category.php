<?php
//include ('includes/db.inc.php');
?>

<link rel="stylesheet" type="text/css" href="style/table.css"> 

<table width="950px" align="center">
    
    <tr >
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Tags</th>
        <th>Edit</th>
        <th>Delete</th>   
    </tr>    
    <?php
        
    $stmt = $dbConnection->prepare("SELECT * FROM cat");

    $stmt->execute();
                             
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		
        $id=$row['id'];
        $caTitle= $row['catTitle'];
        $catDec= $row['catDesc'];
        $catSlug=$row['catSlug'];    
	?>
	<tr>
    <td><?php echo $id;?></td>
    <td><?php echo $caTitle;?></td>
    <td><?php echo $catDec;?></td>
    <td><?php echo $catSlug;?></td>
    <td><a href="index.php?edit_cat=<?php echo $id ?>">Edit</a></td>
    <td><a id="delete" href="delete_cat.php?delete_cat=<?php echo $id?>">Delete</a></td>    
    </tr>
	<?php } ?>
    
</table>