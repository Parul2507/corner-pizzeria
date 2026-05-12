<?php
include "header.php";
include "checksession.php";
include "menu.php";
if ($_SESSION['loggedin'] == 0){
    header("Location: ./login_page.php");
    die();
}
?>
<form action="reservation.php" method="post">
  <div class="container">
    <br>
    <label for="phone"><b>Telephone No.:</b></label>
    <input type="text" placeholder="###-###-####" name="phone" required>
    <br>
    <br>

    <label for="date"><b>Booking Date:</b></label>
    <input type="date" name="date" required>
    <br>
    <br>

    <label for="people"><b>Party Size:</b></label>
    <input type="people" name="people" required>
    <br>
    <br>
    <button type="submit" id='book-button'>Book</button>
    <?php 
    $userid = $_SESSION['userid'];
    echo "<script>sessionStorage.setItem('userid', $userid); 
    addHiddenBooking()</script>"; ?>
    <br>
    <br>
  </div>
</form> 
<?php
include "footer.php"; ?>  

