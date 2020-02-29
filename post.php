<?php
	include "includes/header.php";
	
	//Create DB object
	$db=new Database();
	$post_id=$db->link->real_escape_string($_GET["id"]);
	
	//Create query
	$query="select * from posts where id=".$post_id;
	//Run query
	$result=$db->select($query);
	$post=$result->fetch_assoc();
	
	//Create query
	$query="select * from categories";
	//Run query
	$cats=$db->select($query);
?>
<div class="blog-post">
  <h2 class="blog-post-title"><?php echo $post["title"]; ?></h2>
  <p class="blog-post-meta"><?php echo formatDate($post["date"]); ?> by <a href="#"><?php echo $post["author"]; ?></a></p>
  <?php echo $post["body"]; ?>
</div><!-- /.blog-post -->
<?php
	include "includes/footer.php";
?>