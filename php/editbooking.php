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

$bookingid = $_GET['id'];
$query = "select * from booking where bookingID=$bookingid";
$booking_info = mysqli_query($DBC,$query);
$row = mysqli_fetch_assoc($booking_info);

$bookingid = $row['bookingID'];	
$customerid = $row['customerID'];	
$telephone = $row['telephone'];	
$bookingdate = $row['bookingdate'];	
$people = $row['people'];	

echo "<h2>Edit Booking #$bookingid</h2>";
echo "<form action='updatebooking.php' method='post'>";

echo "<br><label for='phone'><b>Telephone No.:</b></label><input type='text' placeholder='###-###-####' name='phone' required value=$telephone><br>";

echo "<br><label for='date'><b>Booking Date:</b></label><input type='date' name='date' required value=$bookingdate><br>";

echo "<br><label for='people'><b>Party Size:</b></label><input type='people' name='people' required value=$people><br>";

echo "<input type='hidden' name='bookingid' value='$bookingid' />";
echo "<input type='hidden' name='userid' value='$customerid' />";

echo "<br><button type='submit' id='book-button'>Update</button><br>";

echo "<br>";

echo "</form>";

mysqli_close($DBC); //close the connection once done

include "footer.php"; ?>  

