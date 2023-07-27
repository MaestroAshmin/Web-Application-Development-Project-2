<?php 
$xmlDoc = new DomDocument; 
$xmlDoc->load("../../data/goods.xml"); 
$xslDoc = new DomDocument; 
$xslDoc->load("xsl/goods.xsl"); 
$proc = new XSLTProcessor; 
$proc->importStyleSheet($xslDoc); 
echo $proc->transformToXML($xmlDoc); 
?>