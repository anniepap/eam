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

  $total=0;
  $extras=0;
  $ent="0";
  $day1="0";
  $day2="0";
  $day3="0";
  $day4="0";
  $day5="0";
  $day1_w="0";
  $day2_w="0";
  $day3_w="0";
  $day4_w="0";
  $day5_w="0";
  $ent_stu = isset($_POST['entire_stu'])?$_POST['entire_stu']:'';
  $ent_non = isset($_POST['entire_non'])?$_POST['entire_non']:'';
  $ent2= isset($_POST['entire_item2'])?$_POST['entire_item2']:'';
  $ent4= isset($_POST['entire_item4'])?$_POST['entire_item4']:'';
  $dai1= isset($_POST['daily_item1'])?$_POST['daily_item1']:'';
  $dai2= isset($_POST['daily_item2'])?$_POST['daily_item2']:'';
  $dai4= isset($_POST['daily_item4'])?$_POST['daily_item4']:'';
  $d_stu = isset($_POST['daily_stu'])?$_POST['daily_stu']:'';
  $d_non = isset($_POST['daily_non'])?$_POST['daily_non']:'';

if (isset($_POST['entire_stu'])) {
  $ent="1";
	$total=$total+$ent_stu*450;
	if (isset($_POST['entire_item2'])){
		$total=$total+$ent2*35;
		$extras=$extras+$ent2*35;
	}
	if (isset($_POST['entire_item4'])){
		$total=$total+$ent4*40;
		$extras=$extras+$ent4*40;
	}
}
if (isset($_POST['entire_non'])) {
  $ent="1";
	$total=$total+$ent_non*500;
	if (isset($_POST['entire_item2'])){
		$total=$total+$ent2*35;
		$extras=$extras+$ent2*35;
	}
	if (isset($_POST['entire_item4'])){
		$total=$total+$ent4*40;
		$extras=$extras+$ent4*40;
	}
}
if (isset($_POST['daily_stu'])) {
	if (isset($_POST['day1'])) {
		$total=$total+$d_stu*155;
    if ($_POST['day1'] == "full") {
  		$day1="1";
    }
    else if ($_POST['day1'] == "work") {
  		$day1_w="1";
	  }
  }
	if (isset($_POST['day2'])){
		$total=$total+$d_stu*155;
    if ($_POST['day2'] == "full") {
  		$day2="1";
    }
    else if ($_POST['day2'] == "work") {
  		$day2_w="1";
	  }
  }
	if (isset($_POST['day3'])){
		$total=$total+$d_stu*155;
    if ($_POST['day3'] == "full") {
  		$day3="1";
    }
    else if ($_POST['day3'] == "work") {
  		$day3_w="1";
	  }
  }
	if (isset($_POST['day4'])){
		$total=$total+$d_stu*155;
    if ($_POST['day4'] == "full") {
  		$day4="1";
    }
    else if ($_POST['day4'] == "work") {
  		$day4_w="1";
	  }
  }
	if (isset($_POST['day5'])){
		$total=$total+$d_stu*155;
    if ($_POST['day5'] == "full") {
		  $day5="1";
    }
    else if ($_POST['day5'] == "work") {
  		$day5_w="1";
	  }
  }
	if (isset($_POST['daily_item1'])){
		$total=$total+$dai1*50;
		$extras=$extras+$dai1*50;
	}
	if (isset($_POST['daily_item2'])){
		$total=$total+$dai2*35;
		$extras=$extras+$dai2*35;
	}
	if (isset($_POST['daily_item4'])){
		$total=$total+$dai4*40;
		$extras=$extras+$dai4*40;
	}	
}
if (isset($_POST['daily_non'])){
	if (isset($_POST['day1'])){
		$total=$total+$d_stu*190;
		if ($_POST['day1'] == "full") {
      $day1="1";
    }
    else if ($_POST['day1'] == "work") {
      $day1_w="1";
    }
	}
	if (isset($_POST['day2'])){
		$total=$total+$d_stu*190;
		if ($_POST['day2'] == "full") {
      $day2="1";
    }
    else if ($_POST['day2'] == "work") {
      $day2_w="1";
    }
	}
	if (isset($_POST['day3'])){
		$total=$total+$d_stu*190;
    if ($_POST['day3'] == "full") {
      $day3="1";
    }
    else if ($_POST['day3'] == "work") {
      $day3_w="1";
    }
	}
	if (isset($_POST['day4'])){
		$total=$total+$d_stu*190;
		if ($_POST['day4'] == "full") {
      $day4="1";
    }
    else if ($_POST['day4'] == "work") {
      $day4_w="1";
    }
	}
	if (isset($_POST['day5'])){
		$total=$total+$d_stu*190;
		if ($_POST['day5'] == "full") {
      $day5="1";
    }
    else if ($_POST['day5'] == "work") {
      $day5_w="1";
    }
	}
	if (isset($_POST['daily_item1'])){
		$total=$total+$dai1*50;
		$extras=$extras+$dai1*50;
	}
	if (isset($_POST['daily_item2'])){
		$total=$total+$dai2*35;
		$extras=$extras+$dai2*35;
	}
	if (isset($_POST['daily_item4'])){
		$total=$total+$dai4*40;
		$extras=$extras+$dai4*40;
	}	
}

  if (isset($_POST['register'])) {
    if (!isset($_SESSION['loggedin'])) {
      echo "<script> alert('Please sign in on make an account to complete your registration.'); </script>";
    }
    else {
    	$_SESSION['reg_conf']=$total; 
    	$_SESSION['reg_conf1']=$extras; 
    	$_SESSION['reg_conf2']=$ent.$day1.$day2.$day3.$day4.$day5.$day1_w.$day2_w.$day3_w.$day4_w.$day5_w;
      $_SESSION['reg_conf3']=$ent_stu."-".$ent_non;
      $_SESSION['reg_conf4']=$ent2."-".$ent4;
      $_SESSION['reg_conf5']=$d_stu."-".$d_non;
      $_SESSION['reg_conf6']=$dai1."-".$dai2."-".$dai4;
      header("Location: http://localhost/euromed/reg_confirm.php");
    }
  }

  $conn->close();
?>

<html>
<head>
	<title>
		Euromed2016 | Register
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
    		<li><a class="dropbtn_active" href="register.php">REGISTER</a></li>
    		<li><a href="#">SPONSORS</a></li>
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
      <h2>Registration Info</h2>
      <p><b>Early Bird until:</b> 15 Oct 2016</p>
      <p><b>Late Bird until: </b> 25 Oct 2016</p></br>
      <p><b>Ways of Payment</b></p>
      <div id="packages_info">
        <ul>
          <li class="pay_li">
            <p>Mastecard</p> <img class="payway" src="images/mastercard.jpg" width="28" height="28">
          </li>
          <li class="pay_li">
            <p>PayPal</p> <img class="payway" src="images/paypal.png" width="24" height="24">
          </li>
          <li class="pay_li">
            <p>Visa</p>  <img class="payway" src="images/visa.png" width="22" height="22">
          </li>
        </ul>
      </div>
      <h4>Entire Program*</h4>
      <div class="program_include">
        <table id="tablestyle">
        <form method="post">
          <tr>
            <th></th>
            <th>Early Bird</th>
            <th>Standard</th>
            <th>Persons</th>
          </tr>
          <tr>
            <td>Students</td>
            <td>360&euro;</td>
            <td>450&euro;</td>
            <td><input type="number" name="entire_stu" value="0" min="0" max="10"></td>
          </tr>
          <tr>
            <td>Non Students</td>
            <td>440&euro;</td>
            <td>500&euro;</td>
            <td><input type="number" name="entire_non" value="0" min="0" max="10"></td>
          </tr>
        </table>
        <p>*Including Extras: Item1, Item3</p>
        <table id="tablestyle">
          <tr>
            <th>Extras</th>
            <th></th>
          </tr>
          <tr>
            <td><input type="number" name="entire_item2" value="0" min="0" max="20"> Item2 (35&euro;)</td>
            <td><input type="number" name="entire_item4" value="0" min="0" max="20"> Item4 (40&euro;)</td>
          </tr>
        </table>
      </div>
      </br>
      <h4>Daily Program*</h4>
      <button type="button" class="daysbtn" onclick="document.getElementById('id03').style.display='block'">Select Days</button>
      </br>
      <div id="id03" class="days_modal">
        <div class="modal_cont_edit">
          <div class="container edit_cont">
            <input type="radio" name="day1" value="full"> Full Day1 or <input type="radio" name="day1" value="work"> Workshops only<br>
            <input type="radio" name="day2" value="full"> Full Day2 or <input type="radio" name="day2" value="work"> Workshops only<br>
            <input type="radio" name="day3" value="full"> Full Day3 or <input type="radio" name="day3" value="work"> Workshops only<br>
            <input type="radio" name="day4" value="full"> Full Day4 or <input type="radio" name="day4" value="work"> Workshops only<br>
            <input type="radio" name="day5" value="full"> Full Day5 or <input type="radio" name="day5" value="work"> Workshops only<br>
            <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
          </div>
        </div>
      </div>

      <div class="program_include">
        <table id="tablestyle">
          <tr>
            <th></th>
            <th>Early Bird</th>
            <th>Standard</th>
            <th>Persons</th>
          </tr>
          <tr>
            <td>Students</td>
            <td>125&euro;</td>
            <td>155&euro;</td>
            <td><input type="number" name="daily_stu" value="0" min="0" max="10"></td>
          </tr>
          <tr>
            <td>Non Students</td>
            <td>180&euro;</td>
            <td>190&euro;</td>
            <td><input type="number" name="daily_non" value="0" min="0" max="10"></td>
          </tr>
        </table>
        <p>*Including Extra: Item3</p>
        <table id="tablestyle">
          <tr>
            <th>Extras</th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <td><input type="number" name="daily_item1" value="0" min="0" max="20"> Item1 (50&euro;)</td>
            <td><input type="number" name="daily_item2" value="0" min="0" max="20"> Item2 (35&euro;)</td>
            <td><input type="number" name="daily_item4" value="0" min="0" max="20"> Item4 (40&euro;)</td>
          </tr>
        </table>
      </div>
      </br>
      <h4>Total Cost:</h4>
      <div class="program_include">
        <table id="tablestyle">
          <tr>
              <td>Registration Fees</td>
              <td>&euro;</td>
            </tr>
            <tr>
              <td>Extras</td>
              <td>&euro;</td>
            </tr>
            <tr>
              <td><b>Total</b></td>
              <td>&euro;</td>
            </tr>
        </table>
      </div>
      </br>
        <button type="submit" name="register" class="regbtn">REGISTER NOW</button>
      </form>
    </div>
  </div>
</body>