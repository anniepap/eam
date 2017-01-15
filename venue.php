<?php
  require_once "login.php";
  $conn = new mysqli ($hn, $un, $pw, $db);
  if ($conn->connect_error) die ($conn->connect_error);
  if(!isset($_SESSION)) { 
    session_start();
  }

  $dest = "profile.php";
  if (!isset($_SESSION['username'])) {
    $dest = "#";
  }

  $uname = isset($_POST['uname'])?$_POST['uname']:'';
  $psw = isset($_POST['psw'])?$_POST['psw']:'';
  
  if (!isset($_SESSION['loggedin'])) {
    $log = "document.getElementById('id01').style.display='block'";
  }
  else {
    $log = "#";
  }

  if (!empty($uname) and !empty($psw) and !isset($_SESSION['loggedin'])) {
    $query = "select * from Users where username= '$uname' and password= '$psw'";
    $result = $conn->query($query);
    if (!$result) die($conn->error);
    if ($result->num_rows > 0) {
      $_SESSION['username'] = $uname;
      $_SESSION['loggedin'] = "y";
      header("Location: http://localhost/euromed/profile.php");
      exit();
    }
    else {
      echo "<script> alert('Username and Password do not match.'); </script>";
    }
  }
  $conn->close();
?>

<html>
<head>
  <title>
    Euromed2016 | Venue Details
  </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div id="page">
    <div id="logo">
      <a href="index.php">
        <img src="images/logo2.png"/>
      </a>
    </div>
    <div id="search">
      <form method="get">
        <input type="text" name="search" placeholder="Search...">
        <input type="image" src="images/search_icon.png">
      </form>
    </div>
    <div id="profile">
      <form action=<?php echo $dest ?> method="post">
        <input type="image" src="images/profile_icon.png" width="28" height="28">
        <a href="#" onclick=<?php echo $log; ?> style="width:auto;">Sign in</a> | <a href="signup.php">Sign up</a>
      </form>
    </div>

    <div id="id01" class="modal">
      <form class="modal-content animate" method="post">
        <div class="container">
          <label><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="uname" required="required">
          <label><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required="required">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          <button type="submit">Log in</button>
        </div>
      </form>
    </div>
    
  	<div id="menu">
  	  <ul>
  		  <li class="dropdown">
      		<a href="#" class="dropbtn">PROGRAM</a>
    	    <div class="dropdown-content">
        		<a href="overview.php">Overview</a>
          	<a href="keynotes.php">Keynote Speakers</a>
          	<a href="workshops.php">Workshops</a>
          	<a href="timetable.php">Timetable</a>
        	</div>
      	</li>
      	<li class="dropdown">
      		<a href="#" class="dropbtn_active">VENUE</a>
    	    <div class="dropdown-content">
        		<a href="venue.php">Venue Details</a>
          	<a href="travel_transport.php">Travel and Transport</a>
          	<a href="#">About Cyprus</a>
        	</div>
      	</li>
      	<li class="dropdown">
      		<a href="#" class="dropbtn">CALL FOR PAPERS</a>
    	    <div class="dropdown-content">
        		<a href="papersubmission.php">Paper Submission</a>
        		<a href="guidelines.php">Submission Guidelines</a>
          </div>
      	</li>
      	<li class="dropdown">
      		<a href="#" class="dropbtn">EXHIBITION</a>
    	    <div class="dropdown-content">
    		    <a href="exh_info.php">Useful Info</a>
        		<a href="#">Exhibitors</a>
        		<a href="#">Register as Exhibitor</a>  		
          </div>
      	</li>
    		<li><a href="register.php">REGISTER</a></li>
    		<li><a href="sponsors.php">SPONSORS</a></li>
    	</ul>
    </div>
    <div id="dates">
    <table class="sidetable">
      <tr>
        <th><a href="dates.php">Important Dates</a></th>
      </tr>
      <tr>
        <td>Date 1</td>
      </tr>
      <tr>
        <td>Date 2</td>
      </tr>
      <tr>
        <td>Date 3</td>
      </tr>
    </table>
    </div>
    <div id="announs">
    <table class="sidetable">
      <tr>
        <th><a href="#">Announcements</a></th>
      </tr>
      <tr>
        <td>Announcement 1</td>
      </tr>
      <tr>
        <td>Announcement 2</td>
      </tr>
      <tr>
        <td>Announcement 3</td>
      </tr>
    </table>
    </div>
    <div id="context">
      <h2>Venue Details</h2>
      <div id="filoxenia_info">
        <h4>Filoxenia Conference Center</h4>
        <ul>
          <li>Kareas, Aglantzia, Nicosia, Cyprus</li>
          <li>Tel. +357 22 395000</li>
          <li><a href="http://www.fcc.com.cy/el/" target="_blank">www.fcc.com.cy</a></li>
        </ul>
        <p>The Filoxenia Conference Centre was completely renovated to welcome guests from all over Europe during the Cypriot Presidency of the EU in 2012. Now it's a modern conference facility, which hosts a wide range of events and honors the timeless tradition of Cypriot hospitality.</p>
      </div>
      <div class="slideshow">
        <img class="mySlides" src="images/filoxenia1.jpg" width=512px height=340px>
        <img class="mySlides" src="images/filoxenia2.jpg" width=512px height=340px>
        <img class="mySlides" src="images/filoxenia3.jpg" width=512px height=340px>
        <img class="mySlides" src="images/filoxenia4.jpg" width=512px height=340px>
        <img class="mySlides" src="images/filoxenia5.jpg" width=512px height=340px>
        <a class="prev" onclick="plusDivs(-1)">&#10094;</a>
        <a class="next" onclick="plusDivs(1)">&#10095;</a>
      </div>
      <script>
      var slideIndex = 1;
      showDivs(slideIndex);

      function plusDivs(n) {
        showDivs(slideIndex += n);
      }

      function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
           x[i].style.display = "none";  
        }
        x[slideIndex-1].style.display = "block";  
      }
      </script>

      <div id="filoxenia_more">
        <h4>Useful Information:</h4>
        <ul>
          <li><b>Wheelchair Facilities:</b> Filoxenia Conference Centre is completely wheelchair accessible and is fully equipped to accommodate people with special access needs.</li>
          <li><b>Parking:</b> If you are traveling via car, a large parking space outside the Centre provides easy access to the venue. A parking space for approximately 70 vehicles is also available within the Centre’s premises.</li>
          <li><b>Internet access:</b> Internet access (12Mb)will be provided in the Internet room, where ten multimedia PCs and a laser printer in a wireless LAN will be available for the event delegates. Standard tools will be installed on the computers (Internet Explorer, Microsoft Office and Adobe Reader). The computer facilities will be open for use between 7:30 am and 20:00 pm.</li>
          <li><b>Smoking:</b> Smoking is strictly forbidden within all the conference rooms. You can have a smoke outside the event rooms (coffee break areas).</li>
          <li><b>Safety note:</b> Since the rooms can not be locked, please do not store expensive equipment brought for information stands (computers, screens, etc.) in the dining rooms at night. We will provide a special locked storage room, but the local organizing committee will not be responsible for lost, stolen, or damaged items.</li>
        </ul>
        <p><b>Reminder:</b> Please, always wear your conference badge within the conference venue, including lunch breaks and the evening programs. You will not be allowed to attend the conference or have coffees/teas/meals without your badge.</p>
      </div>

    </div>
  </div>
</body>