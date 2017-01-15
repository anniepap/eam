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

  $username = $_SESSION['username'];
  $query = "select * from Users where username= '$username'";
  $result = $conn->query($query);
  if (!$result) die($conn->error);
  $person = "<div class=\"person_info\">";
  $row = $result->fetch_assoc();
  $fname = $row["FirstName"];
  $lname = $row["LastName"];
  $email = $row["Email"];
  $country = $row["Country"];
  $affil = $row["Affiliation"];
  $person = $person."<p>".$fname."</p><p>".$lname."</p><p>".$email."</p><p>".$country."</p><p>".$affil."</p></div>";

  if(isset($_SESSION['reg_conf'])) {
    $total = $_SESSION['reg_conf'];
  }
  if(isset($_SESSION['reg_conf1'])) {
    $extras = $_SESSION['reg_conf1'];
  }
  if(isset($_SESSION['reg_conf2'])) {
    $daily = $_SESSION['reg_conf2'];
  }
  if(isset($_SESSION['reg_conf3'])) {
    $reg_conf3 = $_SESSION['reg_conf3'];
    $ent_stu = explode("-", $reg_conf3);
  }
  if(isset($_SESSION['reg_conf4'])) {
    $reg_conf4 = $_SESSION['reg_conf4'];
    $ent_it = explode("-", $reg_conf4);
  }
  if(isset($_SESSION['reg_conf5'])) {
    $reg_conf5 = $_SESSION['reg_conf5'];
    $dai_stu = explode("-", $reg_conf5);
  }
  if(isset($_SESSION['reg_conf6'])) {
    $reg_conf6 = $_SESSION['reg_conf6'];
    $dai_it = explode("-", $reg_conf6);
  }

  $fees = $total - $extras;

  $pay_for = "<div class=\"pay_for\"><table id=\"tablestyle\">";
  $len = strlen($daily);
  for($i = 0; $i <= $len; $i++) {
    $str = substr($daily, $i, 1);
    $x = $i+1;
    if ($str == "1" and $i == 0) {
      $pay_for = $pay_for."<tr><td>Entire Program</td>";
      if ($ent_stu[0] != "0") {
        $pay_for = $pay_for."<td>".$ent_stu[0]." Students</td>";
      }
      if ($ent_stu[1] != "0") {
        $pay_for = $pay_for."<td>".$ent_stu[1]." Non Students</td>";
      }
      if ($ent_it[0] != "0") {
        $pay_for = $pay_for."<td>".$ent_it[0]." x Item2</td>";
      }
      if ($ent_it[1] != "0") {
        $pay_for = $pay_for."<td>".$ent_it[1]." x Item4</td>";
      }
      $pay_for = $pay_for."<td></td>";
      $pay_for = $pay_for."</tr>";
    }
    else if ($str == "1" and $i < 6) {
      $pay_for = $pay_for."<tr><td>Full Day".$i."</td>";
      if ($dai_stu[0] != "0") {
        $pay_for = $pay_for."<td>".$dai_stu[0]." Students</td>";
      }
      if ($dai_stu[1] != "0") {
        $pay_for = $pay_for."<td>".$dai_stu[1]." Non Students</td>";
      }
      if ($dai_it[0] != "0") {
        $pay_for = $pay_for."<td>".$dai_it[0]." x Item1</td>";
      }
      if ($dai_it[1] != "0") {
        $pay_for = $pay_for."<td>".$dai_it[1]." x Item2</td>";
      }
      if ($dai_it[2] != "0") {
        $pay_for = $pay_for."<td>".$dai_it[2]." x Item4</td>";
      }
      $pay_for = $pay_for."</tr>";
    }
    else if ($str == "1" and $i >= 6) {
      $x = $i-5;
      $pay_for = $pay_for."<tr><td>Workshop Day".$x."</td>";
      if ($dai_stu[0] != "0") {
        $pay_for = $pay_for."<td>".$dai_stu[0]." Students</td>";
      }
      if ($dai_stu[1] != "0") {
        $pay_for = $pay_for."<td>".$dai_stu[1]." Non Students</td>";
      }
      if ($dai_it[0] != "0") {
        $pay_for = $pay_for."<td>".$dai_it[0]." x Item1</td>";
      }
      if ($dai_it[1] != "0") {
        $pay_for = $pay_for."<td>".$dai_it[1]." x Item2</td>";
      }
      if ($dai_it[2] != "0") {
        $pay_for = $pay_for."<td>".$dai_it[2]." x Item4</td>";
      }
      $pay_for = $pay_for."</tr>";
    }
  }
  $pay_for = $pay_for."</table></div>";

  $pay = isset($_POST['pay'])?$_POST['pay']:'';
  if (!empty($pay) and isset($_POST['confirm'])) {
    $query = "select max(BuyID) as max from Buy";
    $result = $conn->query($query);
    if (empty($result)) {
      $buy_id = 0;
    }
    else {
      $row = $result->fetch_assoc();
      $max = $row["max"];
      $buy_id = $max+1;
    }
    $cur_date = date("Y-m-d");
    $query = "insert into buy (BuyID, PurchaseDate, Username, EntireAddons, EntireParticipants, DailyDays, DailyAddons, DailyParticipants, Total) values
     ($buy_id, '$cur_date', '$username', '$reg_conf4', '$reg_conf3', '$daily', '$reg_conf6', '$reg_conf5', $total)";
    $conn->query($query);
    header("Location: http://localhost/euromed/profile.php");
    exit();
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
      <h2>Confirm Registration</h2>
      <div id="person">
        <p>First Name:</p>
        <p>Last Name:</p>
        <p>Email:</p>
        <p>Country:</p>
        <p>Affiliation:</p>
      </div>
      <?php echo $person; ?>
      <h4>You're paying for the following:</h4>
      <?php echo $pay_for ?>

      <h4>Total Cost:</h4>
      <div class="program_include">
        <table id="tablestyle">
          <tr>
              <td>Registration Fees</td>
              <td><?php echo $fees ?> &euro;</td>
            </tr>
            <tr>
              <td>Extras</td>
              <td><?php echo $extras ?> &euro;</td>
            </tr>
            <tr>
              <td><b>Total</b></td>
              <td><?php echo $total ?> &euro;</td>
            </tr>
        </table>
      </div>

      <h4>Payment method:</h4>
      <form method="post" id="last_done">
        <div id="packages_info" class="choose_meth">
          <ul>
            <li class="pay_li">
              <input type="radio" name="pay" required="required"> Mastecard 
            </li>
            <li class="pay_li">
              <input type="radio" name="pay" required="required"> PayPal 
            </li>
            <li class="pay_li">
              <input type="radio" name="pay" required="required"> Visa 
            </li>
          </ul>
        </div>

        <div class="payicon">
          <img src="images/mastercard.jpg" width="28" height="28"></br>
          <img src="images/paypal.png" width="24" height="24"></br>
          <img src="images/visa.png" width="22" height="22"></br>
        </div>

        <h4>Are you sure you want to register?</h4>
        <a href="register.php" id="last_cancel">Cancel</a>
        <button type="submit" name="confirm">Continue</button>
      </form>

    </div>
  </div>
</body>