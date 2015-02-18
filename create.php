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

	if(isset($_POST["add_post"])) {
	    $db = new PDO("mysql:host=localhost;dbname=blog", "root", "root");
	    $stm = $db->prepare("INSERT INTO post (title, text) VALUES (:title, :text)") ;
	    $stm->bindParam(":title", $_POST["title"], PDO::PARAM_STR);
		$stm->bindParam(":text", $_POST["text"], PDO::PARAM_STR); 
		
		if($stm->execute()) {
			header("location:admin.php");
		}
	}

?>

<?php     include("incl/header.php"); ?>

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
		<form method="post">
			<input type="text" placeholder="Title" name="title" /><br/>
			<textarea name="text" rows="40" cols="100"> </textarea><br/>
			<input type="submit" value="Publish" name="add_post" />
		</form>
	
	</div>
	
</div>