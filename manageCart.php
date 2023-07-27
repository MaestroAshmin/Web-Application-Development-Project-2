<?php
session_start();
header('Content-Type: text/xml');
?>
<?php
		if(!isset($_SESSION["Cart"])){
			$_SESSION["Cart"] = "";
		}
		$newitem = $_GET["name"];
        $id = $_GET["id"];
		$qty = $_GET["qty"];
		$price = $_GET["price"];
		$action = $_GET['action'];

        if ($_SESSION["Cart"] != "")
        {
            $MDA = $_SESSION["Cart"];
            if ($action == "Add")
            {
                if ($MDA[$newitem] != "")
                {  	
        	        $value = $MDA[$newitem];
					$value['qty'] = $value['qty'] + 1;
					$value['total']	= $value['qty']* $value['price'];
					$value['id'] = $id;
					$MDA[$newitem] = $value;
					$_SESSION["Cart"] = $MDA;		
                }
                else
                {
					$value = array();
					$value['qty'] = 1;
					$value['id']= $id;
					$value['price'] = $price;
					$value['total'] = $price;
					$MDA = array();
					$MDA[$newitem] = $value;
					$_SESSION["Cart"] = $MDA;
                }
            }
            else
            {
				$value = $MDA[$newitem];
				$value['qty'] = $value['qty'] - 1;
				$value['price']	= $price;
				$value['id']= $id;
				$value['total'] = $value['qty'] * $price;
				if($value['qty'] <= 0){
					$_SESSION["Cart"] = "";
					$MDA = "";
					
				}
				else{
					
					$MDA[$newitem] = $value;
					$_SESSION["Cart"] = $MDA;
				}	
            }
        }
        else
        {
            $value = array();
			$value['qty'] = 1;
			$value['price']= $price;
			$value['total'] = $price;
			// $value['name'] = $newitem;
			$value['id'] = $id;
			$MDA = array();
			$MDA[$newitem] = $value;
        }
        $_SESSION["Cart"] = $MDA;
        ECHO (toXml($MDA));         								
    function toXml($shop_cart)
    {
        $doc = new DomDocument('1.0');
        $cart = $doc->createElement('cart');
        $doc->appendChild($cart);
        if($shop_cart != ""){

			foreach ($shop_cart as $item => $itemName)
			{
				$items = $doc->createElement('item');
				$cart->appendChild($items);

				$title = $doc->createElement('item_name'); 
				$title = $items->appendChild($title);   
				$value = $doc->createTextNode($item);
				$value = $title->appendChild($value);

				$item_id = $doc->createElement('item_id'); 
				$item_id = $items->appendChild($item_id);   
				$value = $doc->createTextNode($itemName['id']);
				$value = $item_id->appendChild($value);

				

				$quantity = $doc->createElement('quantity');
				$quantity = $items->appendChild($quantity);
				$value2 = $doc->createTextNode($itemName['qty']);
				$value2 = $quantity->appendChild($value2);

				$price = $doc->createElement('price');
				$price = $items->appendChild($price);
				$value4 = $doc->createTextNode($itemName['price']);
				$value4 = $price->appendChild($value4);

				$total = $doc->createElement('total');
				$total = $items->appendChild($total);
				$value3 = $doc->createTextNode($itemName['total']);
				$value3 = $total->appendChild($value3);
				
				


			}
			
		}
        
        $strXml = $doc->saveXML(); 
        return $strXml;
    }
?>
