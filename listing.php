<?php
session_start();
if(empty($_SESSION)){
  header('Location: mlogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Item Listing</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse  d-flex justify-content-center align-items-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link  active" href="listing.php"
              >Listing</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="processing.php">Processing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Item Form -->
    <form id="listing_form" method="post" name="listing_form" onsubmit="return validateInput()" action="additem.php">
      <div class="form-group row">
        <label for="item_name">Item Name:</label>
        <input type="text" class="form-control" name="item_name" id="item_name">
      </div>
      <div class="error" id="item_nameErr"></div>
      <div class="form-group row">
        <label for="item_price">Item Price:</label>
        <input type="text" class="form-control" id="item_price" name="item_price">
      </div>
      <div class="error" id="item_priceErr"></div>
      <div class="form-group row">
        <label for="item_qty">Item Quantity</label>
        <input type="number" min="0" class="form-control" id="item_qty" name="item_qty">
      </div>
      <div class="error" id="item_qtyErr"></div>
      <div class="form-group row" style="margin-bottom: 30px;">
        <label for="item_description">Item Description</label>
        <textarea rows="3" class="form-control" id="item_description" name="item_description"></textarea>
      </div>
      <div class="error" id="item_descriptionErr"></div>
      <input type="submit" name="submit" value="Add Item" class="btn btn-primary" />
      <input type="reset" name="reset" value="Reset" class="btn btn-danger"></input>
      <br />
      <span id="success"></span>
    </form>

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
        if (search_params.has("item_number")) {
          var get_item_number = search_params.get("item_number");
          var successMessage =
            "The item has been listed in the system, and the item number is: " +
            get_item_number;
          printError("success", successMessage);
        }
      }
      function resetForm(){
        alert("clicked reset");
        document.getElementById("listing_form").reset();
      }
        function printError(elemId, errorMessage) {
        document.getElementById(elemId).innerHTML = errorMessage;
      }
      function validateInput() {
        var item_name = document.forms["listing_form"]["item_name"].value;
        let item_price = document.forms["listing_form"]["item_price"].value;
        var item_qty = document.forms["listing_form"]["item_qty"].value;
        var item_description = document.forms["listing_form"]["item_description"].value;
        console.log(item_name, item_price, item_qty, item_description);
        if (item_name == "") {
          item_nameErr = true;
          printError("item_nameErr", "Please enter the name of the item");
        } else {
          printError("item_nameErr", "");
          item_nameErr = false;
        }

        if (item_price == "") {
          item_priceErr = true;
          printError("item_priceErr", "Please enter the price for each unit of the item");
        } else {
          printError("item_priceErr", "");
          item_priceErr = false;
        }

        if (item_qty == "") {
          item_qtyErr = true;
          printError("item_qtyErr", "Please enter the number of available units");
        } else {
          printError("item_qtyErr", "");
          item_qtyErr = false;
        }

        if (item_description == "") {
          item_descriptionErr = true;
          printError("item_descriptionErr", "Please enter a brief description for the item");
        } else {
          printError("item_descriptionErr", "");
          item_descriptionErr = false;
        }
        if (
          (item_nameErr ||
            item_priceErr ||
            item_qtyErr ||
            item_descriptionErr) == true
        ) {
          printError("success", "");
          return false;
        }
      }
    </script>
  </body>
</html>
