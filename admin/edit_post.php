<?php
	include "includes/header.php";
	//Create DB object
	$db=new Database;
	
	if(isset($_GET["id"])){
		$post_id=$db->link->real_escape_string($_GET["id"]);
		
		//Create query
		$query="select * from posts where id=".$post_id;
		//Run query
		$result=$db->select($query);
		$post=$result->fetch_assoc();
		
		//Create query
		$query="select * from categories order by id";
		//Run query
		$cats=$db->select($query);
	}
	else{
		echo "<h3>No id is given to edit post.</h3>";
?>
		<a href="index.php" class="btn btn-default">Cancel</a>
<?php
		exit();
	}
	
	if(isset($_POST["submit"])){
		//Assign vars
		$title=$db->link->real_escape_string($_POST["title"]);
		$body=$db->link->real_escape_string($_POST["body"]);
		$category=$db->link->real_escape_string($_POST["category"]);
		$author=$db->link->real_escape_string($_POST["author"]);
		$tags=$db->link->real_escape_string($_POST["tags"]);
		
		//Simple validation
		if($title=="" || $body=="" || $category=="" || $author==""){
			//Set error
			$error="Please fill out all required fields.";
		}
		else{
			$query="update posts set title='".$title."',
			body='".$body."',
			category='".$category."',
			author='".$author."',
			tags='".$tags."'
			where id=".$post_id;
			
			$update_row=$db->update($query);
		}
	}
	
	if(isset($_POST["delete"])){
		$query="delete from posts where id=".$post_id;
		//Call delete method
		$delete_row=$db->delete($query);
	}
?>
<form role="form" method="post" action="edit_post.php?id=<?php echo $post_id; ?>">
	<div class="form-group">
		<label>Post title</label>
		<input name="title" type="text" class="form-control" placeholder="Enter title" value="<?php echo $post["title"]; ?>">
	</div>
	<div class="form-group">
		<label>Post body</label>
		<textarea name="body" class="form-control" placeholder="Enter post body"><?php echo $post["body"]; ?></textarea>
	</div>
	<div class="form-group">
		<label>Category</label>
		<select name="category" class="form-control">
			<?php
			if($cats){
				while($cat=$cats->fetch_assoc()){
			?>
				<option value="<?php echo $cat["id"]; ?>"
			<?php
				if($cat["id"]==$post["category"]) echo "selected";
			?>
				><?php echo $cat["name"]; ?></option>
			<?php
				}
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label>Author</label>
		<input name="author" type="text" class="form-control" placeholder="Enter author name" value="<?php echo $post["author"]; ?>">
	</div>
	<div class="form-group">
		<label>Tags</label>
		<input name="tags" type="text" class="form-control" placeholder="Enter tags" value="<?php echo $post["tags"]; ?>">
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