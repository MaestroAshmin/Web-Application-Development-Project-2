<?php
$url = '../../data/customer.xml';
$doc = new DomDocument();
$doc->load($url);
ECHO ($doc->saveXML());
?>