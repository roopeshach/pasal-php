
<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
$db = mysqli_connect('localhost', 'root', '', 'pasal');

// get user id from session variable email
$email = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($db, $sql);
$user = mysqli_fetch_assoc($result);
$user_id = $user['id'];
  include "inc/home_header.php";


?>

<style>
        * {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
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

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
    </style>	
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Welcome to PASAL!!</h3>
            <!-- Slideshow container -->
<div class="slideshow-container">

<!-- Full-width images with number and caption text -->
<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="slider/banner.png" style="width:100%">
  <div class="text"> Pasal</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="slider/choco.jpg" style="width:100%">
  <div class="text">Choco fun</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="slider/banner.png" style="width:100%">
  <div class="text">Pasal Online</div>
</div>

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
<span class="dot" onclick="currentSlide(1)"></span>
<span class="dot" onclick="currentSlide(2)"></span>
<span class="dot" onclick="currentSlide(3)"></span>
</div>
    </div>
</div>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12"> 
            <h3>Our Products</h3>
            <?php
                include "admin/inc/conn.php";
                $query = "SELECT * FROM product";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)){
                    echo '<div class="col-md-3">';
                    echo '<div class="card">';
                    echo '<img src="images/'.$row['image'].'" width="200" height="200" class="img-fluid" alt="...">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$row['name'].'</h5>';
                    echo '<p class="card-text">'.$row['description'].'</p>';
                    echo '<h3 class="card-text"> Rs. '.$row['price'].'</h3>';
                    echo '<a  href="cart.php?uid='.$user_id.'&&pid='.$row['id'].'" class="btn btn-primary">Add to Cart</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div> <br>';
                }
            ?>

    </div>
</div>

<br><br>
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}


</script>
</body>
</html>