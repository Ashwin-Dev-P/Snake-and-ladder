<?php
	
	session_start();
	require_once "pdo.php";
	if ( ! isset($_SESSION['username']) || strlen($_SESSION['username']) < 1  ) {
		$_SESSION['error'] = "Login to continue";
		
		header('Location: index.php');
		return;
	}
	
	if( isset($_POST['feedbacks']) ){
		if( strlen($_POST['feedbacks']) < 1 ){
			$_SESSION['error'] = "Enter feedback.";
			header('Location: feedback.php');
			return;
		}else{
			
				$_SESSION['success'] = "Thank you for the feedback.";
				$sql2 = "INSERT INTO feedback (account_id,feedbacks) VALUES (:account_id ,:feedbacks)";
				$stmt2 = $pdo->prepare($sql2);
				$stmt2->execute(array(
				':account_id' => $_SESSION['account_id'],
				':feedbacks' => htmlentities($_POST['feedbacks'])
				));
			
			$_SESSION["success"] = "Feedback sent.<br/>Thanks for the feed back.";
			header('Location: feedback.php');
			return;
		}
	}
	
	
	
	$stmt = $pdo->prepare("SELECT score,darkmode FROM accounts WHERE account_id= :account_id");
	$stmt -> execute(array(":account_id" => $_SESSION['account_id']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$_SESSION['score'] = $row['score'];
	$darkmode = $row['darkmode'];
	
	
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta charset="UTF-8">
		<meta content="" name="descriptison">
		<meta content="" name="keywords">
		<title>
			Home
		</title>
		
		<link href="assets/img/favicon.png" rel="icon">
		<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
		<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
		<link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
		<link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
		<link href="assets/vendor/aos/aos.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="css/rps2.css" rel="stylesheet">
		
		<link rel="stylesheet" href="css/game.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/login.css">
		
		<script src="js/downloadedjquery5.js"></script>
		
		<style>
            .mymenu{
                padding:20px 20px 20px 20px;
                margin: 20px;
				font-size:35px;
            }
			.registration-form form {
				
				max-width: 800px;
				
			}
			#feedbacklabel{
				font-size:20px;
			}
			textarea {
				width: 500px;
			}
        </style>
		
	</head>
	<body>
		<?php 
			if($_SESSION['account_id'] == '8' ){
				echo "
				<style>
					#accountaccess{
						display:none;
					}
				</style>
				";
			}
			if($darkmode == 1){
				echo "
				<style>
					
					#header.header-transparent {
					background-color: black;
		
					}
					.registration-form .form-icon {
						text-align: center;
						background-color: white;
						color: black;
					}
					

					#hero:before{
						background-color:black;
					}
					a:hover{
						color:#2dc997;
					}
					input:checked + .slider {
						background-color: #ccc;
					}
					.registration-form .create-account {
						background-color: black;
						color: white;
					}
					label{
							color:white;
					}
					#mobile-nav {
						background: black;
					}
				</style>
				";
			}
		?>
		
			
		<header id="header" class="header-transparent">
			<div class="container">
				<div id="logo " class="pull-left score" style="font-size: 2rem;">
					Score:<?=$_SESSION['score']?>
				</div>
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<li><a href="home.php">Home</a></li>
						<li><a href="leaderboard.php">LeaderBoard</a></li>
						<li class="menu-has-children"><a><?=$_SESSION['username']?></a>
							<ul>
								<li id="accountaccess"><a href="accountsettings.php">My Profile</a></li>
                                <li id="accountaccess2"><a href="feedback.php">Feedback</a></li>
								<li><a href="logout.php">Log Out</a></li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		</header>
		
		
		<section id="hero">
			<div class="hero-container" data-aos="zoom-in" data-aos-delay="100" id="menucenter">
				<div class="registration-form">
					<form method="post">
				
            
						<div class="form-group">
							<label for="w3review" id="feedbacklabel">FEEDBACK</label>
							<br/>
							<textarea id="feedback" name="feedbacks" rows="4" cols="500">
							 
							</textarea>
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-block create-account">Submit</button>
						</div>
						<div class="form-group">
					<?php
						
						
						if (isset($_SESSION['error'])) {
							echo '<p style="color: red;text-align:center;">'.$_SESSION['error']."</p>\n";
							unset($_SESSION['error']);
						}
						if (isset($_SESSION['success'])) {
							echo '<p style="color: green;text-align:center;">'.$_SESSION['success']."</p>\n";
							unset($_SESSION['success']);
						}
					?>
				</div>
					</form>
				</div>
			</div>
		</section>
		
		
		
		
		
		<!--Jquery link-->
		<script src="js/downloadedjquery.js"></script>
		<script src="js/downloadedjquery2.js"></script>
		<script src="js/downloadedjquery3.js"></script>
		<script src="js/downloadedjquery4ajax.js"></script>
		<script src="js/downloadedjquery5.js"></script>
		
		
		
		
		
		<script src="assets/vendor/jquery/jquery.min.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
		<script src="assets/vendor/php-email-form/validate.js"></script>
		<script src="assets/vendor/counterup/counterup.min.js"></script>
		<script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
		<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
		<script src="assets/vendor/superfish/superfish.min.js"></script>
		<script src="assets/vendor/hoverIntent/hoverIntent.js"></script>
		<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
		<script src="assets/vendor/venobox/venobox.min.js"></script>
		<script src="assets/vendor/aos/aos.js"></script>
		<script src="assets/js/main.js"></script>
		
		
		
		
	</body>
</html>