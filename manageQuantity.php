<?php
 $item_id = $_GET["id"];
//  header("Content-Type: text/plain");
$xmlFile = file_get_contents("../../data/goods.xml");
 $HTML = "";
 $dom = new DOMDocument();
 $dom->load('../../data/goods.xml');
 $item = $dom->getElementsByTagName("item"); 
//  $item_list = array();
foreach($item as $node) 
{ 
     $id_Node = $node->getElementsByTagName("item_number");
     $id = $id_Node->item(0)->nodeValue;
    //  echo $id;exit;
     if($id == $item_id){
        $qty_Node = $node->getElementsByTagName("item_qty");
        $available_qty = $qty_Node->item(0)->nodeValue;
        if($available_qty <= 0){
            return $available_qty;
        }
        else{
            $new_qty = $available_qty - 1;
            // $qty_Node->item(0)->nodeValue = $new_qty;
            // echo $qty_Node->item(0)->nodeValue;
            // $dom->saveXML();
            $xml = simplexml_load_string($xmlFile);
            print_r($xml);
            // $xml = simplexml_load_file($xmlFile);
            $obj = $xml->xpath("items");
            // $obj = $xml->xpath("/items/item[item_number='$id']");
            print($obj);exit;
            $obj[0]->item_qty = $new_qty;
            // echo $xml->asXml();

            /* or */ 
            $xml->asXml();
        }
     }
}
?>