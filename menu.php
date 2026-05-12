<!-- menu start -->
        <div id="header">
			<div>
				<a href="index.php" class="logo"><img src="images/logo.png" alt=""></a>
				<ul id="navigation">
					<li class="menu selected">
						<a href="index.php">Home</a>
					</li>
   				    <li class="menu">
						<a href="">Pizzas</a>
						<ul class="primary">
	 						<li><a href="product.php">Pizza Menu</a></li>
	 						<li><a href="order.php">Place Order</a></li>
						</ul>
					</li>                    
   				    <li class="menu">
						<a href="reservation_page.php">Reservations</a>
					</li>                    
					<li class="menu">
						<a href="">About</a>
						<ul class="primary">
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                            <li><a href="privacy.php">Privacy Policy</a></li>
						</ul>
					</li>
					<li class="menu">
                        <?php
                            if ($_SESSION['loggedin'] == 0){
                                echo "<a href=''>Login</a>";
                            }else{
                                $username = $_SESSION['username'];
                                echo "<a href=''>$username</a>";
                            }
                        ?>
						
						<ul class="secondary">
							<li>
                                <?php
									if ($_SESSION['loggedin'] == 0){
										echo "<a href='login_page.php'>LoginIN</a>".PHP_EOL;
										echo "<a href='signup.php'>Register</a>";
									}else{
										echo "<a href='logout.php'>Logout</a>";
									}
								?>
                                                               
							</li>
						</ul>                        
					</li>

					<li class="menu">
						<a href="">Admin</a>
						<ul class="secondary">
							<li><a href="listreservation.php">Reservations</a></li>
							<li><a href="listorders.php">Orders</a></li>
							<li><a href="listitems.php">Products</a></li>                            
							<li><a href="listcustomers.php">Customers</a></li>                                                        
						</ul>
					</li>
				</ul>
			</div>
		</div>
<!-- menu end -->
