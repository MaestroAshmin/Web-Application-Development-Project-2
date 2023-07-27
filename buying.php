<?php
session_start();
// print_r($_SESSION);exit;
if(empty($_SESSION["customer_id"])){
  header('Location: buyonline.htm');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Buying</title>
  </head>
  <body onload="getItems()">
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
      <div
        class="collapse navbar-collapse d-flex justify-content-center align-items-center"
        id="navbarNav"
      >
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="logout-user.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <h3 id="message"></h3>
    <span id="items"></span>
    <table id="table-header" border="1"></table>

    <script>
      var xhr = false;
      if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
      } else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
      }

      function getItems() {
        document.getElementById("message").innerText = "";
        xhr.open("POST", "buying-backend.php?id=" + Number(new Date()), true);
        xhr.onreadystatechange = getData;
        xhr.send(null);
      }

      function getData() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var html = xhr.responseText;
          document.getElementById("items").innerHTML = html;
        }
      }
      // Sets refresh interval to 10 seconds
      setInterval(function () {
        document.getElementById("message").innerText = "Retrieving Items...";
        document.getElementById("items").innerHTML = "";
        getItems();
      }, 10000);
      var newxhr = false;
      if (window.XMLHttpRequest) {
        newxhr = new XMLHttpRequest();
      } else if (window.ActiveXObject) {
        newxhr = new ActiveXObject("Microsoft.XMLHTTP");
      }
      function get_qty_available(item_id) {
        newxhr.open("GET", "manageQuantity.php?id=" + item_id, true);
        // newxhr.onreadystatechange = getQuantity(item_id);
        newxhr.send(null);
      }
      // function getQuantity(item_id) {
      //   alert(item_id);
      //   if (newxhr.readyState == 4 && newxhr.status == 200) {
      //     var xml = newxhr.responseXML;
      //     console.log(xml);
      //   }
      // }
      // Add to cart
      function addToCart(action) {
        var id = document.getElementById("item_number").innerHTML;
        var name = document.getElementById("item_name").innerHTML;
        var price = document.getElementById("item_price").innerHTML;
        var qty = document.getElementById("item_qty").innerHTML;
        get_qty_available(id);
        if (action == "Add") {
          xhr.open(
            "GET",
            "manageCart.php?action=" +
              action +
              "&name=" +
              encodeURIComponent(name) +
              "&value=" +
              Number(new Date()) +
              "&price=" +
              price +
              "&id=" +
              id +
              "&qty=" +
              qty,
            true
          );
        } else {
          xhr.open(
            "GET",
            "manageCart.php?action=" +
              action +
              "&name=" +
              encodeURIComponent(name) +
              "&value=" +
              Number(new Date()) +
              "&price=" +
              price +
              "&id=" +
              id +
              "&qty=" +
              qty,
            true
          );
        }

        xhr.onreadystatechange = getCart;
        xhr.send(null);
      }
      function getCart() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          //alert(xHRObject.responseText);
          var serverResponse = xhr.responseXML;
          var header = serverResponse.getElementsByTagName("item");
          var tableDiv = document.getElementById("table-header");
          tableDiv.innerHTML = "";
          for (i = 0; i < header.length; i++) {
            tableDiv.innerHTML +=
              "<table><tr bgcolor='grey'><th>TITLE</th><th>Item Number</th><th>Quantity</th><th>Price</th><th>Total</th><th>ACTION</th></tr><tr><td>" +
              header[0].firstChild.textContent +
              "</td><td>" +
              header[0].childNodes[1].textContent +
              "</td><td>" +
              header[0].childNodes[2].textContent +
              "</td><td>" +
              header[0].childNodes[3].textContent +
              "</td><td>" +
              header[0].lastChild.textContent +
              "</td><td>" +
              "<a href='#' onclick='addToCart(\"Remove\");'>Remove Item</a>" +
              "</td></tr></table>";
          }
        }
      }
    </script>
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
  </body>
</html>
