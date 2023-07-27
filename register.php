<?php
    $xmldoc = new DOMDocument();
    $xmldoc->formatOutput=true;
    if(file_exists('../../data/customer.xml')){
        $xmldoc->formatOutput=true;
        $xmldoc->load('../../data/customer.xml');
        $customers = $xmldoc->documentElement;
        // print_r($customers);
    } else {
        // $xmldoc->loadXML('<customers/>');
        $customers = $xmldoc->createElement("customers");
        $xmldoc->appendChild($customers);

    }
    $customer = $xmldoc->createElement("customer");
    $customer_id = "CUSID".rand(0,getrandmax());
    $customer->setAttribute("customer_id",$customer_id);
    $customers->appendChild($customer);
    
    // First Name
    $first_name = $_POST['first_name'];
    $first_nameEl = $xmldoc->createElement("firstname",$first_name);
    $customer->appendChild($first_nameEl);

    // Surname
    $sur_name = $_POST['last_name'];
    $sur_nameEl = $xmldoc->createElement("surname",$sur_name);
    $customer->appendChild($sur_nameEl);

    // Email
    $email = $_POST['email'];
    $emailEl = $xmldoc->createElement("email",$email);
    $customer->appendChild($emailEl);

    // Password
    $password = $_POST['password'];
    $passwordEl = $xmldoc->createElement("password",$password);
    $customer->appendChild($passwordEl);
    
    // Contact
    $contact = $_POST['contact_phone'];
    $contactEl = $xmldoc->createElement("contact",$contact);
    $customer->appendChild($contactEl);

    // echo "<xmp>".$xmldoc->saveXML()."</xmp>";
    $xmldoc->save("../../data/customer.xml")  or die;
    $redirect_url = "register.htm?customer_number=".$customer_id;
    header('Location:'.$redirect_url);
    // header("Location: register.htm");
?>