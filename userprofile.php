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


$friendID = $_GET['id'];



$results = $con->query("SELECT firstName , lastName  FROM users  where id = $friendID ");

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

$result2 = $con->query("SELECT nickName , phone, profilePicture , homeTown , maritalStatus FROM users  where id = $friendID  ");

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
  <title><?=$name?></title>
  <link href="css/stylesheet.css" rel="stylesheet" type="text/css">
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>








<style>
	
	.avatar-pic {
width: 150px;
height: 150px;
}
</style>








</head>
<body class="loggedin">
	<!-- <nav class="navtop">
			<div>
				<h1>The Social Network</h1>
				<a href="editprofile.php"><i class="fas fa-home"></i>Edit Profile</a>
				<a href="signout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav> -->



    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #00a1ff;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
   <h3> <a class="navbar-brand" href="/socialnetwork">The Social Network</a> </h3>
    <ul class="navbar-nav  ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#"><i class="fas fa-home"></i> <?=$name?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Discover</a>
      </li>
     




      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="editprofile.php"><i class="fas fa-cog"></i> Settings</a>
          
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="signout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>

 <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn  my-2 my-sm-0" style="background-color: #00a1ff; border-color: white; color: white;" type="submit"><i class="fa fa-search"></i></button>
    </form>
    </ul>
   
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




<span>

<footer style=" display: table;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    margin-top:20%;">
  
  <p>2019  ©</p>
  
</footer>

</span>


</div>



</body>
</html>







<?php

$con->close();

?>