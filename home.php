<?php

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])    ) {
	header('Location: index.php');
	exit();
}




$_SESSION['registered']=TRUE;

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'socialnetwork';




$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$id=$_SESSION['id'];

$results = $con->query("SELECT firstName , lastName  FROM users  where id = $id ");

$fName=NULL;
$lName=NULL;

 while ($row = $results->fetch_assoc())
 {
 $fName =$row['firstName'];
 $lName = $row['lastName'];
 }

$fName = strtolower($fName);
$lName = strtolower($lName);
$fName = ucwords($fName);
$lName = ucwords($lName);

$name = $fName." ".$lName; 

$nickname = NULL;

$profilepicture = NULL;

$phone = NULL;

$homeTown=NULL;

$maritalStatus = NULL;

$result2 = $con->query("SELECT nickName , phone, profilePicture , homeTown , maritalStatus FROM users  where id = $id ");

 while ($row = $result2->fetch_assoc())
 {
 $nickname = $row['nickName'];
$profilepicture = $row['profilePicture'];

$phone =  $row['phone'];;

$homeTown= $row['homeTown'];;

$maritalStatus =  $row['maritalStatus'];;
 }



if( $nickname != NULL )
{
 $name =ucwords($nickname);
}






// $stmt = $con->prepare('SELECT password, email FROM users WHERE id = ?');
// // In this case we can use the account ID to get the account info.
// $stmt->bind_param('s', $_SESSION['id']);
// $stmt->execute();
// $stmt->bind_result($password, $email);
// $stmt->fetch();
// $stmt->close();

// $id = $_SESSION['id'];






?>


<!DOCTYPE html>
<html>
<head>
  <title>Profile Page</title>
  <link href="css/stylesheet.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="shortcut icon" type="image/x-icon" href="css/icon.png" />

<style>
	
	.avatar-pic {
width: 150px;
}
</style>



</head>
<body class="loggedin">
	<nav class="navtop">
			<div>
				<h1>The Social Network</h1>
				<a href="editprofile.php"><i class="fas fa-home"></i>Edit Profile</a>
				<a href="signout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>

		<div class="content" style="margin-top:2%; margin-bottom: 0;" >
			<!-- <h4>Welcome , <?=$name?> !</h4> -->






<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10">
            <h1><?=$name?></h1></div>
        <div class="col-sm-2">
            <a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive avatar-pic" src="profilepictures/<?=$profilepicture?>"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <!--left col-->

            <ul class="list-group">
                <li class="list-group-item text-muted">Info</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Hometown   </strong></span><?=$homeTown?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Phone   </strong></span> <?=$phone?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Status   </strong></span> <?=$maritalStatus?></li>

            </ul>

          

           

            

        </div>





		</div>

		

	<div class="content" style="margin: 0 auto;">







</div>



</body>
</html>







<?php

$con->close();

?>