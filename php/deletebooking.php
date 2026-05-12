<?php
include "header.php";
include "checksession.php";
include "menu.php";
include "config.php"; //load in any variables
loginStatus(); //show the current login status
$DBC = mysqli_connect(DBHOSTNAME, DBUSER, DBPASSWORD, DBDATABASE);
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $query = "delete from booking where bookingID=$id";
    $result = mysqli_query($DBC,$query);
    echo "<h2>Booking #$id deleted.</h2>";     
}

echo "<h2><a href='listreservation.php'>[Return to booking list page]</a><a href='index.php'>[Return to main page]</a></h2>";
mysqli_close($DBC); //close the connection once done
include "footer.php"; ?>  
