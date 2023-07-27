<?php
    $xmldoc = new DOMDocument();
    $xmldoc->formatOutput=true;
    if(file_exists('../../data/goods.xml')){
        $xmldoc->formatOutput=true;
        $xmldoc->load('../../data/goods.xml');
        $items = $xmldoc->documentElement;
        // print_r($customers);
    } else {
        // $xmldoc->loadXML('<customers/>');
        $items = $xmldoc->createElement("items");
        $xmldoc->appendChild($items);

    }
    $item = $xmldoc->createElement("item");
    $items->appendChild($item);
    
    // Item Number
    $item_number = "ITNUM".rand(0,getrandmax());
    $item_numberEl = $xmldoc->createElement("item_number",$item_number);
    $item->appendChild($item_numberEl);
    // Item Name
    $item_name = $_POST['item_name'];
    $item_nameEl = $xmldoc->createElement("item_name",$item_name);
    $item->appendChild($item_nameEl);

    // Price
    $item_price = $_POST['item_price'];
    $item_priceEl = $xmldoc->createElement("item_price",$item_price);
    $item->appendChild($item_priceEl);

    //Available Quantity
    $item_qty = $_POST['item_qty'];
    $item_qtyEl = $xmldoc->createElement("item_qty",$item_qty);
    $item->appendChild($item_qtyEl);

    //Quantity Hold
    $qty_hold = 0;
    $qty_holdEl= $xmldoc->createElement("qty_hold",$qty_hold);
    $item->appendChild($qty_holdEl);

    //Quantity Sold
    $qty_sold = 0;
    $qty_soldEl = $xmldoc->createElement("qty_sold",$qty_sold);
    $item->appendChild($qty_soldEl);
    // Description
    $item_description = $_POST['item_description'];
    $item_descriptionEl = $xmldoc->createElement("item_description",$item_description);
    $item->appendChild($item_descriptionEl);

    $xmldoc->save("../../data/goods.xml")  or die;
    $redirect_url = "listing.php?item_number=".$item_number;
    header('Location:'.$redirect_url);
?>