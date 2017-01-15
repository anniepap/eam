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

  $error = '';

  $username = isset($_POST['username'])?$_POST['username']:'';
  $password = isset($_POST['pwd'])?$_POST['pwd']:'';
  $password_con = isset($_POST['pwd_con'])?$_POST['pwd_con']:'';
  $email = isset($_POST['email'])?$_POST['email']:'';
  $year = isset($_POST['year'])?$_POST['year']:'';
  $month = isset($_POST['month'])?$_POST['month']:'';
  $day = isset($_POST['day'])?$_POST['day']:'';
  $first_name = isset($_POST['first'])?$_POST['first']:'';
  $last_name = isset($_POST['last'])?$_POST['last']:'';
  $affil = isset($_POST['affil'])?$_POST['affil']:'';
  $country = isset($_POST['country'])?$_POST['country']:'';

  if (!empty($username) and !empty($password) and !empty($password_con) and !empty($email) and !empty($year) and !empty($month) and !empty($day) 
    and !empty($first_name) and !empty($last_name) and !empty($affil) and !empty($country)) {
    
    $query = "select * from Users where username= '$username'";
    $result = $conn->query($query);
    if (!$result) die($conn->error);
    if ($result->num_rows > 0) {
      $error = "Username already exists.<br>";
    }
    if ($password != $password_con) {
      $error = $error."Confirmation did not match the password.<br>";
    }
    if (!preg_match("/^[0-9]+$/", $year) or !preg_match("/^[0-9]+$/", $month) or !preg_match("/^[0-9]+$/", $day)) {
      $error = $error."Date of Birth can only contain numbers.<br>";
    }
    if (!($error != '')) {
      $birthday = $year."-".$month."-".$day;
      $query = "insert into Users (Username, Password, Email, DateOfBirth, FirstName, LastName, Affiliation, Country) 
      values ('$username', '$password', '$email', '$birthday', '$first_name', '$last_name', '$affil', '$country')";
      $conn->query($query);
      $_SESSION['username'] = $username;
      header("Location: http://localhost/euromed/profile.php");
      exit();
    }
    else {
      $error = "<div class=\"wrong_inp\">".$error."</div>";
    }
  }
  $conn->close();
?>

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
      <h2>Sign up</h2>
      <div id="signup">
        <p>All fields are required.</p>
        <form action="signup.php" method="post">

          <?php if ($error != ''): ?>
          <?php echo $error; ?>
          <?php endif; ?>

          Username:<br>
          <input type="text" value="<?php $username = isset($_POST['username'])?$_POST['username']:''; echo htmlspecialchars($username);?>" name="username" required="required">
          <br>
          Password:<br>
          <input type="password" name="pwd" required="required">
          <br>
          Password Confirmation:<br>
          <input type="password" name="pwd_con" required="required">
          <br>
          E-mail:<br>
          <input type="email" value="<?php $email = isset($_POST['email'])?$_POST['email']:''; echo htmlspecialchars($email);?>" name="email" required="required">
          <br>
          Date of Birth:<br>
          <div id="birthday">
            <input type="text" value="<?php $year = isset($_POST['year'])?$_POST['year']:''; echo htmlspecialchars($year);?>" name="year" placeholder="yyyy" size="4" maxlength="4" required="required"> - 
            <input type="text" value="<?php $month = isset($_POST['month'])?$_POST['month']:''; echo htmlspecialchars($month);?>" name="month" placeholder="mm" size="2" maxlength="2" required="required"> - 
            <input type="text" value="<?php $day = isset($_POST['day'])?$_POST['day']:''; echo htmlspecialchars($day);?>" name="day" placeholder="dd" size="2" maxlength="2" required="required">
          </div>
          First Name:<br>
          <input type="text" value="<?php $first = isset($_POST['first'])?$_POST['first']:''; echo htmlspecialchars($first);?>" name="first" required="required">
          <br>
          Last Name:<br>
          <input type="text" value="<?php $last = isset($_POST['last'])?$_POST['last']:''; echo htmlspecialchars($last);?>" name="last" required="required">
          <br>
          Affiliation:<br>
          <input type="text" value="<?php $affil = isset($_POST['affil'])?$_POST['affil']:''; echo htmlspecialchars($affil);?>" name="affil" required="required">
          <br>
          Country:<br>
          <input type="text" value="<?php $country = isset($_POST['country'])?$_POST['country']:''; echo htmlspecialchars($country);?>" name="country" required="required">
          <br>
          <input type="reset" value="Reset">
          <input type="submit" value="Submit">
        </form>
      </div>
    </div>
  </div>
</body>