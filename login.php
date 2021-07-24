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
					<div class="login_link">Login page</div>
				</div>
			</div>
			<div class="content" style="padding-bottom: 0;">
                <div class="form_login_container">
                    <form method="POST">
                        <input type="text" placeholder="Username" name="username" required></input>
                        <input type="password" placeholder="Password" name="password" required></input><br>
                        <div class="errorMsg" id="errorMsg"></div>
                        <input type="submit" value="Login" name="submit_login"></input>
                    </form>
                    <label>New? <a class="menu_link_clicked" href="./signup.php">Create account!</a></label>
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

    if(isset($_POST['submit_login'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
		$query = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($query);
        $numRows = mysqli_num_rows($query);
		if(password_verify($password, $row['pwd']) && $numRows == 1){
			session_start();
			$_SESSION['username'] = $row['username'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['ip'] = $row['ip'];
			header("location:action_login.php");
		}
        else{
            echo '<script>document.getElementById("errorMsg").innerHTML="Username or password wrong!"</script>';
        }
	}
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }    
</script>