<?php
    $server = $_SERVER['SERVER_NAME'];
    $port ="3000";

    header('Access-Control-Allow-Origin: http://'.$server.":".$port);
    header("Access-Control-Allow-Headers: *, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Credentials: true");

?>