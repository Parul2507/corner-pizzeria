<?php
include "header.php";
include "checksession.php";
include "menu.php";

include "config.php"; //load in any variables
$DBC = mysqli_connect(DBHOSTNAME, DBUSER, DBPASSWORD, DBDATABASE);

if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

$booking_id = rand(10000, 99999);
$userid = $_POST["userid"];
$phone = $_POST["phone"];
$date = $_POST["date"];
$people = $_POST["people"];

$query = "insert into booking (bookingID, customerID, telephone, bookingdate, people) values ($booking_id, $userid, '$phone', '$date', $people)";
$result = mysqli_query($DBC,$query);

echo "<h1>Booking Created</h1>";

mysqli_close($DBC); //close the connection once done

include "footer.php"; ?>  

