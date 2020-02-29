<?php
	include "includes/header.php";
	//Create DB object
	$db=new Database;
	
	if(isset($_GET["id"])){
		$cat_id=$db->link->real_escape_string($_GET["id"]);
		
		//Create query
		$query="select * from categories where id=".$cat_id;
		//Run query
		$result=$db->select($query);
		$cat=$result->fetch_assoc();
	}
	else{
		echo "<h3>No id is given to edit category.</h3>";
?>
		<a href="index.php" class="btn btn-default">Cancel</a>
<?php
		exit();
	}
	
	if(isset($_POST["submit"])){
		//Assign vars
		$name=$db->link->real_escape_string($_POST["name"]);
		
		//Simple validation
		if($name==""){
			//Set error
			$error="Please fill out all required fields.";
		}
		else{
			$query="update categories set name='".$name."'
			where id=".$cat_id;
			
			$update_row=$db->update($query);
		}
	}
	
	if(isset($_POST["delete"])){
		$query="delete from categories where id=".$cat_id;
		//Call delete method
		$delete_row=$db->delete($query);
	}
?>
<form role="form" method="post" action="edit_category.php?id=<?php echo $cat_id; ?>">
	<div class="form-group">
		<label>Category name</label>
		<input name="name" type="text" class="form-control" placeholder="Enter category" value="<?php echo $cat["name"]; ?>">
	</div>
	
	<div>
		<input name="submit" type="submit" class="btn btn-default" value="Submit" />
		<a href="index.php" class="btn btn-default">Cancel</a>
		<input name="delete" type="submit" class="btn btn-danger" value="Delete" />
	</div>
	<br />
</form>
<?php
	include "includes/footer.php";
?>