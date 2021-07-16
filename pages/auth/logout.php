<?php
if (isset($_SESSION["user"])) {
    session_start();
    session_destroy();
    header("Location: ./login.php");
} else if (isset($_SESSION["admin"])) {
    session_start();
    session_destroy();
    header("Location: ./loginadmin.php");
} else {
    session_start();
    session_destroy();
    header("Location: ./loginmanager.php");
}
