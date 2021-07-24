<html>
    <body>
        <form method="POST">
            Input genres into database:
            <input type="text" name="genre" placeholder="Genre"></input>
            <input type="submit" id="submit" name="submit_genre"></input>
        </form>
        <?php
            $username = '';
            $localhost = "localhost";
            $id_db = "root";
            $pwd_db = "";
            $database_name = "cinema";
            $db = mysqli_connect($localhost , $id_db , $pwd_db , $database_name);
            if(isset($_POST['submit_genre'])){
                $genres = $_POST['genre'];
                $sql = "INSERT INTO genres (genres) VALUES ('$genres')";
                if(mysqli_query($db,$sql))
                    echo 'Genre inserted successful!';
                else echo 'There was an error inserting genre!';
            }
        ?>
        <form method="POST" enctype="multipart/form-data">
            Input movies into database:
            <input type="text" name="name" placeholder="Name"></input>
            <input type="text" name="description" placeholder="Description"></input>
            <input type="text" name="genre" placeholder="Genre"></input>
            <input type="text" name="rating" placeholder="Imdb rating"></input>
            <input type="text" name="time" placeholder="Time(minutes)"></input>
            <input type="text" name="release" placeholder="Release date"></input>
            <input type="file" name="file" accept="image/*"></input>
            <input type="submit" name="submit_movies"></input>
        </form>
        <?php
            $get = "";
            if(isset($_POST['submit_movies'])){
                $name = $_POST['name'];
                $description = $_POST['description'];
                $genre = $_POST['genre'];
                $rating = $_POST['rating'];
                $time = $_POST['time'];
                $release = $_POST['release'];
                $get = $_FILES['file']['name'];
                if($get != "")
                {
                    $imgContent = addslashes(file_get_contents($_FILES['file']['tmp_name']));
                }
                $sql = "INSERT INTO movies (name, description, genre, release_date, imdb, time, image) VALUES ('$name', '$description', '$genre', '$release', '$rating', '$time', '$imgContent')";
                if(mysqli_query($db, $sql))
                    echo 'Movie added with success!';
                else echo 'There was an error inserting movie!';
            }
        ?>
        <?php
            $sql1 = "SELECT * FROM movies";
            $query1 = mysqli_query($db, $sql1);
            while($row = mysqli_fetch_array($query1)){
                if($row['image']){
                    echo '<img src="data:image/jpeg;base64,';
                    echo base64_encode($row['image']);
                    echo '" alt="avatar" style="width:100; height:100; border-radius:15%; margin-left:15px; margin-top:30px;" title="Avatar"></img>';
                }
                else{
                    echo 'Nu';
                }
            }
        ?>
    </body>
</html>