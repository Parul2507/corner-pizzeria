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
$email = $_POST["email"];
$password = $_POST["password"];
$query = "select customerID,firstname,lastname from customer where email='$email' and password='$password'";
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result); 
if ($rowcount > 0) {  
    $userid = "";
    $username = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $userid = $row['customerID'];
        $username = $row['firstname'];
    }
    echo "<h1>Logged in as $username</h1>";
    $_SESSION['loggedin'] = 1;     
    $_SESSION['userid'] = $userid; //this is the ID for the admin user  
    $_SESSION['username'] = $username;
}
else{
    echo "<h1>Invalid email or password</h1>";
}

mysqli_close($DBC); //close the connection once done

include "footer.php"; ?>  

