<?php
include "header.php";
include "checksession.php";
include "menu.php";
loginStatus(); //show the current login status

include "config.php"; //load in any variables
$DBC = mysqli_connect(DBHOSTNAME, DBUSER, DBPASSWORD, DBDATABASE);

if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

$query = 'SELECT itemID,pizza,pizzatype,price FROM fooditems ORDER BY pizzatype';
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result); 
$order_id = $_GET['id'];
$userid = $_SESSION['userid'];

$query = 'select fooditems.itemID,fooditems.pizza from orderlines inner join fooditems on orderlines.itemID=fooditems.itemID where orderlines.orderID='.$order_id;
$order_info = mysqli_query($DBC,$query);
$items = [];
while ($row = mysqli_fetch_assoc($order_info)) {
    $items[] = $row['itemID']; 
}

echo "<h2>Edit Order #$order_id</h2>";
echo "<form action='updateorder.php' method='post'>";

if ($rowcount > 0) {  
    while ($row = mysqli_fetch_assoc($result)) {
	  $id = $row['itemID'];	
      $name = $row['pizza'];
      $price = $row['price'];
      if(in_array($id, $items)){
          echo "<input type='checkbox' id='$id' name='$id' value='$id' checked>";
      }else{
          echo "<input type='checkbox' id='$id' name='$id' value='$id'>";
      }
      echo "<label for='$id'> $name - $$price</label><br>";
   }
   echo "<input type='submit' id='order-button' value='Update'>";
   echo "<button><a href='listorders.php'>Cancel</a></button>";
    echo "<script>sessionStorage.setItem('userid', $userid); addHiddenOrder()</script>";
    echo "<input type='hidden' name='orderid' value='$order_id' />";
} else echo "<h2>No food items found!</h2>"; //suitable feedback
echo "</form>";

mysqli_free_result($result); //free any memory used by the query
mysqli_close($DBC); //close the connection once done

include "footer.php"; ?>  

