<?php
	include "includes/header.php";
	
	//Create DB object
	$db=new Database;
	
	//Create query
	$query="select posts.*, categories.name from posts inner join categories
	on posts.category=categories.id order by posts.title desc";
	//Run query
	$posts=$db->select($query);
	
	//Create query
	$query="select * from categories order by name desc";
	//Run query
	$cats=$db->select($query);
?>
	
	<?php
		if($posts){
	?>
	<table class="table table-striped">
		<tr>
			<th>Post ID</th><th>Post title</th><th>Category</th><th>Author</th><th>Date</th>
		</tr>
	<?php
		while($post=$posts->fetch_assoc()){
	?>
		<tr>
			<td><?php echo $post["id"]; ?></td>
			<td><a href="edit_post.php?id=<?php echo $post["id"]."\">".$post["title"]; ?></a></td>
			<td><?php echo $post["name"]; ?></td>
			<td><?php echo $post["author"]; ?></td>
			<td><?php echo formatDate($post["date"]); ?></td>
		</tr>
	<?php
		}
	?>
	</table>
	<?php
		}
		else echo "<h3>There are no posts yet.</h3>";
	?>
	
	<?php
		if($cats){
	?>
	<table class="table table-striped">
		<tr>
			<th>Category ID</th><th>Category name</th>
		</tr>
	<?php
		while($cat=$cats->fetch_assoc()){
	?>
		<tr>
			<td><?php echo $cat["id"]; ?></td>
			<td><a href="edit_category.php?id=<?php echo $cat["id"]."\">".$cat["name"]; ?></a></td>
		</tr>
	<?php
		}
	?>
	</table>
	<?php
		}
	?>
<?php
	include "includes/footer.php";
?>