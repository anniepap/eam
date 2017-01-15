<?php
	require_once "login.php";
	$conn = new mysqli ($hn, $un, $pw, $db);
	if ($conn->connect_error) die ($conn->connect_error);
	if(!isset($_SESSION)) {
	session_start();
	}

	$username = $_SESSION['username'];

	
  $topic = isset($_POST['topic'])?$_POST['topic']:'';
  $type = isset($_POST['formCategory'])?$_POST['formCategory']:'';
  $authorName = isset($_POST['authname'])?$_POST['authname']:'';
  $authorEmail = isset($_POST['authemail'])?$_POST['authemail']:'';
  $authorAffil = isset($_POST['authaffill'])?$_POST['authaffill']:'';
  $abstract = isset($_POST['abstract'])?$_POST['abstract']:'';
  $KW1 = isset($_POST['KW1'])?$_POST['KW1']:'';
	$KW2 = isset($_POST['KW2'])?$_POST['KW2']:'';
$KW3 = isset($_POST['KW3'])?$_POST['KW3']:'';
$KW4 = isset($_POST['KW4'])?$_POST['KW4']:'';
$KW5 = isset($_POST['KW5'])?$_POST['KW5']:'';
$KW6 = isset($_POST['KW6'])?$_POST['KW6']:'';

$file1 = isset($_POST['attachfile'])?$_POST['attachfile']:'';
$file2 = isset($_FILES['attachfile']['name'])?$_FILES['attachfile']['name']:'';


  echo $topic."<br>";
  echo $type."<br>";
  echo $authorName."<br>";
  echo $authorEmail."<br>";
  echo $authorAffil."<br>";
  echo $abstract."<br>";
  echo $KW1."<br>";
echo $KW2."<br>";
echo $KW3."<br>";
echo $KW4."<br>";
echo $KW5."<br>";
echo $KW6."<br>";

echo $file1." 1<br>";
echo $file2." 2<br>";

 $targetfolder = "testupload/";

 $targetfolder = $targetfolder . basename( $_FILES['attachfile']['name']) ;

if(move_uploaded_file($_FILES['attachfile']['tmp_name'], $targetfolder))

 {

 echo "The file ". basename( $_FILES['attachfile']['name']). " is uploaded";

 }

 else {

 echo "Problem uploading file";

 }



/*
  if (isset($_POST['papersub'])) {
  	echo "ok<br>";
    if (!isset($_SESSION['loggedin'])) {
      echo "<script> alert('Please sign in on make an account to complete your registration.'); </script>";
    }
    else if (isset($_FILES['attachfile']['size'])) {
      echo "ok<br>";

      $file = $_FILES['attachfile']['name'];
      echo "ok<br>";
      $tmpName  = $_FILES['attachfile']['tmp_name'];
      echo "ok<br>";
      $fileSize = $_FILES['attachfile']['size'];
      echo "ok<br>";
      $fileType = $_FILES['attachfile']['type'];
      echo "ok<br>";

      $fp = fopen($tmpName, 'r');
      $content = fread($fp, filesize($tmpName));
      $content = addslashes($content);
      fclose($fp);

      if(!get_magic_quotes_gpc()) {
        $file = addslashes($file);
      }

      $query = "select max(PaperID) as max from papers";
      $result = $conn->query($query);
      if (empty($result)) {
        $paper_id = 0;
      }
      else {
        $row = $result->fetch_assoc();
        $max = $row["max"];
        $paper_id = $max+1;
      }
      $query = "insert into papers (PaperID, Username, Topic, Type, Abstract, Keyword, File) values
        ($paper_id, '$username', '$topic', '$type', '$daily', '$keywords', '$content')";
      $conn->query($query);
      echo $conn->error;
      header("Location: http://localhost/euromed/profile.php");
      exit();
    }
  }
*/
  $conn->close();

?>