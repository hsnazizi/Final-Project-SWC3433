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
  <title> GetAway : Cozy Little Retreat </title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0e5d3 !important;
      margin: 0;
      overflow-x: hidden; /* Prevent horizontal scrolling */
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
        font-size: 16px;
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


    /* END OF HEADER*/

    /* To prevent content overlap with the fixed header */
    .content {
      padding-top: 20px;
    }
	  
	/* Style the Image Used to Trigger the Modal */
	#myImg {
  	border-radius: 5px;
 	 cursor: pointer;
  	transition: 0.3s;
	}

	#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
	.modal {
	  display: none; /* Hidden by default */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Sit on top */
	  padding-top: 100px; /* Location of the box */
	  left: 0;
	  top: 0;
	  width: 100%; /* Full width */
	  height: 100%; /* Full height */
	  overflow: auto; /* Enable scroll if needed */
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
	}

	/* Modal Content (Image) */
	.modal-content {
	  margin: auto;
	  display: block;
	  width: 20%;
	  max-width: 500px;
	}

	/* Caption of Modal Image (Image Text) - Same Width as the Image */
	#caption {
	  margin: auto;
	  display: block;
	  width: 80%;
	  max-width: 700px;
	  text-align: center;
	  color: #ccc;
	  padding: 10px 0;
	  height: 150px;
	}

	/* Add Animation - Zoom in the Modal */
	.modal-content, #caption {
	  animation-name: zoom;
	  animation-duration: 0.6s;
	}

	@keyframes zoom {
	  from {transform:scale(0)}
	  to {transform:scale(1)}
	}

	/* The Close Button */
	.close {
	  position: absolute;
	  top: 15px;
	  right: 35px;
	  color: #f1f1f1;
	  font-size: 40px;
	  font-weight: bold;
	  transition: 0.3s;
	}

	.close:hover,
	.close:focus {
	  color: #bbb;
	  text-decoration: none;
	  cursor: pointer;
	}

	.page-title {
		margin-left: 38px;
	}

	.content-layout {
		display: flex;
		gap: 20px;
		align-items: flex-start;
		flex-direction: column;
		justify-content: space-between;
	}

	.left-collumn {
		flex: 3; /* Adjusts width ratio for the left column */
		margin-left: 20px;
		}

	.right-collumn {
		flex: 1; /* Adjusts width ratio for the right column */
		}


	.house1-images {
		grid-template-columns: repeat(3, 1fr);
		grid-column: 1 / span 3 ;
		display: flex;
  		gap: 10px; /* Adds space between images */
  		flex-wrap: wrap; /* Allows wrapping if needed */
		width: 55%;
		margin : 0 auto;
		align-items: center;
		justify-content: center;
	}

	.house1-images img {
		display: inline-block;
		margin: 5px ;
		max-width: 100%;
		justify-content: center;
		margin: 0 auto;
	}

	.house1-images,
		.info-box {
		width: 100%; /* Full width */
		margin-bottom: 20px; /* Add space between elements */
	}

	/* 100% Image Width on Smaller Screens */
	@media only screen and (max-width: 700px){
	  .modal-content {
		width: 80%;
	  }
	}

	div.elem-group {
	margin: 20px 0;
	}

	div.elem-group.inlined {
	width: 49%;
	display: inline-block;
	float: left;
	margin-left: 1%;
	}

	label {
	display: block;
	font-family: 'Nanum Gothic';
	padding-bottom: 10px;
	font-size: 1.25em;
	}

	input, select, textarea {
	border-radius: 2px;
	border: 2px solid #777;
	box-sizing: border-box;
	font-size: 1.25em;
	font-family: 'Nanum Gothic';
	width: 100%;
	padding: 10px;
	}

	div.elem-group.inlined input {
	width: 95%;
	display: inline-block;
	}

	textarea {
	height: 100px;
	}

	hr {
	border: 1px dotted #ccc;
	}

	button {
	height: 50px;
	background: #c99552;
	border: none;
	color: white;
	font-size: 1.25em;
	font-family: 'Nanum Gothic';
	border-radius: 4px;
	cursor: pointer;
	}

	button:hover {
	border: 2px solid black;
	}

	.content-container {
		display: flex;
		justify-content: flex-start;
		flex-direction: row;
		
	}

	.info-box {
		background-color: #fff ;
		padding : 20px ;
		border: 1px solid #ccc;
		margin-top: 5px;
		overflow: auto;
		max-height: 500px;
		box-sizing: border-box;
		clear: both;
		width : 95% ;
		grid-column: 1 / -1;
		margin-left: 16px ;
		
	}

	.text-muted {
		color: rgba(0, 0, 0, 0.614);
	}

	form {
	max-width: 400px;
	}
	
	.form-container {
		margin : 0 10px ;
		float: left;
		background-color: #fff;
		border: 1px solid #fff;
		justify-content: center;
		padding: 40px;
		width: 400px ;
		height: auto;
		transform: scale(0.8);
		transform-origin: top left;
		display: block;
		align-self: flex-start;
	}
		
	.form-container input,
	.form-container button {
  		width: 90%; /* Adjust as needed */
 		font-size: 14px; /* Reduce font size */
	}

	#more {display: none;}

    </style>

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

   <!-- Content -->
<div class="content">
  <div class="page-title">
    <h1>MVertica Home.</h1>
  </div>

<div class="content-container content-layout">
<div class="left-collumn">
	<div class="house1-images">
	<img class="clickable-img" src="houses/2/Living Room.jpg" alt="Living Room" style="width:100%;max-width:200px">
	<img class="clickable-img" src="houses/2/Kitchen.jpg" alt="Kitchen" style="width:100%;max-width:200px">
	<img class="clickable-img" src="houses/2/TOILET.jpg" alt="Toilet" style="width:100%;max-width:200px">

	<div style="flex-basis: 100%; height: 0;"></div>
	<img class="clickable-img" src="houses/2/B1.jpg" alt="Room 1" style="width:100%;max-width:200px;">
	<img class="clickable-img" src="houses/2/B2.jpg" alt="Room 2" style="width:100%;max-width:200px;">
	<img class="clickable-img" src="houses/2/B4.jpg" alt="Room 3" style="width:100%;max-width:200px;">
	</div>

	<div class="info-box">
		<h1>About this space</h1>
		<h2 class="text-muted">RM305/night <br> 13 guests | 4 bedrooms | 6 beds | 2 bath</h2>    
		<p>Our Brand New and stylist Unit is stone throw to everything in KL. At the heart of KL, it's a location where it's convenient 
            and can fulfill any needs needed..<span id="dots">...</span><span id="more">
			<br> 5mins to: Sunway Velocity, Sunway Medical Centre Velocity, Aeon, MRT & LRT Maluri, PGRM
            10Mins to: Ikea, Pavillion, KLCC, Midvalley <br>
            friendly Host is able to communicate in: Chinese, English, Bahasa, Cantonese <br>
            4BedRooms | Can Fit Up to 13 Pax | Complimentary 4 Parkings !</span></p>

			<button onclick="myFunction()" id="myBtn">Read more</button>
	</div>

</div>

	<div id="myModal" class="modal">
	<span class="close">&times;</span>
	<img class="modal-content" id="img01">
	<div id="caption"></div>
	</div>

<div class = right-collumn>
	<div class="form-container">
	<h2>BOOKING FORM</h2>
	<form action="reservation.php" method="post">
		<div class="elem-group">
		  <label for="name">Your Name</label>
		  <input type="text" id="name" name="visitor_name" placeholder="John Doe" pattern=[A-Z\sa-z]{3,20} required>
		</div>
		<div class="elem-group">
		  <label for="email">Your E-mail</label>
		  <input type="email" id="email" name="visitor_email" placeholder="john.doe@email.com" required>
		</div>
		<div class="elem-group">
		  <label for="phone">Your Phone</label>
		  <input type="tel" id="phone" name="visitor_phone" placeholder="011-34838724" pattern=(\d{3}-\d{8}) required>
		</div>
		<hr>
		<div class="elem-group inlined">
		  <label for="adult">Adults</label>
		  <input type="number" id="adult" name="total_adults" placeholder="2" min="1" required>
		</div>
		<div class="elem-group inlined">
		  <label for="child">Children</label>
		  <input type="number" id="child" name="total_children" placeholder="2" min="0" required>
		</div>
		<div class="elem-group inlined">
		  <label for="checkin-date">Check-in Date</label>
		  <input type="date" id="checkin-date" name="checkin" required>
		</div>
		<div class="elem-group inlined">
		  <label for="checkout-date">Check-out Date</label>
		  <input type="date" id="checkout-date" name="checkout" required>
		</div>
		<hr>
		<div class="elem-group">
		  <label for="message">Anything Else?</label>
		  <textarea id="message" name="visitor_message" placeholder="Tell us anything else that might be important." required></textarea>
		</div>
		<hr>
		<h2>Payment Information</h2>
		<div class="elem-group">
			<label for="card-name">Cardholder Name</label>
			<input type="text" id="card-name" name="card_name" placeholder="John Doe" required>
		</div>
		<div class="elem-group">
			<label for="card-number">Card Number</label>
			<input type="text" id="card-number" name="card_number" placeholder="1234 5678 9101 1121" pattern="\d{4} \d{4} \d{4} \d{4}" maxlength="19" required>
		</div>
		<div class="elem-group inlined">
			<label for="exp-date">Expiration Date</label>
			<input type="month" id="exp-date" name="exp_date" required>
		</div>
		<div class="elem-group inlined">
			<label for="cvv">CVV</label>
			<input type="text" id="cvv" name="cvv" placeholder="123" pattern="\d{3}" maxlength="3" required>
		</div>
		<button type="submit">Book The Rooms</button>
	  </form>
	</div>
		
</div>
</div>



</div>

	<script>
	// Get the modal
var modal = document.getElementById("myModal");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

// Get all images with the class "clickable-img"
var images = document.querySelectorAll(".clickable-img");

// Loop through each image and add an event listener
images.forEach(function(img) {
  img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  };
});

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
};

	</script>

	<script>
			var currentDateTime = new Date();
	var year = currentDateTime.getFullYear();
	var month = (currentDateTime.getMonth() + 1);
	var date = (currentDateTime.getDate() + 1);

	if(date < 10) {
	date = '0' + date;
	}
	if(month < 10) {
	month = '0' + month;
	}

	var dateTomorrow = year + "-" + month + "-" + date;
	var checkinElem = document.querySelector("#checkin-date");
	var checkoutElem = document.querySelector("#checkout-date");

	checkinElem.setAttribute("min", dateTomorrow);

	checkinElem.onchange = function () {
		checkoutElem.setAttribute("min", this.value);
	}
	</script>

	<script>
		function myFunction() {
		var dots = document.getElementById("dots");
		var moreText = document.getElementById("more");
		var btnText = document.getElementById("myBtn");

		if (dots.style.display === "none") {
			dots.style.display = "inline";
			btnText.innerHTML = "Read more";
			moreText.style.display = "none";
		} else {
			dots.style.display = "none";
			btnText.innerHTML = "Read less";
			moreText.style.display = "inline";
		}
		}
	</script>

</body>
</html>
