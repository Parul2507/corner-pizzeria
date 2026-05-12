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
    $query = 'select bookingID,customerID,telephone,bookingdate,people from booking';
}else{
    $query = "select bookingID,customerID,telephone,bookingdate,people from booking where customerID=$userid";
}
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result); 
?>
<h1>Bookings list</h1>
<h2><a href="index.php">[Return to main page]</a></h2>
<table border="1">
<thead><tr><th>Booking id</th><th>Customer Id</th><th>Booking Datetime</th><th>Telephone</th><th>Party Size</th><th>Action</th></tr></thead>
<tbody>
<?php

//makes sure we have food items
if ($rowcount > 0) {  
    while ($row = mysqli_fetch_assoc($result)) {
	  $bookingid = $row['bookingID'];	
	  $customerid = $row['customerID'];	
	  $telephone = $row['telephone'];	
	  $bookingdate = $row['bookingdate'];	
	  $people = $row['people'];	
      echo '<tr><td>'.$bookingid.'</td><td>'.$customerid.'</td><td>'.$bookingdate.'</td><td>'.$telephone.'</td><td>'.$people.'</td>';
      echo '<td><a href="editbooking.php?id='.$bookingid.'">[edit]</a>';
      echo     '<a href="deletebooking.php?id='.$bookingid.'">[delete]</a></td>';
      echo '</tr>'.PHP_EOL;
   }
} else echo "<h2>No booking items found!</h2>"; //suitable feedback

mysqli_free_result($result); //free any memory used by the query
mysqli_close($DBC); //close the connection once done

echo "</table>";

include "footer.php"; ?>  
