<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if not logged in
    header("Location: GetAwayLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Homepage</title>

    <style>
        body {
        background-color: #f0e5d3;
	    margin: 0;
        padding: 0;
        overflow-x: hidden;
        font-family: Arial, sans-serif;
        }

    /* Header styling */
    .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.68);
            color: black;
            padding: 10px 20px;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            margin: 0;
            position: relative;
    }

    .logo-container {
      display: flex;
      align-items: center;
    }

    .logo-img {
      height: 120px;
      width: 120px;
      margin-right: 10px;
    }

    .logo-text {
      font-size: 24px;
      font-weight: bold;
      color: black;
      margin: 0;
    }

    .nav-menu {
      display: flex;
      gap: 20px; /* Space between navigation links */
      margin-right: 20px;
    }

    .nav-menu a {
      text-decoration: none;
      color: black;
      font-weight: bold;
      padding: 5px 10px;
    }

    .nav-menu a:hover {
      background-color: #ddd;
      border-radius: 5px;
    }

    /* To prevent content overlap with the fixed header */
    .content {
      padding-top: 20px;
    }

    /* Dropdown Button */
        .dropbtn {
        color: black;
        font-weight: bold;
        text-transform: uppercase;
        background: none ;
        border: none;
        font-family: Arial, sans-serif;
        text-decoration: none;
        }



    .dropdown {
        position: relative;
        display: inline-block;
        }

    /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
        display: none;
        position: absolute;
        min-width: 160px;
        background-color: #f1f1f1;
        }

        .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        }


    /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {display: block;}


    /* Main Content Styling */
.container {
    display: flex;
    justify-content: space-between;
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
}

.left-content, .right-content {
    width: 48%;
}

.left-content {
    text-align: center;
}

.left-content img {
    width: 250px;
    margin: 0 auto;
}

.left-content h2, .left-content p {
    margin-bottom: 15px;
}

.button-container {
    margin: 20px 0;
}

.button {
    padding: 15px 30px;
    background-color: #000;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 18px;
    display: inline-block;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #333;
}

/* Booking Section Styling */
.section {
    position: relative;
    background: url('background.jpg') no-repeat center center/cover;
}

.booking-form {
    background-color: #fff;
    padding: 30px;
    border-radius: 3px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 550px; /* Limits form width to avoid overflow */
}

.booking-form .form-header {
    text-align: center;
    margin-bottom: 20px;
}

.booking-form .form-header h1 {
    font-family: 'Cardo', serif;
    font-weight: 700;
    font-size: 32px;
    color: #0c0c09;
}

.booking-form .form-group {
    margin-bottom: 20px;
    width: 100%;
}

.booking-form .row {
    display: flex;
    gap: 15px; /* Adds space between check-in and check-out fields */
}

.booking-form .form-control {
    background-color: #fff;
    height: 45px;
    padding: 10px 15px;
    border: 1px solid #e1e1e1;
    border-radius: 3px;
    color: #6b6b6d;
    font-size: 14px;
    width: 90%;
}

.booking-form .submit-btn {
    color: #fff;
    background-color: #c99552;
    font-weight: 700;
    height: 45px;
    border: none;
    font-size: 14px;
    width: 100%;
    border-radius: 3px;
    cursor: pointer;
}

.submit-btn:hover {
    background-color: #b3834a;
}

.title2 {
  font-family: 'Times New Roman', Times, serif;
  font-size: 25px;
  color:rgba(61, 58, 58, 0.814);
}

/* Basic styles for gallery layout */
.row {
  display: flex;
  justify-content: center;
  margin-top: 10px;
  
}

.column {
  flex: 1;
  max-width: 25%;
  padding: 5px;
}

.column img {
  width: 100%;
  height: auto;
  cursor: pointer;
  transition: 0.3s;
}

.column img:hover {
  opacity: 0.8;
}

.title2 {
  font-family: 'Times New Roman', Times, serif;
  font-size: 25px;
  color:rgba(61, 58, 58, 0.814);
}

/* Basic styles for gallery layout */
.row {
  display: flex;
  justify-content: center;
  margin-top: 10px;
  
}

.column {
  flex: 1;
  max-width: 25%;
  padding: 5px;
}

.column img {
  width: 100%;
  height: auto;
  cursor: pointer;
  transition: 0.3s;
}

.column img:hover {
  opacity: 0.8;
}

/* Modal (lightbox) styles */
.modal {
  display: none; /* Hidden by default */
  position: fixed;
  z-index: 1000;
  padding-top: 60px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.9);
}

.modal-content {
  position: relative;
  margin: auto;
  display: flex;
  justify-content: center;
  max-width: 90%;
  max-height: 80%;
  animation-name: zoom;
  animation-duration: 0.6s;
}

.mySlides {
  display: inline-block; /* Keeps slides aligned in a row */
  margin: 0 5px; /* Optional: space between images */
}

@keyframes zoom {
  from { transform: scale(0.4) } 
  to { transform: scale(1) }
}

/* Slide image text */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Caption text */
.caption-container {
  text-align: center;
  background-color: black;
  color: white;
  padding: 10px 20px;
  height: 50px;
}

/* Close button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: white;
  font-size: 35px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

.close:hover {
  color: #bbb;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.3s;
  user-select: none;
}

.prev {
  left: 0;
}

.next {
  right: 0;
}

.prev:hover, .next:hover {
  color: #bbb;
}

/* Thumbnail images */
.demo {
  opacity: 0.6;
  cursor: pointer;
  transition: 0.3s;
}

.demo:hover, .demo.active {
  opacity: 1;
}

/* Media query for responsiveness */
@media screen and (max-width: 700px) {
  .column {
    display: flex;
    max-width: 50%;
  }
}

@media screen and (max-width: 500px) {
  .column {
    display: flex;
    max-width: 100%;
  }
}


    </style>


</head>
<body>
    <header>
    <div class="main-header">
    <div class="logo-container">
      <img class="logo-img" src="LOGO.png" alt="logo listing">
      <h1 class="logo-text">GetAway</h1>
    </div>
    <nav class="nav-menu">
      <a href="Homepage.php"><b>HOME</b></a>
      <a href="Accomodations Listings.php"><b>ACCOMODATIONS</b></a>
      <div class="dropdown">
      <button class="dropbtn">Welcome, <?php echo htmlspecialchars($_SESSION['fname'] . " " . $_SESSION['lname']); ?>!</button>
        <div class="dropdown-content">
            <a href="user-booking-list.php">Booking History</a>
            <a href="GetAwayLogout.php">Log Out from (<?php echo htmlspecialchars($_SESSION['email']); ?>.)</a>
        </div>
    </div>
    </nav>
  </div>
    </header>

    <!-- Main Content Container -->
<div class="container">
    <!-- Left Column Content -->
    <div class="left-content">
        <img src="LOGO.png" alt="GetAway Logo">
        <h2>Your Main Holiday Accommodation Booking Hub</h2>
        <p>Welcome to GetAway! We’re thrilled to be your go-to platform for securing the perfect holiday stays.</p>
        <p>By signing up, you'll unlock access to exclusive deals, personalized recommendations, and a hassle-free booking process.</p>
        <div class="button-container"><a href="GetAway - Register.html" class="button">Sign Up Now!</a></div>
    </div>

    <!-- Right Column Content -->
    <div class="right-content">
        <div class="booking-form">
            <div class="form-header">
                <h1>Accomodations Availability</h1>
            </div>
            <form action="homepagereservation.php" method="post">
                <div class="form-group">
                    <label for="check-in" class="form-label">Check In</label>
                    <input id="check-in" class="form-control" type="date" required name="check_in">
                </div>
                <div class="form-group">
                    <label for="check-out" class="form-label">Check Out</label>
                    <input id="check-out" class="form-control" type="date" required name="check_out">
                </div>
                <div class="form-group">
                    <label class="form-label">Rooms</label>
                    <select class="form-control" name="rooms" required>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Adults</label>
                    <select class="form-control" name="adults" required>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Children</label>
                    <select class="form-control" name="children" required>
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Check Availability</button>
            </form>
        </div>
    </div>
</div>



    <footer>

    <div class="title2"
<h2>Top-rated house rentals in Malaysia</h2>
</div>

<div class="row">
    <div class="column">

      <img src="images/homepage 1.jpg" onclick="openModal();currentSlide(1)" class="hover-shadow">
    </div>
    <div class="column">
      <img src="images/homepage 2.jpg" onclick="openModal();currentSlide(2)" class="hover-shadow">
    </div>
    <div class="column">
      <img src="images/homepage 3.jpg" onclick="openModal();currentSlide(3)" class="hover-shadow">
    </div>
    <div class="column">
      <img src="images/homepage 4.jpg" onclick="openModal();currentSlide(4)" class="hover-shadow">
    </div>
  </div>
  
  <!-- The Modal/Lightbox -->
  <div id="myModal" class="modal">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content">
  
      <div class="mySlides">
        <div class="numbertext">1 / 4</div>
        <img src="images/homepage 1.jpg" style="width:100%">
      </div>
  
      <div class="mySlides">
        <div class="numbertext">2 / 4</div>
        <img src="images/homepage 2.jpg" style="width:100%">
      </div>
  
      <div class="mySlides">
        <div class="numbertext">3 / 4</div>
        <img src="images/homepage 3.jpg" style="width:100%">
      </div>
  
      <div class="mySlides">
        <div class="numbertext">4 / 4</div>
        <img src="images/homepage 4.jpg" style="width:100%">
      </div>
  
      <!-- Next/previous controls -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
  
      <!-- Caption text -->
      <div class="caption-container">
        <p id="caption"></p>
      </div>
  
      <!-- Thumbnail image controls -->
      <div class="column">
        <img class="demo" src="images/homepage 1.jpg" onclick="currentSlide(1)" alt="Tiny home in Bachok, Malaysia">
      </div>
  
      <div class="column">
        <img class="demo" src="images/homepage 2.jpg" onclick="currentSlide(2)" alt="Entire home in Kota Belud, Malaysia">
      </div>
  
      <div class="column">
        <img class="demo" src="images/homepage 3.jpg" onclick="currentSlide(3)" alt="Private room in chalet in Semporna, Malaysia">
      </div>
  
      <div class="column">
        <img class="demo" src="images/homepage 4.jpg" onclick="currentSlide(4)" alt="Shipping container in Kuala Dungun, Malaysia">
      </div>
    </div>
  </div>

    </footer>



    <script>
  // Open the Modal
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById("myModal").style.display = "none";
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
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

</body>
</html>