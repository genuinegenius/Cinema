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
					<div class="login_link"><a href="./login.php">Login/Signup</a></div>
				</div>
			</div>
			<div class="content">
				<?php
					include("db.php");
					$content_content = 0;
					$sql = "SELECT * FROM genres";
					$query = mysqli_query($db, $sql);
					while($x = mysqli_fetch_assoc($query)){
						$k = 0;
						$genre = $x['genres'];
						echo '<div class="content_title">'.$genre.'</div>';
						
						$sql2 = "SELECT * FROM movies WHERE genre = '$genre'";
						$query2 = mysqli_query($db, $sql2);
						
						$images = array();
						$names = array();

						while($row = mysqli_fetch_array($query2)){
							$images[$k] = $row['image'];
							$names[$k] = $row['name'];
							$k = $k + 1;
						}
						$nr = 6;
						$l = 1;
						if(count($images) == count($names)){
						foreach(array_combine($images, $names) as $image => $name){
							if($l == 1 || $l == 7 || $l == 13 || $l == 19 || $l == 25){
								echo '<div class="content_container '.$genre.' fade">';
							}
							if($l == 1 || $l == 7 || $l == 13 || $l == 19 || $l == 25){
								echo '<a class="prev" onclick="plusSlides'.$genre.'(-1)">&#10094;</a>';
							}
							echo '<div class="content_content" onclick="func();">';
							if($image){
								echo '<img class="image" src="data:image/jpeg;base64,'.base64_encode( $image ).'" width="100%" height="90%" title="'.$name.'"/>';

								$title = substr($name, 0, strlen($name)-7);
								if(strlen($title) <= 14){
									echo $title;
								}
								else{
									echo substr($title, 0, 14) . '...';
								}
							}
							echo '</div>';
							if($l == 6 || $l == 12 || $l == 18 || $l == 24){
								echo '<a class="next" onclick="plusSlides'.$genre.'(1)">&#10095;</a>';
							}
							if($l == 6 || $l == 12 || $l == 18 || $l == 24){
								echo '</div>';
							}
							$l = $l + 1;
						}
						$ok = 0;
						if($l > 7 && $l < 12){
							while($l <= 12){
								echo '<div class="content_content"></div>';
								$l = $l + 1;
								$ok = 1;
							}
						}
						if($l > 1 && $l < 6){
							while($l <= 6){
								echo '<div class="content_content"></div>';
								$l = $l + 1;
								$ok = 1;
							}
						}
						if($ok){
							echo '<a class="next" onclick="plusSlides'.$genre.'(1)">&#10095;</a>';
							echo '</div>';
						}
					}}
				?>
			</div>
			<div class="footer">
				<div class="footer_content">Made with <span style="color: red;">&hearts;</span> by Bunicu' &nbsp;&nbsp;&nbsp;&copy;&nbsp;&nbsp;&nbsp; <?php echo date('Y'); ?></div>
			</div>
		</div>
	</body>
</html>
<script>

	function func(){
		
	}

	var slideIndex = 1;
    showSlides(slideIndex, "Action");
    showSlides(slideIndex, "Comedy");
    showSlides(slideIndex, "Drama");
    showSlides(slideIndex, "Fantasy");
    showSlides(slideIndex, "Horror");
    showSlides(slideIndex, "Mystery");
    showSlides(slideIndex, "Romance");
    showSlides(slideIndex, "Thriller");
    showSlides(slideIndex, "Western");

    // Next/previous controls
    function plusSlidesAction(n) {
    	showSlides(slideIndex += n, "Action");
    }
    function plusSlidesComedy(n) {
    	showSlides(slideIndex += n, "Comedy");
    }
    function plusSlidesDrama(n) {
    	showSlides(slideIndex += n, "Drama");
    }
    function plusSlidesFantasy(n) {
    	showSlides(slideIndex += n, "Fantasy");
    }
    function plusSlidesHorror(n) {
    	showSlides(slideIndex += n, "Horror");
    }
    function plusSlidesMystery(n) {
    	showSlides(slideIndex += n, "Mystery");
    }
    function plusSlidesRomance(n) {
    	showSlides(slideIndex += n, "Romance");
    }
    function plusSlidesThriller(n) {
    	showSlides(slideIndex += n, "Thriller");
    }
    function plusSlidesWestern(n) {
    	showSlides(slideIndex += n, "Western");
    }

    function showSlides(n, x) {
		var i;
		var slides = document.getElementsByClassName(x);
		if (n > slides.length) {slideIndex = 1}
		if (n < 1) {slideIndex = slides.length}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		slides[slideIndex-1].style.display = "flex";
    }
</script>