<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'socialnetwork';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}



  $userId = $_SESSION['id']; 

$nickname = NULL;
$phone = NULL;
$hometown = NULL;
$maritalstatus= NULL;
$about= NULL;

$profilepicture = NULL;

$msg = "";

if(isset($_POST['nickname'])){$nickname =$_POST['nickname'];}
if(isset($_POST['phone'])){$phone =$_POST['phone'];}
if(isset($_POST['hometown'])){$hometown =$_POST['hometown'];}
if(isset($_POST['about'])){$about =$_POST['about'];}

if(isset($_POST['maritalstatus'])  && $_POST['maritalstatus']== ""   ){$maritalstatus =NULL;}
if(  $_POST['maritalstatus']!= ""){$maritalstatus =$_POST['maritalstatus'];}

$sql = $con->query("UPDATE users SET nickName=$nickname , phone=$phone , homeTown=$hometown , maritalStatus=$maritalstatus , about=$about  WHERE  id=8");
  

if (isset($_POST['image'])) {

    // Get image name
	$image = $_FILES['image']['name'];


  	// image file directory
  	$target = "profilepictures/".basename($image);

    $sql = "UPDATE users SET profilepicture =$image  WHERE    id=$userId";
     $con->query($sql);


  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }






header('Location: home.php');


  //echo $userId;

// echo $_POST['nickname'];
// echo $_POST['phone'];
// echo $_POST['hometown'];
// echo $_POST['about'];
// echo $_POST['maritalstatus'];

$con->close();


?>