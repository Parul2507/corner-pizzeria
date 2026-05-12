<?php
include "header.php";
include "checksession.php";
include "menu.php";

if ($_SESSION['loggedin'] == 0){
    header("Location: ./login_page.php");
    die();
}
$userid = $_SESSION['userid'];

include "config.php"; //load in any variables
$DBC = mysqli_connect(DBHOSTNAME, DBUSER, DBPASSWORD, DBDATABASE);

if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

$query = 'SELECT itemID,pizza,pizzatype,price FROM fooditems ORDER BY pizzatype';
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result); 

echo "<h1>Place and order</h1>";
echo "<form action='place_order.php' method='post'>";

if ($rowcount > 0) {  
    while ($row = mysqli_fetch_assoc($result)) {
	  $id = $row['itemID'];	
      $name = $row['pizza'];
      $price = $row['price'];
      echo "<input type='checkbox' id='$id' name='$id' value='$id'>";
      echo "<label for='$id'> $name - $$price</label><br>";
   }
   echo "<input type='submit' id='order-button'>";
    echo "<script>sessionStorage.setItem('userid', $userid); addHiddenOrder()</script>";
} else echo "<h2>No food items found!</h2>"; //suitable feedback
echo "</form>";

mysqli_free_result($result); //free any memory used by the query
mysqli_close($DBC); //close the connection once done

include "footer.php"; ?>  

