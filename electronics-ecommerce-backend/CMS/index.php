<?php 
    session_start();

    $status = isset($_SESSION["status"]) ? $_SESSION["status"] : "";

    if(isset($_POST["signin"])){
        require("controllers/handle-signin.php");
        header("Location: ".$_SERVER['PHP_SELF']);
    }

    switch($status){
        case "Signed In":
            require("controllers/main-controller.php");
            break;
        default:
            require("views/signin.php");
            break;
    }

?>

