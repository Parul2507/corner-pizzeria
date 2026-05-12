<?php
include "header.php";
include "checksession.php";
include "menu.php";
include "config.php";

$DBC = mysqli_connect(DBHOSTNAME, DBUSER, DBPASSWORD, DBDATABASE);
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

$bookingid = $_POST['bookingid'];	
$customerid = $_POST['userid'];	
$telephone = $_POST['phone'];	
$bookingdate = $_POST['date'];	
$people = $_POST['people'];	

$query = "delete from booking where bookingID=$bookingid";
$result = mysqli_query($DBC,$query);

$query = "insert into booking (bookingID, customerID, telephone, bookingdate, people) values ($bookingid, $customerid, '$telephone', '$bookingdate', $people)";
$result = mysqli_query($DBC,$query);

echo "<h1>Booking #$bookingid Updated</h1>";
echo "<h2><a href='listreservation.php'>[Return to booking list page]</a><a href='index.php'>[Return to main page]</a></h2>";

include "footer.php"; ?>  
