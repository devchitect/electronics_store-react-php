<?php 
    require("models/admin.php");

    $signin = new SignIn();
    $userdata = null;

    if(isset($_REQUEST["username"])){

        $user = $_REQUEST["username"];
        $pass = $_REQUEST["password"];

        $result = $signin -> getAdmin($user,$pass);
        if ($result == true){
            $userdata = $signin -> data;
        }

        if ($userdata != null){
            $_SESSION["status"] = "Signed In";
            $_SESSION["name"] = $userdata["firstname"] . " " . $userdata["lastname"];
            
        }else{
            $_SESSION["noti"] = "Username or Password incorrect!";
        }; 
    }
  
?>