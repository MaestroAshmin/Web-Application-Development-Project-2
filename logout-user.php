<?php
session_start();
// print_r($_SESSION);exit;
$customer_id = $_SESSION['customer_id'];
session_destroy();
$redirectURL = "logout.htm?id=".$customer_id;
header('Location:'.$redirectURL);
?>