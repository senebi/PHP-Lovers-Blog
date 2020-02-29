<?php
	include "includes/header.php";
	
	//Create DB object
	$db=new Database;
	
	if(isset($_POST["submit"])){
		//Assign vars
		$name=$db->link->real_escape_string($_POST["name"]);
		
		//Simple validation
		if($name==""){
			//Set error
			$error="Please fill out all required fields.";
		}
		else{
			$query="insert into categories
			(name) values('".$name."')";
			
			$insert_row=$db->update($query);
		}
	}
?>
<form role="form" method="post" action="add_category.php">
	<div class="form-group">
		<label>Category name</label>
		<input name="name" type="text" class="form-control" placeholder="Enter category">
	</div>
	
	<div>
		<input name="submit" type="submit" class="btn btn-default" value="Submit" />
		<a href="index.php" class="btn btn-default">Cancel</a>
	</div>
	<br />
</form>
<?php
	include "includes/footer.php";
?>