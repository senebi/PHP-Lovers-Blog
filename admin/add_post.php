<?php
	include "includes/header.php";
	
	//Create DB object
	$db=new Database;
	
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
			$query="insert into posts
			(title, body, category, author, tags)
			values('".$title."', '".$body."', '".$category."', '".$author."', '".$tags."')";
			
			$insert_row=$db->insert($query);
		}
	}
	
	//Create query
	$query="select * from categories order by id";
	//Run query
	$cats=$db->select($query);
?>
<form role="form" method="post" action="add_post.php">
	<div class="form-group">
		<label>Post title</label>
		<input name="title" type="text" class="form-control" placeholder="Enter title">
	</div>
	<div class="form-group">
		<label>Post body</label>
		<textarea name="body" class="form-control" placeholder="Enter post body"></textarea>
	</div>
	<div class="form-group">
		<label>Category</label>
		<select name="category" class="form-control">
			<?php
			if($cats){
				while($cat=$cats->fetch_assoc()){
			?>
				<option value="<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></option>
			<?php
				}
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label>Author</label>
		<input name="author" type="text" class="form-control" placeholder="Enter author name">
	</div>
	<div class="form-group">
		<label>Tags</label>
		<input name="tags" type="text" class="form-control" placeholder="Enter tags">
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