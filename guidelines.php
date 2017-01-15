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
		Euromed2016 | Submission Guidelines
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
          	<a href="travel_transport.php">Travel and Transport </a>
          	<a href="#">About Cyprus</a>
        	</div>
      	</li>
      	<li class="dropdown">
      		<a href="#" class="dropbtn_active">CALL FOR PAPERS</a>
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
    <div id="mainguidelines">
      <h2 style="color: #330000; font-size: 22;">Submission Guidelines</h2>
      <p>Submissions for the joint event are <strong>completely electronic</strong>, and both the paper and all supplementary material must be submitted through the online submission website. The EuroMed2016 Proceeding will be published by Springer Verlag in the Lecture Notes in Computer Science (LNCS) series at:
      <a href="http://www.springer.com/gp/computer-science/lncs" target="_blank">Springer</a></p> 
      <h2>Evaluation of submissions</h2>
      <p>The Symposium <strong>accepts only original, unpublished work written in English</strong>. We are soliciting three types of contributions: The <strong>FULL (Research)</strong>, <strong>PROJECT (on-going projects)</strong> and <strong>SHORT Papers (Posters)</strong>. The papers will be evaluated based on their ... . However, the 15 best submitted papers will be published on a special issue of the International Journal Heritage in the Digital Era, published by <a href="https://uk.sagepub.com/en-gb/eur/home" target="_blank">SAGE Publisher, UK</a>. Please note that it is imperative not to delay the submission until the last minute. From our experience the submission server will be heavily loaded in the very last days.</p>
    </div>
    <div id="formatting">
      <p><br></p>
      <h2>Formatting</h2>
      <p>For your convenience, we have summarized in the <a target="_blank" href="http://www.euromed2016.eu/index.php/download_file/view/90/190">Author Guidelines</a> document how a proceeding paper should be structured, how elements (headings, figures, references) should be formatted using our predefined styles, etc. Also for short papers here is <a target="_blank" href="http://www.euromed2016.eu/index.php/download_file/view/108/190">Poster Guidelines</a></p>
      <p>We also give some insight on how your paper will be <strong>typeset at Springer</strong> (guidelines including the copyright form):</p> 
      <p><br></p>
      <ul class="no_bullet">
        <li class="msWord" id="templates"><a href="http://www.euromed2016.eu/index.php/download_file/view/131/190">Template in MS Word Format</a></li>
        <li class="Latex" id="templates"><a href="http://www.euromed2016.eu/index.php/download_file/view/132/190">Template in Latex Format</a></li>
      </ul>
      <div>
        <input type="checkbox" class="read-more-state" id="post1" />
        <p class="read-more-wrap"><strong>Copyright form / Permissions: </strong>Each contribution must be accompanied by a Springer copyright form,<span class="read-more-target"> a so-called <a target="_blank" href="http://www.euromed2016.eu/index.php/download_file/view/92/190">'Consent to Publish' form.</a> form. Modified forms are not acceptable. Authors will be asked to transfer the copyright of the paper to the Springer. This will ensure the widest possible protection and dissemination of information under copyright laws. One author may sign on behalf of all of the authors of a particular paper. In this case, the author signs for and accepts responsibility for releasing the material on behalf of any and all co-authors. Authors wishing to include figures, tables, or text passages that have already been published elsewhere are required to obtain permission from the copyright owner(s) for both the print and online format before their paper is submitted to Springer.
        </span></p>
        <label for="post1" class="read-more-trigger"></label>
      </div>
      <p><br></p>
      <div>
        <table id="tablestyle">
          <tr>
            <th>Paper Type</th>
            <th>Pages (in total)</th>
            <th>Content Type</th>
          </tr>
          <tr>
            <td>Full Research Papers</td>
            <td>12</td>
            <td>new innovative results / full-length oral presentation</td>
          </tr>
          <tr>
            <td>Project Papers</td>
            <td>10</td>
            <td>not innovative / short oral presentation</td>
          </tr>
          <tr>
            <td>Short Papers</td>
            <td>less than 8</td>
            <td>works-in-progress / short oral presentation / posters</td>
          </tr>
        </table>
      </div>
      <p><br></p>
      <p><strong>Note:</strong> Space will be available for "Exhibition and Live Showcases". If you have a system you wish included in the exhibition or showcase area, please contact the organizers (email: <a href="mailto:chairman@euromed2016.eu">chairman@euromed2016.eu</a>) and see Important dates.</p>
      <p><br></p>
      <a href="papersubmission.php" class="shortcutbutton">Submit your paper</a>
      <p><br></p>
    </div>
  </div>
</body>
</html>