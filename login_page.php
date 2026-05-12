<?php
include "header.php";
include "checksession.php";
include "menu.php";
?>
<form action="login.php" method="post">
  <div class="container">
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>
    <br>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <br>
    <button type="submit">Login</button>
  </div>
</form> 
<?php
include "footer.php"; ?>  

