<?php
include "header.php";
include "checksession.php";
include "menu.php";
include "config.php"; //load in any variables

$DBC = mysqli_connect(DBHOSTNAME, DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

//do some simple validation to check if id exists
$id = $_GET['id'];
if (empty($id) or !is_numeric($id)) {
 echo "<h2>Invalid Order ID</h2>"; //simple error feedback
 exit;
} 

//prepare a query and send it to the server
//NOTE for simplicity purposes ONLY we are not using prepared queries
//make sure you ALWAYS use prepared queries when creating custom SQL like below
$query = 'select fooditems.pizza from orderlines inner join fooditems on orderlines.itemID=fooditems.itemID where orderlines.orderID='.$id;
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result); 
?>
<h1>Order Details View</h1>
<h2><a href='listorders.php'>[Return to the order listing]</a><a href='/pizza/'>[Return to the main page]</a></h2>
<?php

//makes sure we have the Food Item
if ($rowcount > 0) {  
    echo "<fieldset><legend>Order item detail #$id</legend><dl>"; 
    echo "<dt>Pizza List:</dt><dd><ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        $pizza = $row['pizza'];
        echo "<li>$pizza</li>";
    }
    echo "</ul></dd></dl>";
} else echo "<h2>No order found!</h2>"; //suitable feedback

mysqli_free_result($result); //free any memory used by the query
mysqli_close($DBC); //close the connection once done

include "footer.php"; 
?>
