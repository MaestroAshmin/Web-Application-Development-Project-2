<?php
session_start();
$manager_id = $_SESSION['manager_id'];
session_destroy();
$redirectURL = "logout.htm?id=".$manager_id;
header('Location:'.$redirectURL);
?>