<?php

    require_once "functions.php";

    if(isset($_POST["submit_login"])){
        $result = login($_POST["email"], $_POST["password"]);
        if($result) {
            header("location:admin.php");
        }
        else{
            $errorMsg = "Wrong password or username";
        }
    }
    
    	include("incl/header.php"); 
?>


<div id="login">
<h1>LOGIN</h1>
<form method="post">
    <input type="text" name="email" placeholder="email"/><br/>
    <input type="password" name="password" placeholder="password"/><br/>
    <input type="submit" name="submit_login" value="Login"/>	
</form>
<p><?php if(isset($errorMsg)) echo $errorMsg ?></p>

</div>