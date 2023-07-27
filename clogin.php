<?php

 session_start();
 $customer_email = $_POST["email"];
 $xmlFile = "../../data/customer.xml";
 $HTML = "";
 //$dt = simplexml_load_file($xmlFile);
 //$dom = DOMDocument::load($xmlFile);
 $dom = new DOMDocument();
 $dom->load('../../data/customer.xml');
 $customer = $dom->getElementsByTagName("customer"); 
 $customerList = array();
foreach($customer as $node) 
{ 
     $emailNode = $node->getElementsByTagName("email");
     $email = $emailNode->item(0)->nodeValue;
     if($email == $customer_email){
        $customer_id = $node->getAttribute('customer_id');
     }
}
$_SESSION['customer_id'] = $customer_id;
$redirect_url = "buying.php?customer_id=".$customer_id;
header('Location:'.$redirect_url);
?>