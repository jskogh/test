<?php
	/* 
		an admin panel where you gonna be able to see posts, edit and delete them
		
		1. Check if you are logged in
		2. Display admin panel. Post title and date, with two options. Delete or edit. 
		3. If deletebutton pushed, delete post from db
		4. if edit button, go to new page where post is displayed
		
	*/

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
    
    include("incl/header.php");
    
    $db = new PDO("mysql:host=localhost;dbname=blog", "root", "root");
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$stm = $db->prepare("SELECT title, date, id FROM post");
	$table = "";
if($stm->execute()){
    while($row = $stm->fetch()){
    	$table .= "<tr>";
        $table .= "<td>" . $row["title"] . "</td>";
        $table .= "<td>" . $row["date"] . "</td>";
        $table .= "<form method='post' action='delete.php'>";
        $table .= "<input type='hidden' name='post_id' value='". $row['id'] . "'/>";
        $table .= "<td> <input type='submit' value='edit' name='edit' /> </td>";
        $table .= "<td> <input type='submit' value='delete' name='delete' /> </td>";
        $table .= "</form> </tr>";
    }

}
else{
    //If error, print the log!
    print_r($stm->errorInfo());
}
?>
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
	<div id="admin_panel">
		<table>
			<tr>
				<th>Title</th>
				<th>Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php echo $table ?>
			
		
		</table>

	
	</div>
	
</div>