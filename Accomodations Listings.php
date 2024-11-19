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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GetAway :Accomodations Listings</title>
  <style>
    /* General reset and body styling */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f0e5d3 !important;
      overflow-x: hidden; /* Prevent horizontal scrolling */
    }

    /* Header styling */
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
   

   

    /* Search bar container */
    .search-bar {
      display: flex;
      align-items: center;
      background-color: #fff;
      border-radius: 25px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 10px 10px;
      max-width: 700px;
      margin: 40px auto;
      overflow: hidden;
    }

    .search-section {
      display: flex;
      flex-direction: column;
      padding: 0 10px;
      flex: 1;
      border-right: 1px solid #ddd;
    }

    .search-section:last-child {
      border-right: none;
    }

    .search-section label {
      font-size: 12px;
      color: #333;
      font-weight: bold;
      margin-bottom: 3px;
    }

    .search-section input {
      border: none;
      outline: none;
      font-size: 14px;
      color: #777;
    }

    .search-button {
      background-color: #c99552;
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      margin-left: 5px;
    }

    .search-button svg {
      fill: #fff;
      width: 20px;
      height: 20px;
    }

    /* Carousel container styling */
    #carouselExampleIndicators1 {
      max-width: 600px;
      margin: 20px auto;
      background-color: grey;
    }

    .carousel-inner img {
      max-height: 300px;
      width: 100%; /* Ensure the images fit the container */
      object-fit: cover;
    }

    /* Card container styling */
    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      margin: 20px;
	
	
    }

    .card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 300px;
      overflow: hidden;
    }
	  
	  .card-text {
		  display : -webkit-box;
		  -webkit-line-clamp: 3;
		  -webkit-box-orient: vertical;
		  overflow: hidden;
		  text-overflow: ellipsis;
	  }
	  
	  .card-text.expanded {
  	-webkit-line-clamp: unset;
	  }
	  
	  .read-more {
  	color: blue;
 	cursor: pointer;
 	display: inline-block;
	margin-top: 5px;
	}

    .card img {
      width: 100%;
      height: auto;
      max-height: 250px;
      object-fit: cover;
    }

    .card-body {
      padding: 15px;
      text-align: center;
    }

    .home-list {
      width: 100%;
      height: auto;
      max-height: 250px;
      object-fit: cover;
    }
  </style>

  <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>
<body>

  <!-- Header -->
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

  <!-- Search bar container -->
  <div class="search-bar">
    <div class="search-section">
      <label for="location">Where</label>
      <input type="text" id="location" placeholder="Search destinations">
    </div>
    <div class="search-section">
      <label for="checkin">Check in</label>
      <input type="date" id="checkin" placeholder="Add dates">
    </div>
    <div class="search-section">
      <label for="checkout">Check out</label>
      <input type="date" id="checkout" placeholder="Add dates">
    </div>
    <div class="search-section">
      <label for="guests">Who</label>
      <input type="text" id="guests" placeholder="Add guests">
    </div>
    <button class="search-button">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M15.5 14h-.79l-.28-.27a6.471 6.471 0 001.48-5.34C14.95 5.11 12.45 3 9.5 3S4.05 5.11 4.05 8.39a6.471 6.471 0 001.48 5.34l-.27.27h-.79l-5 5 1.5 1.5 5-5v-.79l.27-.28a6.471 6.471 0 005.34 1.48c3.28 0 5.94-2.5 5.94-5.5s-2.66-5.5-5.94-5.5S3.05 5.11 3.05 8.39a6.471 6.471 0 001.48 5.34l-.27.27h-.79l-5 5 1.5 1.5 5-5v-.79l.27-.28a6.471 6.471 0 005.34 1.48c3.28 0 5.94-2.5 5.94-5.5s-2.66-5.5-5.94-5.5z"></path>
      </svg>
    </button>
  </div>

  <!-- Carousel -->
  <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators1" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators1" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators1" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img class="d-block mx-auto img-thumbnail" src="images/Langkawi Island.jpg" alt="First slide">
        <div class="carousel-caption">
          <h5><b>Your Next Vacation Destination</b></h5>
          <p>Langkawi Island</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block mx-auto img-thumbnail" src="images/Pangkor Island.jpg" alt="Second slide">
        <div class="carousel-caption">
			<h5><b>Your Next Vacation Destination</b></h5>
          <p>Pangkor Island</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block mx-auto img-thumbnail" src="images/KL.jpg" alt="Third slide">
        <div class="carousel-caption">
			<h5><b>Your Next Vacation Destination</b></h5>
          <p>Kuala Lumpur</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <!-- Card Container -->
  <div class="card-container">
    <div class="card">
      <img src="houses/1.jpg" alt="Tiny Home">
      <div class="card-body">
        <h5 class="card-title">Cozy Little Retreat</h5>
		  <h6 class="card-subtitle mb-2 text-muted">RM250/night</h6>
		<h7 class="card-subtitle mb-2 text-muted">6guests | 2 bedrooms | 3 beds | 1 bath</h7>
        <p class="card-text">Escape to the perfect sanctuary at Rening 46, Kg Hulu Rening, Batang Kali. Indulge in cozy accommodation and a welcoming atmosphere.</p>
		<span class="read-more">...Read more</span>
		<br>
		<a href="House(1).php" class="card-link">Book Now</a>
      </div>
    </div>
    <div class="card">
      <img src="houses/2-PARX.jpg" alt="Card image">
      <div class="card-body">
        <h5 class="card-title">MVertica Home</h5>
		<h6 class="card-subtitle mb-2 text-muted">RM305/night</h6>
		<h7 class="card-subtitle mb-2 text-muted">13 guests | 4 bedrooms | 6 beds | 2 bath</h7>
        <p class="card-text">Our Brand New and stylist Unit is stone throw to everything in KL. At the heart of KL, it's a location where it's convenient and can fulfill any needs needed.</p>
		<span class="read-more">...Read more</span>
		<br>
		<a href="House(2).php" class="card-link">Book Now</a>
      </div>
    </div>
    <div class="card">
      <img src="houses/3.ENTIRE HOUSE.jpg" alt="Card image">
      <div class="card-body">
        <h5 class="card-title">Telaga House&nbsp;</h5>
		  <h6 class="card-subtitle mb-2 text-muted">RM1,000/night</h6>
		<h7 class="card-subtitle mb-2 text-muted">16+ guests | 6bedrooms | 6 beds | 5 bath</h7>
        <p class="card-text">Best place to kick back and relax. Telaga House offers 6 bedroom, 5 bathroom and a private swimming pool to suit a family gathering</p>
		 <span class="read-more">...Read more</span>
		  <br>
		<a href="#" class="card-link">Book Now</a>
      </div>
    </div>
	  <div class="card">
      <img src="houses/4.CAMPSITE LANGKAWI.jpg" alt="Card image">
      <div class="card-body">
        <h5 class="card-title">OMG Winner, Coconest Langkawi</h5>
		<h6 class="card-subtitle mb-2 text-muted">RM590/night</h6>
		<h7 class="card-subtitle mb-2 text-muted">2 guests | 1 bedrooms | 1beds | 1 bath</h7>
        <p class="card-text">Enjoy the sounds of nature when you stay in this unique place. A shuttle will be arranged to a floating platform where the Coconest is attached. Relax on a net overhanging from the water with 360 views of the surrounding landscape including an island and King Kong mountain.</p>
		 <span class="read-more">...Read more</span>
		  <br>
		<a href="#" class="card-link">Book Now</a>
      </div>
    </div>
	  <div class="card">
      <img src="houses/4.PANGKOR.jpg" alt="Card image">
      <div class="card-body">
        <h5 class="card-title">Voyage Retreat-Room 201 Double</h5>
		<h6 class="card-subtitle mb-2 text-muted">RM220/night</h6>
		<h7 class="card-subtitle mb-2 text-muted">1 double bed <br>Private attached bathroom</h7>
		<p class="card-text">Open-concept and contemporary Industrial Design villa in Pangkor Island, close to community and surrounded by nature, suitable for family bonding, friend gathering and company retreat.</p>
		 <span class="read-more">...Read more</span>
		 <br>
		<a href="#" class="card-link">Book Now</a>
      </div>
    </div>
	 	 <div class="card">
      <img src="houses/6. FARMSTAY.jpg" alt="Card image">
      <div class="card-body">
        <h5 class="card-title">Brickhouse Bukit Tinggi Bentong</h5>
		<h6 class="card-subtitle mb-2 text-muted">RM3,703/night</h6>
		<h7 class="card-subtitle mb-2 text-muted">16+ guests | 8 bedrooms | 16beds | 7 bath</h7>
        <p class="card-text">Brickhouse Bukit Tinggi is a unique eco stay for travelers looking for a private hideaway up in the mountains - but not too far from the city life. Nestled at the top of a hill overlooking a beautiful durian orchard, it offers spectacular views and constant breeze. This place offers lots of sunshine, fresh air and privacy.</p>
		<span class="read-more">...Read more</span>
		<br>
		<a href="#" class="card-link">Book Now</a>
      </div>
    </div>
	  
  </div>

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap-4.4.1.js"></script>
	
	
 <!-- JavaScript for Read More functionality -->
  <script>
    document.querySelectorAll('.read-more').forEach(button => {
      button.addEventListener('click', function() {
        const cardText = this.previousElementSibling;
        if (cardText.classList.contains('expanded')) {
          cardText.classList.remove('expanded');
          this.textContent = '...Read more';
        } else {
          cardText.classList.add('expanded');
          this.textContent = 'Read less';
        }
      });
    });
  </script>	
	
</body>
</html>
