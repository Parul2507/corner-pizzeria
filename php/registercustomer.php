<?php
include "header.php";
include "checksession.php";
include "menu.php";
//function to clean input but not validate type and content
function cleanInput($data) {  
  return htmlspecialchars(stripslashes(trim($data)));
}

//the data was sent using a formtherefore we use the $_POST instead of $_GET
//check if we are saving data first by checking if the submit button exists in the array
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Register')) {
//if ($_SERVER["REQUEST_METHOD"] == "POST") { //alternative simpler POST test    
    include "config.php"; //load in any variables
    $DBC = mysqli_connect(DBHOSTNAME, DBUSER, DBPASSWORD, DBDATABASE);

    if (mysqli_connect_errno()) {
        echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
        exit; //stop processing the page further
    };

//validate incoming data - only the first field is done for you in this example - rest is up to you do
//firstname
    $error = 0; //clear our error flag
    $msg = 'Error: ';
    if (isset($_POST['firstname']) and !empty($_POST['firstname']) and is_string($_POST['firstname'])) {
       $fn = cleanInput($_POST['firstname']); 
       $firstname = (strlen($fn)>50)?substr($fn,1,50):$fn; //check length and clip if too big
       //we would also do context checking here for contents, etc       
    } else {
       $error++; //bump the error flag
       $msg .= 'Invalid firstname '; //append eror message
       $firstname = '';  
    } 
//lastname
       $lastname = cleanInput($_POST['lastname']);        
//email
       $email = cleanInput($_POST['email']);        
    
//password    
       $password = cleanInput($_POST['password']);        
       
//save the customer data if the error flag is still clear
    if ($error == 0) {
        $query = "INSERT INTO customer (firstname,lastname,email,password) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($DBC,$query); //prepare the query
        mysqli_stmt_bind_param($stmt,'ssss', $firstname, $lastname, $email,$password); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
        echo "<h2>Registered</h2>";        
    } else { 
      echo "<h2>$msg</h2>".PHP_EOL;
    }      
    mysqli_close($DBC); //close the connection once done
}
include "footer.php"; ?>  
