<html>
    <style>
        * {box-sizing:border-box}

        /* Slideshow container */
        .slideshow-container {
        max-width: 250;
        height: 250;
        display:flex;
        flex-direction:column;
        position: relative;
        margin: 0;
        }

        /* Hide the images by default */
        .mySlides {
        display: none;
        }

        /* Next & previous buttons */
        .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
        right: 0;
        border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
        background-color: rgba(0,0,0,0.8);
        }

        /* Fading animation */
        .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
        from {opacity:0.4;}
        to {opacity:1;}
        }

        @keyframes fade {
        from {opacity:0.4;}
        to {opacity:1;}
        }
    </style>
    <body>
        <div class="slideshow-container">
            
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <!-- Full-width images with number and caption text -->
                <?php
                    include('db.php');
                    $sql = "SELECT * FROM movies";
                    $query = mysqli_query($db, $sql);
                    $k = 0;
                    $images = array();
                    $name = array();
                    while($row = mysqli_fetch_array($query)){
                        $images[$k] = $row['image'];
                        $names[$k] = $row['name'];
                        $k = $k + 1;
                    }
                    echo $k;
                    $l = 1;
                    foreach(array_combine($images, $names) as $image => $name){
                        if($l == 4 || $l == 7 || $l == 10 || $l == 13){
                            echo '</div>';}
                        if($l == 1 || $l == 4 || $l == 7 || $l == 10 || $l == 13){    
                            echo '<div class="mySlides fade">';}
                                echo '<img style="display:inline-block;" src="data:image/jpeg;base64,'.base64_encode( $image ).'" width="250" height="250" title="'.$name.'" />';
                        
                        $l = $l + 1;
                    }
                ?>
                </div>


            <!-- Next and previous buttons -->
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </body>

</html><!--
<?php
    include('db.php');
    $sql = "SELECT * FROM movies";
    $query = mysqli_query($db, $sql);
    $k = 0;
    $count = 0;
    if(isset($_POST['submit'])){
        while($row = mysqli_fetch_array($query)){
            if($count == 1){
                echo "da";
            }
            else{
                echo 'nu';
            }
        }
    }
    while($row = mysqli_fetch_array($query)){
        if($k < 5){
            if($row['image']){
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="100" height="100" title="'.$row['name'].'"/>';
            }
            else{
                echo 'Error loading image!';
            }
        }
        $count = 1;
        $k = $k + 1;
    }
?>-->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "flex";
    }
</script>