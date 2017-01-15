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
		Euromed2016 | Workshops
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
      		<a href="#" class="dropbtn_active">PROGRAM</a>
    	    <div class="dropdown-content">
        		<a href="overview.php">Overview</a>
          	<a href="keynotes.php">Keynote Speakers</a>
          	<a href="workshops.php">Workshops</a>
          	<a href="timetable.php">Timetable</a>
        	</div>
      	</li>
      	<li class="dropdown">
      		<a href="#" class="dropbtn">VENUE</a>
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
    		<li><a href="#">SPONSORS</a></li>
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
        <th><a href="announcements.php">Announcements</a></th>
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
      <h2>Workshops</h2>
      <div class="workshop">
        <h4>A. Joint Workshops: The 1st International Workshop on Virtual Reality, Gamification and Cultural Heritage & The 3rd International Workshop on 3D Research Challenges in Cultural Heritage</h4>
        <p><b>Date: </b>Friday 4th November, 16.00-18.30 p.m.</p>
        <p>The introduction of the first generation of virtual reality systems for consumers along with the latest developments in computer game technologies has provided numerous new possibilities of using Virtual Reality for Cultural Heritage related applications. The aim of VRGCH’2016 is to provide a forum for discussing the latest developments in the areas of Virtual Reality, gamification and Cultural Heritage so that novel applications and future perspectives are exposed to workshop delegates. Topics of interest include, but are not limited to:</p>
        <ul>
          <li>Advances in the field of Virtual Reality/Computer Games related to digital Cultural Heritage</li>
          <li>Gamification and Cultural Heritage</li>
          <li>Avatars, Presence and Cultural Heritage Applications</li>
          <li>Novel applications of Virtual Reality/Computer Games in the field of Cultural Heritage</li>
          <li>User Evaluation of Virtual Reality/Computer Games in Cultural Heritage applications</li>
        </ul>
      </div>
      <div class="workshop">
        <h4>B. Information and Communication Technologies for Cultural Heritage Applications (InCuTe4CH)</h4>
        <p><b>Date: </b>Thursday 3rd November, 16.00-18.30 p.m.</p>
        <p>InCuTe4CH is to serve as an international forum for experts from both academia and industry to present their latest research findings, ideas, development and applications in the wide area of cultural heritage preservation, including vision based systems, search engines for efficient image retrieval photogrammetry, 3D reconstruction and publishing, semantics, learning based systems and archiving. Topics of interest include, but are not limited to the following areas:</p>
        <ul>
          <li>Low level processing of RGB, thermal and hyperspectral imaging for cultural heritage applications</li>
          <li>Spatio-temporal analysis of cultural heritage sites</li>
          <li>Content based image retrieval schemes for unstructured image data-drive</li>
          <li>Image indexing techniques for big image data</li>
          <li>Sapling techniques for selecting for image selection towards computationally efficient and accurate 3D reconstruction</li>
          <li>Recommendation systems for personalized cultural heritage dissemination</li>
          <li>Photogrammetry techniques for efficient cultural heritage digitization</li>
          <li>Multi-sensory and multi-modal (laser scanners, LiDAR) approaches towards digitization of tangible cultural heritage content</li>
          <li>Documentation and archiving methods for cultural heritage content communication</li>
          <li>Semantic annotation methods for cultural heritage data</li>
        </ul>
        <p><b>Note: </b>The specific workshop will be part of the EU 4D-CH-World, the H2020 COOP-8 ViMM and the ITN-DCH projects.</p>
      </div>
      <a href="papersubmission.php" class="shortcutbutton">Submit your Workshop</a>
    </div>
  </div>
</body>