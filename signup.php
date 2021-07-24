<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Movies & TV-Shows</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="icon" type="image/png" href="images/watermark.png"/>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	</head>

	<style>
	</style>

	<body bgcolor="#d3d3d3">
		<div class="container">
			<div class="main">
				<div class="menu">
					<div class="menu_link"><a class="menu_link_clicked" href="./index.php">Home</a></div>
					<div class="menu_link"><a href="#">Movies</a></div>
					<div class="menu_link"><a href="#">TV-Shows</a></div>
				</div>
				<div class="login">
					<div class="login_link">Signup page</div>
				</div>
			</div>
			<div class="content" style="padding-bottom: 0;">
                <div class="form_login_container">
                    <form method="POST">
                        <input type="text" placeholder="Username" name="username" minlength="8" required></input>
                        <input type="text" placeholder="Email" id="email" name="email" minlength="8" required></input>
                        <input type="password" placeholder="Password" id="pwd" name="password1" minlength="8" required></input><br>
                        <input type="password" placeholder="Same Password" id="cpwd" name="password2" minlength="8" required></input><br>
                        <div class="errorMsg" id="errorMsg"></div>
						<input type="submit" value="Signup" name="submit_signup"></input>
                    </form>
                    <label>You have an account? <a class="menu_link_clicked" href="./login.php">Login!</a></label>
                </div>
			</div>
			<div class="footer">
				<div class="footer_content">Made with <span style="color: red;">&nbsp;&hearts;&nbsp;</span>
                by Bunicu' &nbsp;&nbsp;&nbsp;&copy;&nbsp;&nbsp;&nbsp; <?php echo date('Y'); ?></div>
			</div>
		</div>
	</body>
</html>
<?php
	include("db.php");
	session_start();

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	    $ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} 
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	if(isset($_POST['submit_signup'])){
		if($_POST['password1'] == $_POST['password2'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$username = trim($_POST['username']);
			$email = trim($_POST['email']);
			$password = trim($_POST['password1']);
			$sql = "SELECT username FROM users WHERE username = '$username'";
			$query = mysqli_query($db, $sql);
			$numRows = mysqli_num_rows($query);
			if($numRows == 0){
				$_SESSION['username'] = $username;
				$_SESSION['ip'] = $ip;
				$hash = password_hash($password, PASSWORD_ARGON2I);
				$sql2 = "INSERT INTO users (username, email, pwd, ip) VALUES ('$username', '$email', '$hash', '$ip')";
				if(mysqli_query($db , $sql2)){
					$sql3 = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
					$query3 = mysqli_query($db, $sql3);
					$numRows3 = mysqli_num_rows($query3);
					if($numRows3 == 1){
						$row = mysqli_fetch_array($query3);
						$_SESSION['id'] = $row['id'];
					}
					header("location:action_login.php");
				}
				else{
					echo '<script>document.getElementById("errorMsg").innerHTML="Server down! Try again later!"</script>'; 
				}
			}
			else{
				echo '<script>document.getElementById("errorMsg").innerHTML="Username already exists!"</script>'; 
			}
		}
		else{
			echo '<script>document.getElementById("errorMsg").innerHTML="Something went wrong! Try again!"</script>';
		}
	}
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

	var password = document.getElementById('pwd');
	var confirm_password = document.getElementById('cpwd');
	function validatePassword() {
		if ((confirm_password.value!='')&&(password.value != confirm_password.value)) {
			document.getElementById('errorMsg').innerHTML='Passwords Don\'t Match';
		} else {
			document.getElementById('errorMsg').innerHTML='';
		}
	}
	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;

	var email = document.getElementById('email');
	function ValidateEmail() {
		if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email.value))
		{
			document.getElementById('errorMsg').innerHTML='';
		}
		else{
			document.getElementById('errorMsg').innerHTML='Enter a valid email address!';
		}
	}
	email.onkeyup = ValidateEmail;
</script>