<?php

// Save manager id in session 

// // get data .. Discard this. Changed to check by using JS later rather than PHP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
print_r($_POST);
if(isset($_POST['submit'])){

if (empty($_POST["manager_id"])) {  
$manager_idErr = "Manager ID is Required";  
} else {  
$manager_id = $_POST["manager_id"];  
} 
if (empty($_POST["password"])) {  
$passwordErr = "Password is required";  
}
else{
$password = $_POST['password'];
}
            
}
else{
echo 'false';
}

if(empty($customerNumberErr) && empty($passwordErr)){
	$managers = file("../../data/manager.txt", FILE_SKIP_EMPTY_LINES);
	print_r($managers);
	$pieces = array();
	foreach($managers as $manager){
		$pieces = explode(", ", $manager);
		print_r($pieces);
		if($pieces[0] == $manager_id){
			if($pieces[1] == $password){
				session_start();
				$_SESSION['manager_id'] = $_POST["manager_id"];
				//$redirect_url = "mlogin.htm?manager_id=".$_SESSION['manager_id'];
				//header('Location:'.$redirect_url);

			}
 			else{
 				$passwordErr = "Wrong Password!";
			}
		}
		else{
			$manager_idErr = "Manager ID does not exist!";
		}
	}
        
	}

}

?>