<?php 

    //First we start by starting the session
    session_start();

    //if status not true, redirect to login
    if(!isset($_SESSION["status"])){
        
        header("location:login.php");
    }

    // if logout, destroy session
    if(isset($_POST["submit_logout"])){
        session_unset();
        session_destroy();
        header("location:login.php");
    }

	/* 
		Delete the post that been chosed
	*/
	
	$db = new PDO("mysql:host=localhost;dbname=blog", "root", "root");
	
	if(isset($_POST["delete"])) {
		$stm = $db->prepare("DELETE FROM post WHERE id = :post_id") ;
		$stm->bindParam(":post_id", $_POST["post_id"]);
		
		// if no error accured, redirect to admin 
		if($stm->execute()) {
			header("location:admin.php");
		}
		else {
			 echo "Something went wrong, post not deleted";
		}
	
	}
	// if the edit button were clicked
	
	if(isset($_POST["edit"])) {
		$id = $_POST["post_id"];
		$stm = $db->prepare("SELECT title, text, id FROM post WHERE id = :post_id") ;
		$stm->bindParam(":post_id", $_POST["post_id"]);
		$stm->execute();
		
		while($row = $stm->fetch()) {
			$text = $row['text'];
			$title = $row['title'];
		}
	}
	
	?>
	
	<?php include("incl/header.php"); ?>
	<div id="admin">
		<div id="admin_header">
			<form method="post">
			    <input class="float_right" type="submit" value="logout" name="submit_logout"/>
			</form>
			<ul>
				<li><a href="admin.php">Dashboard</a></li>
				<li><a href="create.php">Create new post </a></li>
				<li><a href="blog.php" target="_blank">Visit blog </a></li>
			</ul>
		</div>
		<div id="admin_edit">
			<form method="post" action="update.php">
				<input type="text" value="<?php echo $title ?>" name="new_title" /> <br/>
				<textarea name="new_text" rows="40" cols="100"> <?php echo $text ?> </textarea> <br/>
				<input type='hidden' name='post_id' value="<?php echo $id ?>"/> 
				<input type="submit" value="Update" name="update" />
	
			</form>
		</div>
		
	</div>
	


