<?php
    include("db.php");

    /*$name = $_POST['movie_name'];

    $sql = "SELECT * FROM movies WHERE name = '$name'";
    $query = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($query);
    
    $output = "";
    $bio = $row['description'];
    $genre = $row['genre'];
    $image = $row['image'];

    echo "daadada<br>";
    $output .= '<div class="movie_info_container">';
    $output .= '<img width="100" src="data:image/jpeg;base64,'.base64_encode( $image ).'"></img>';
    $output .= $name; 
    $output .= $bio; 
    $output .= '</div>';

    setcookie('movie', $output, time()+60*60, '/');

    echo $output;*/
?>

<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Movies & TV-Shows - <?php session_start(); echo $_SESSION['username'];?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="icon" type="image/png" href="images/watermark.png"/>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	</head>
	<body bgcolor="#d3d3d3">
		<div class="container">
            <div class="main">
				<div class="menu">
					<div class="menu_link"><a href="./action_login.php">Home</a></div>
					<div class="menu_link"><a href="./movies.php">Movies</a></div>
					<div class="menu_link"><a href="./tv_shows.php">TV-Shows</a></div>
				</div>
				<div class="login">
					<div class="login_link"><a href="#"><?php echo $_SESSION['username'];?></a></div>
				</div>
			</div>
            <div class="movies_div" id="movies_div">
                <?php
                    include("db.php");

                    $movie_name = $_SESSION['movie_name'];

                    $sql = "SELECT * FROM movies WHERE name = '$movie_name'";
                    $query = mysqli_query($db, $sql);
                    $row = mysqli_fetch_array($query);
                    
                    $output = "";
                    $bio = $row['description'];
                    $genre = $row['genre'];
                    $image = $row['image'];
                    $release_src = $row['release_date'];
                    $release_date = new DateTime($release_src);
                    $imdb = $row['imdb'];
                    $time = $row['time'];
                    $link = $row['link'];

                    $time_h = (int)($time / 60);
                    $time_m = (int)($time % 60);

                    $imdb_r = substr($imdb, 0, 3);
                    $imdb_v = substr($imdb, 3, strlen($imdb));

                    $release_y = $release_date->format("Y");
                    $release_m = $release_date->format("M");
                    $release_d = $release_date->format("j");

                    echo '<div class="movie_info_container">';
                        echo '<div class="movie_image">';
                            echo '<img width="200" src="data:image/jpeg;base64,'.base64_encode( $image ).'"></img>';
                        echo '</div>';
                        echo '<div class="movie_info">';
                            echo '<div class="movie_title">';
                                echo '<span style="font-size:25;">' . $movie_name . '</span><br>'; 
                            echo '</div>';
                            echo '<div>';
                                echo '<div class="movie_details">Movie genre: '. $genre .'</div><br>';
                                echo '<div class="movie_details">Release date: '. $release_d .' '. $release_m .' '. $release_y .'</div><br>';
                                echo '<div class="movie_details">IMDB: '. $imdb_r .'/10 ('. $imdb_v .'k votes)</div><br>';
                                echo '<div class="movie_details">Time: '. $time_h . 'h '. $time_m .'min</div><br>';
                                echo '<div class="movie_details">Description: '. $bio .'</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="movie_sources">';
                        echo '<div class="movie_sources_container">';
                        echo '<iframe src="'.$link.'" frameborder="0" marginwidth="0" marginheight="0" scrolling="0" allowfullscreen allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" width="640" height="360"></iframe>';
                        echo '</div>';
                    echo '</div>';
                ?>
            </div>
			<div class="footer">
				<div class="footer_content">Made with <span style="color: red;">&hearts;</span> by Bunicu' &nbsp;&nbsp;&nbsp;&copy;&nbsp;&nbsp;&nbsp; <?php echo date('Y'); ?></div>
			</div>
		</div>
	</body>
</html>