<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/styles.css"/>
		<title><?=$title?></title>
	</head>
	<body>
	<header>
		<section>
			<aside>
				<h3>Opening Hours:</h3>
				<p>Mon-Fri: 09:00-17:30</p>
				<p>Sat: 09:00-17:00</p>
				<p>Sun: 10:00-16:00</p>
			</aside>
			<h1>Fran's Furniture</h1>

		</section>
	</header>
	<nav>
		<ul>
			<li><a href="/">Main</a></li>
			<li><a href="/furniture/all">Our Furniture</a></li>
			<li><a href="/about">About Us</a></li>
			<li><a href="/contact">Contact us</a></li>
			<li><a href="/FAQ">FAQ</a></li>

			<?php
			if(isset($_SESSION['logged'])){
			// loads admin  menu into menu
				require 'adminMenu.html.php';	
			 }else { ?> 

			<li><a href="/login">Login</a></li>

			 <?php } ?>
		</ul>

	</nav>
	<img src="images/randombanner.php"/>
<br>
<!-- output for non static content -->
	<?=$output;?>


	<footer>
	<!-- automatic copyright date -->
		&copy; Fran's Furniture <?=date("Y");?>
	</footer>
</body>
</html>