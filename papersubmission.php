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

  $topic = isset($_POST['topic'])?$_POST['topic']:'';
  $authorName = isset($_POST['authname'])?$_POST['authname']:'';
  $authorEmail = isset($_POST['authemail'])?$_POST['authemail']:'';
  $authorAffil = isset($_POST['authaffil'])?$_POST['authaffill']:'';
  $type = isset($_POST['type'])?$_POST['type']:'';
  $abstract = isset($_POST['abstract'])?$_POST['abstract']:'';
  $keywords = isset($_POST['keywords'])?$_POST['keywords']:'';
  $file = isset($_POST['file'])?$_POST['file']:'';


  //if (!empty($Topic) and !empty($Type) and !empty($Abstract) and !empty($Keywords) and !empty($File) and 
  //    !empty($AuthorName) and !empty($AuthorEmail) and !empty($AuthorAfill) 
  $conn->close();
?>
<html>
<head>
<script language="javascript">
  var counter = 1;
  var limit = 6;
  function addInput(divName){
    if (counter == limit)  {
      alert("You have reached the limit of adding " + counter + " inputs");
    }
    else {
      var newdiv = document.createElement('div');
      newdiv.innerHTML = " <br><input type='text' class='onethird' name='adding'>" + " <input type='email' class='onethird' name='adding'>" + " <input type='text' class='onethird' name='adding'>";
      document.getElementById(divName).appendChild(newdiv);
      counter++;
    }
  }
</script>
  <title>
    Euromed2016 | Paper Submission
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
      <h2>Paper Submission</h2>
      <div id="signup" class="wide">
        <p>All fields are required.</p>
        <form action="papersubmission.php" method="post">

          <?php if ($error != ''): ?>
          <?php echo $error; ?>
          <?php endif; ?>

          Topic:<br>
          <input type="text" class="narrow" value="<?php $topic = isset($_POST['topic'])?$_POST['topic']:''; echo htmlspecialchars($topic);?>" name="topic" required="required">
          <br>
          Category:<br>
          <select name="formCategory" value="<?php $type = isset($_POST['type'])?$_POST['type']:''; echo htmlspecialchars($type);?>" required="required" style="width: 450px; height: 25px; border: none;">
            <option value=""></option>
            <option value="FULL">Full Research Paper</option>
            <option value="PROJECT">Project Paper</option>
            <option value="SHORT">Short Paper</option>
            <option value="W1">2nd International Workshop on ICT for the Preservation...</option>
            <option value="W2">3rd International Workshop on 3D Research Challenges...</option>
            <option value="W3">1st International Workshop on Virtual Reality...</option>
            <option value="W4">Information and Communication Technologies...</option>
            <option value="W5">Re-Thinking Management and Valorization of Middle East Cultural Heritage...</option>
          </select> <br>
          <div id="moreAuthors">
            Author:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
            Email:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            Affiliation:<br>
            <input type="text" class="onethird" value="<?php $authname = isset($_POST['authname'])?$_POST['authname']:''; echo htmlspecialchars($authname);?>" name="authname" required="required">
            <input type="email" class="onethird" value="<?php $authemail = isset($_POST['authemail'])?$_POST['authemail']:''; echo htmlspecialchars($authemail);?>" name="authemail" required="required">
            <input type="text" class="onethird" value="<?php $authaffill = isset($_POST['authaffill'])?$_POST['authaffill']:''; echo htmlspecialchars($authaffill);?>" name="authaffill" required="required">
            &emsp;
            <input type="button" class="addbutton" value="" onClick="addInput('moreAuthors');">
          </div> 
          Abstract: <br>
          <textarea maxlength="500" size="500"></textarea><br>
          Keywords: <br>
          <input type="checkbox" name="KW" value="K1"> Keyword1&emsp;&emsp;&emsp;&emsp;
          <input type="checkbox" name="KW" value="K2"> Keyword2&emsp;&emsp;&emsp;&emsp;
          <input type="checkbox" name="KW" value="K3"> Keyword3&emsp;&emsp;&emsp;&emsp;<br>
          <input type="checkbox" name="KW" value="K4"> Keyword4&emsp;&emsp;&emsp;&emsp;
          <input type="checkbox" name="KW" value="K5"> Keyword5&emsp;&emsp;&emsp;&emsp;
          <input type="checkbox" name="KW" value="K6"> Keyword6&emsp;&emsp;&emsp;&emsp;<br><br>
          Upload File: <br>
          <td>
          <input type="hidden" name="MAX_FILE_SIZE" value="15728640">
          <input type="file" name="attachfile" size="48" accept=".pdf">
          <input type="submit" name="attach" value="submitfile" style="display: none;">
    
          (max.&nbsp;15
          <small>&nbsp;M</small>
          )
          </td>                    
        </form>
      </div>
    </div>
  </div>
</body>