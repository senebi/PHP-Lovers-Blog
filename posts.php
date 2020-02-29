<?php
	include "includes/header.php";
	
	//Create DB object
	$db=new Database();
	
	//Create query
	$query="select * from posts order by date desc";
	
	//Check URL for category
	if(isset($_GET["category"])){
		$cat_id=$db->link->real_escape_string($_GET["category"]);
		$query.=" where category=".$cat_id;
		//Create category check query
		$check_cat="select * from categories where id=".$cat_id;
		//Run query
		$check_res=$db->select($check_cat);
	}
	//Run query
	$posts=$db->select($query);
	
	//Create query
	$query="select * from categories";
	//Run query
	$cats=$db->select($query);
	
	if(isset($_GET["category"]) && !$check_res){
		echo "<p>There is no such category.</p>";
	}
	else{
		if($posts){
			while($post=$posts->fetch_assoc()){
				?>
				<div class="blog-post">
				  <h2 class="blog-post-title"><?php echo $post["title"]; ?></h2>
				  <p class="blog-post-meta"><?php echo formatDate($post["date"]); ?> by <a href="#"><?php echo $post["author"]; ?></a></p>
				  <?php echo shortenText($post["body"]); ?>
				  <a class="readmore" href="post.php?id=<?php echo urlencode($post["id"]); ?>">Read More</a>
				</div><!-- /.blog-post -->
				<?php
			}
		}
		else{
	?>
		<p>There are no posts yet.</p>
	<?php
		}
	}
	include "includes/footer.php";
?>