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
	
	$db = new PDO("mysql:host=localhost;dbname=blog", "root", "root");			
	$stm = $db->prepare("UPDATE post SET text= :text, title= :title WHERE id= :post_id");
	$stm->bindParam(":post_id", $_POST['post_id']) ;
	$stm->bindParam(":text", $_POST['new_text']) ;
	$stm->bindParam(":title", $_POST['new_title']) ;
	
	if($stm->execute()){
	

    	header("location:admin.php");
    }
    else{
    	echo "something went wrong";
    		print_r($stm->errorInfo());
    }
			
	
	
?>