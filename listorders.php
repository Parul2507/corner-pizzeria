<?php
include "header.php";
include "checksession.php";
include "menu.php";
if ($_SESSION['loggedin'] == 0){
    header("Location: ./login_page.php");
    die();
}
loginStatus(); //show the current login status

include "config.php"; //load in any variables
$DBC = mysqli_connect(DBHOSTNAME, DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

$userid = $_SESSION['userid'];

//prepare a query and send it to the server
if(isAdmin()){
    $query = 'SELECT orderID,customerID,orderDatetime,delivaryDate,orderCost FROM orders ORDER By orderDatetime;';
}else{
    $query = "SELECT orderID,customerID,orderDatetime,delivaryDate,orderCost FROM orders where customerID=$userid ORDER By orderDatetime;";
}
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result); 
?>
<h1>Order item list</h1>
<h2><a href="index.php">[Return to main page]</a></h2>
<table border="1">
<thead><tr><th>Order id</th><th>Customer Id</th><th>Order Datetime</th><th>Delivary Datetime</th><th>Order Cost</th><th>Action</th></tr></thead>
<tbody>
<?php

//makes sure we have food items
if ($rowcount > 0) {  
    while ($row = mysqli_fetch_assoc($result)) {
	  $order_id = $row['orderID'];	
	  $customer_id = $row['customerID'];	
	  $orderDate = $row['orderDatetime'];	
	  $delivaryDate = $row['delivaryDate'];	
	  $cost = $row['orderCost'];	
      echo '<tr><td>'.$order_id.'</td><td>'.$customer_id.'</td><td>'.$orderDate.'</td><td>'.$delivaryDate.'</td><td>'.$cost.'</td>';
      echo '<td><a href="vieworder.php?id='.$order_id.'">[view]</a>';
      echo     '<a href="editorder.php?id='.$order_id.'">[edit]</a>';
      echo     '<a href="deleteorder.php?id='.$order_id.'">[delete]</a></td>';
      echo '</tr>'.PHP_EOL;
   }
} else echo "<h2>No order items found!</h2>"; //suitable feedback

mysqli_free_result($result); //free any memory used by the query
mysqli_close($DBC); //close the connection once done

echo "</table>";

include "footer.php"; ?>  
