<?php
include "header.php";
include "checksession.php";
include "menu.php";
?>
<form method="POST" action="registercustomer.php">
  <p>
    <label for="firstname">Name: </label>
    <input type="text" id="firstname" name="firstname" minlength="5" maxlength="50" required> 
  </p> 
  <p>
    <label for="lastname">Last Name: </label>
    <input type="text" id="lastname" name="lastname" minlength="5" maxlength="50" required> 
  </p>  
  <p>  
    <label for="email">Email: </label>
    <input type="email" id="email" name="email" maxlength="100" size="50" required> 
   </p>
  <p>
    <label for="password">Password: </label>
    <input type="password" id="password" name="password" minlength="8" maxlength="32" required> 
  </p> 
  
   <input type="submit" name="submit" value="Register">
 </form>
<?php
include "footer.php"; ?>  

