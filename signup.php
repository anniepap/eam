<html>
<head>
  <title>
    Euromed2016 | Sign up
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
        		<a href="#">Paper Submission</a>
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

    <?php
      require_once "login.php";
      $conn = new mysqli ($hn, $un, $pw, $db);
      if ($conn->connect_error) die ($conn->connect_error);
      session_start();
    ?>
    <div id="context">
      <h2>Sign up</h2>
      <div id="signup">
        <form action="signup.php" method="post">
          Username:<br>
          <input type="text" value="<?php $username = isset($_POST['username'])?$_POST['username']:''; echo htmlspecialchars($username);?>" name="username">
          <br>
          Password:<br>
          <input type="password" name="pwd">
          <br>
          Password Confirmation:<br>
          <input type="password" name="pwd_con">
          <br>
          E-mail:<br>
          <input type="text" value="<?php $email = isset($_POST['email'])?$_POST['email']:''; echo htmlspecialchars($email);?>" name="email">
          <br>
          Date of Birth:<br>
          <input type="date" value="<?php $bday = isset($_POST['bday'])?$_POST['bday']:''; echo htmlspecialchars($bday);?>" name="bday" placeholder="yyyy-mm-dd">
          <br>
          First Name:<br>
          <input type="text" value="<?php $first = isset($_POST['first'])?$_POST['first']:''; echo htmlspecialchars($first);?>" name="first">
          <br>
          Last Name:<br>
          <input type="text" value="<?php $last = isset($_POST['last'])?$_POST['last']:''; echo htmlspecialchars($last);?>" name="last">
          <br>
          Affiliation:<br>
          <input type="text" value="<?php $affil = isset($_POST['affil'])?$_POST['affil']:''; echo htmlspecialchars($affil);?>" name="affil">
          <br>
          Country:<br>
          <input type="text" value="<?php $country = isset($_POST['country'])?$_POST['country']:''; echo htmlspecialchars($country);?>" name="country">
          <br>
          <input type="reset" value="Reset">
          <input type="submit" value="Submit">
        </form>
      </div>
    </div>

    <?php
      $username = isset($_POST['username'])?$_POST['username']:'';
      $password = isset($_POST['pwd'])?$_POST['pwd']:'';
      $password_con = isset($_POST['pwd_con'])?$_POST['pwd_con']:'';
      $email = isset($_POST['email'])?$_POST['email']:'';
      $birthday = isset($_POST['bday'])?$_POST['bday']:'';
      $first_name = isset($_POST['first'])?$_POST['first']:'';
      $last_name = isset($_POST['last'])?$_POST['last']:'';
      $affil = isset($_POST['affil'])?$_POST['affil']:'';
      $country = isset($_POST['country'])?$_POST['country']:'';

      if (!empty($username) and !empty($password) and !empty($password_con) and !empty($email) and !empty($birthday) 
        and !empty($first_name) and !empty($last_name) and !empty($affil) and !empty($country)) {
        
        $query = "select * from Users where username= '$username'";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
        if ($result->num_rows > 0) {
          echo "<div class=\"required\">All fields are required.</div>";
          echo "<div class=\"wrong_us\">Username already exists.</div>";
        }
        else if ($password != $password_con) {
          echo "<div class=\"required\">All fields are required.</div>";
          echo "<div class=\"wrong_pw\">Confirmation did not match the password.</div>";
        }
        else {
          $query = "insert into Users (Username, Password, Email, DateOfBirth, FirstName, LastName, Affiliation, Country) 
          values ('$username', '$password', '$email', '$birthday', '$first_name', '$last_name', '$affil', '$country')";
          $conn->query($query);
          $_SESSION['username'] = $username;
          header("Location: http://localhost/euromed/profile.php");
          exit();
        }
      }
      else {
        echo "<div class=\"required\">All fields are required.</div>";
      }
      //while($row = $result->fetch_assoc()) {
        //  echo "Username: " . $row["Username"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]. "<br>";
        //}

      $conn->close();
    ?>

  </div>
</body>