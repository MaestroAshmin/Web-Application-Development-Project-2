<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BuyOnline Manager System</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
$login_success = false;
if(empty($customerNumberErr) && empty($passwordErr)){
	$managers = file("../../data/manager.txt", FILE_SKIP_EMPTY_LINES);
	//print_r($_POST);
	//print_r($managers);
	$pieces = array();
	foreach($managers as $manager){
		$pieces = explode(", ", $manager);
		//print_r($pieces);
		$manager_idErr = "Please Check Manager id and password!";
		if($pieces[0] == $manager_id){
$manager_idErr = "";
			//print("manager id match");
			//echo(strlen(trim($pieces[1])));
//echo(strlen($password));
			if(trim($pieces[1]) == $password){

			//print("password match");
				session_start();
				$_SESSION['manager_id'] = $_POST["manager_id"];
				$login_success = true;
				//$redirect_url = "mlogin.htm?manager_id=".$_SESSION['manager_id'];
				//header('Location:'.$redirect_url);

			}
 			else{
 				$passwordErr = "Please Check Manager id and password!";
			}
		break;
		}
		else{
			//$manager_idErr = "Manager ID does not exist!";
		}
	}
        
	}
//$manager_idErr = "Manager ID does not exist!";

}

?>
    <div class="container">
      <h2 class="d-flex justify-content-center">
        BuyOnline Manager Login Page
      </h2>
      <div class="form-component">
        <form
          action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          name="mlogin_form"
          method="post"
          enctype="multipart/formdata"
          onsubmit = "return validateInput()"
        >
          <div class="form-element">Manager ID:</label>
            <input
              type="text"
              name="manager_id"
              class="form-control"
              id="manager_id"
            />
          </div>
	<?php
              if(!empty($manager_idErr)){ ?>
          <div class="error" id="manager_idErr"><?php echo $manager_idErr;?></div>
<?php }?>
          <div class="form-element">
            <label for="password" class="form-label">Password:</label>
            <input
              type="password"
              name="password"
              class="form-control"
              id="password"
            />
          </div>
<?php
              if(!empty($passwordErr)){ ?>
          <div class="error" id="passwordErr"><?php echo $passwordErr;?></div>
<?php }?>
          <button
            type="submit"
            name="submit"
            value="submit"
            class="btn btn-primary"
          >
            Log in
          </button>
          <br />
<?php
session_start();
if(isset($_SESSION['manager_id'])){ ?>
<a href="listing.php">Listing</a><br /><a href="processing.php">Processing</a>
<?php } ?>
          <span id="success"></span>
        </form>
      </div>
      <a href="buyonline.htm"  class="d-flex justify-content-center">Home</a>
    </div>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
      integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"
    ></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            generateSuccessMessage();
        });

        function generateSuccessMessage() {
            var url = window.location.href;
            var newUrl = new URL(url);
            var search_params = new URLSearchParams(newUrl.search);
            if (search_params.has("manager_id")) {
            var get_customer_number = search_params.get("manager_id");
            var listing_page_url = "listing.php";
            var processing_page_url = "processing.php";
            var successMessage ="<a href=" +listing_page_url +
                ">Listing</a><br /><a href="+processing_page_url+">Processing</a>";
            printError("success", successMessage);
            }
        }
            function printError(elemId, errorMessage) {
                document.getElementById(elemId).innerHTML = errorMessage;
            }
        //function validateInput() {
            //var manager_id = document.forms["mlogin_form"]["manager_id"].value;
            //var password = document.forms["mlogin_form"]["password"].value;
            //console.log(manager_id, password);
            //if (manager_id == "" || password == "") {
            //manager_idErr = true;
            //printError("manager_idErr", "Please enter your manager id");
            //passwordErr = true;
            //printError("passwordErr", "Please enter your password");
            //}
		//else {
                //var request = new XMLHttpRequest();
                //request.open("GET", "getManager.php", false);
                //request.onreadystatechange = function ()
                //{
                    //if (request.readyState == 4 && request.status == 200) {
                            //var responseText = request.responseText;
                            //var managers = responseText.split("\n");
                            //console.log(managers.length);
                            //for(var i = 0; i < managers.length; i++){
                                //var manager_id = document.forms["mlogin_form"]["manager_id"].value;
                                //var password = document.forms["mlogin_form"]["password"].value;
                                //var manager = managers[i].split(", ");
                                //console.log(manager_id);
                                //console.log(manager[0]);
                                //console.log(password.length);
                                //console.log(manager[1].trim().length);
                                //if(manager_id == manager[0] && password == manager[1].trim()){
                                    //manager_id = false;
                                    //passwordErr = false;
                                    // alert("login");
                                    //break;
                                //}
                                //else{
                                    //console.log('fail');
                                    //manager_idErr = true;
                                    //passwordErr = true;
                                   // printError("manager_idErr", "Please check your manager id");
                                    //printError("passwordErr", "Please check your password");
                                //}
                            //}
                        //}
                    //}
                //request.send(null);
            //}
            function myFunction(manager_detail){
                // alert(manager_detail);
                var manager_id = document.forms["mlogin_form"]["manager_id"].value;
                var password = document.forms["mlogin_form"]["password"].value;
                var manager = manager_detail.split(", ");
                console.log(manager_id, password, manager[0], manager[1]);
                if(manager_id == manager[0] && password == manager[1]){
                    manager_id = false;
                    passwordErr = false;
                    // var successMessage =
                    // "<a href=" +
                    // listing.htm +
                    // ">Listing</a> <br /> <a href="+processing.htm+">Processing</a>";
                    // print_r("success", successMessage);
                    // alert("login");
                    // break;
                }
                else{
                    manager_idErr = true;
                    passwordErr = true;
                    printError("manager_idErr", "Please check your manager id");
                    printError("passwordErr", "Please check your password");
                }
            }

            // if (password == "") {
            //   passwordErr = true;
            //   printError("passwordErr", "Please enter your password");
            // } else {
            //   printError("passwordErr", "");
            //   passwordErr = false;
            // }
            //if (
            //(manager_idErr || passwordErr) == true
            //) {
            //return false;
            //}
        //}
    </script>
  </body>
</html>
