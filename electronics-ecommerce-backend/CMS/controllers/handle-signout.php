<?php
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
?>