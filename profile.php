<?php
  require_once "login.php";
  $conn = new mysqli ($hn, $un, $pw, $db);
  if ($conn->connect_error) die ($conn->connect_error);
  if(!isset($_SESSION)) {
    session_start();
  }
  $username = $_SESSION['username'];

  if(isset($_POST['submit_edit'])) {
    $fname = isset($_POST['fname_edit'])?$_POST['fname_edit']:'';
    $lname = isset($_POST['lname_edit'])?$_POST['lname_edit']:'';
    $country = isset($_POST['country_edit'])?$_POST['country_edit']:'';
    $affil = isset($_POST['affil_edit'])?$_POST['affil_edit']:'';
    $year = isset($_POST['year_edit'])?$_POST['year_edit']:'';
    $month = isset($_POST['month_edit'])?$_POST['month_edit']:'';
    $day = isset($_POST['day_edit'])?$_POST['day_edit']:'';

    $x = 0;
    $query = "update Users set ";
    if (!empty($fname)) {
      $query = $query."FirstName='$fname'";
      $x = $x+1;
    }
    if (!empty($lname)) {
      if ($x > 0) {
        $query = $query.", ";
      }
      $query = $query."LastName='$lname'";
      $x = $x+1;
    }
    if (!empty($country)) {
      if ($x > 0) {
        $query = $query.", ";
      }
      $query = $query."Country='$country'";
      $x = $x+1;
    }
    if (!empty($affil)) {
      if ($x > 0) {
        $query = $query.", ";
      }
      $query = $query."Affiliation='$affil'";
      $x = $x+1;
    }
    if (!empty($year) and !empty($month) and !empty($day)) {
      $bday = $year."-".$month."-".$day;
      if ($x > 0) {
        $query = $query.", ";
      }
      $query = $query."DateOfBirth='$bday'";
      $x = $x+1;
    }

    if ($x > 0) {
      $query = $query." where Username='$username'";
      $conn->query($query);
    }
  }

  $query = "select * from Users where username= '$username'";
  $result = $conn->query($query);
  if (!$result) die($conn->error);
  $person = "<div class=\"person_info\">";
  $row = $result->fetch_assoc();
  $uname = $row["Username"];
  $fname = $row["FirstName"];
  $lname = $row["LastName"];
  $country = $row["Country"];
  $affil = $row["Affiliation"];
  $bday = $row["DateOfBirth"];
  $split = explode("-", $bday);
  $year = $split[0];
  $month = $split[1];
  $day = $split[2];
  $person = $person."<p>".$fname."</p><p>".$lname."</p><p>".$country."</p><p>".$affil."</p><p>".$bday."</p></div>";
?>

<html>
<head>
  <title>
    Euromed2016 | My Profile
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
  		<form method="get">
    		<input type="image" src="images/profile_icon.png" width="28" height="28">
    		<a href="#">Sign in</a> | <a href="signup.php">Sign up</a>
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
      		<a href="#" class="dropbtn">VENUE</a>
    	    <div class="dropdown-content">
        		<a href="venue.html">Venue Details</a>
          	<a href="travel_transport.html">Travel and Transport</a>
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
        <th><a href="#">Important Dates</a></th>
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
      <h2><?php echo $uname; ?> 's profile</h2>
      <div id="person">
        <p>First Name:</p>
        <p>Last Name:</p>
        <p>Country:</p>
        <p>Affiliation:</p>
        <p>Date of Birth:</p>
      </div>
      <button type="button" class="editbtn" onclick="document.getElementById('id02').style.display='block'">Edit</button>
      <?php echo $person; ?>

      <div id="id02" class="edit_modal">
        <form class="modal_cont_edit" method="post" action="profile.php">
          <div class="container edit_cont">
            <input type="text" placeholder="<?php echo $fname; ?>" name="fname_edit">
            <input type="text" placeholder="<?php echo $lname; ?>" name="lname_edit">
            <input type="text" placeholder="<?php echo $country; ?>" name="country_edit">
            <input type="text" placeholder="<?php echo $affil; ?>" name="affil_edit">
            <div id="birthday">
              <input type="text" name="year_edit" placeholder="<?php echo $year; ?>" size="4" maxlength="4"> - 
              <input type="text" name="month_edit" placeholder="<?php echo $month; ?>" size="2" maxlength="2"> - 
              <input type="text" name="day_edit" placeholder="<?php echo $day; ?>" size="2" maxlength="2">
            </div>
            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
            <button type="submit" name="submit_edit">Done</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</body>