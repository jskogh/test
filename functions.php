<?php
function login($email, $password){
    $db = new PDO("mysql:host=localhost;dbname=blog", "root", "root");
    $stm = $db->prepare("SELECT * FROM user WHERE email = :email AND password = :password");
    $stm->bindParam(":email", $email, PDO:: PARAM_STR);
    $stm->bindParam(":password", $password, PDO:: PARAM_STR);
    $stm->execute();

    if($stm->rowCount() == 1){
        session_start();
        $_SESSION["status"] = "inloggad";
        return true;
    }
    else{
        return false;
    }
}

function logout(){

}
