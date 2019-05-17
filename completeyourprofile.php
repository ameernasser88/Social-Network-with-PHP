<?php

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'socialnetwork';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}





if (isset($_SESSION['registered'])) {


   header('Location: home.php');
  
}   




$id=$_SESSION['id'];





$results = $con->query("SELECT firstName , lastName , gender , profilePicture  FROM users  where id = $id ");

$fName=NULL;
$lName=NULL;
$gender = NULL;
$pp = NULL;

 while ($row = $results->fetch_assoc())
 {
 $fName =$row['firstName'];
 $lName = $row['lastName'];
 $gender = $row['gender'];
 $pp = $row['profilePicture'];

 }

$fName = strtolower($fName);
$lName = strtolower($lName);
$fName = ucwords($fName);
$lName = ucwords($lName);
$name = $fName." ".$lName; 






if($pp==NULL){

	$photo = $gender.".png";

   if ($stmt = $con->prepare('UPDATE users SET profilePicture = ? WHERE id = ?') ) {
	$stmt->bind_param('ss', $photo , $id);
	$stmt->execute();
}

}

else
{

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
  <title>Complete Your Profile</title>

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
width: 125px;
}
</style>



</head>
<body class="loggedin">
	<!-- <nav class="navtop">
			<div>
				<h1>The Social Network</h1>
				
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
        <a class="nav-link" href="home.php"><i class="fas fa-home"></i> <?=$name?><span class="sr-only">(current)</span></a>
      </li>
      
     




      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          
          
          
          <a class="dropdown-item" href="signout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>

  <form class="form-inline my-2 my-lg-0" method="POST" action="search.php">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn  my-2 my-sm-0" style="background-color: #00a1ff; border-color: white; color: white;" type="submit"><i class="fa fa-search"></i></button>
    </form>
    </ul>
   
  </div>
</nav>
		<div class="content" style="margin-top:2px; margin-bottom: 0;" >
			<h4>Welcome , <?=$name?> !</h4>

		</div>

		<div class="content" style=" margin-bottom: 25px;">
           <h3 ">Please complete your profile ! </h3>
		</div>




	<div class="content" style="margin: 0 auto;">


    <div class="container">

<form method="POST" action="submitprofile.php" enctype="multipart/form-data" >
  <div class="form-row">
    <div class="form-group col-md-6 col-xs-12 col-sm-12 ">
      <label for="nickname">Nickname</label>
      <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Nickname">
    </div>
    <div class="form-group col-md-6 col-xs-12 col-sm-12">
      <label for="phone">Phone Number</label>
      <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number">
    </div>
  </div>
   <div class="form-row ">
 	<div class="form-group col-md-12 col-xs-12 col-sm-12">
    <label for="about">About</label>
    <input type="text" class="form-control" name="about"  id="about" placeholder="Tell Us Something About Yourself !">
  </div>
  </div>
 
  <div class="form-row">
    <div class="form-group col-md-6 col-xs-12 col-sm-12">
      <label for="hometown">Hometown</label>
      <input type="text" class="form-control" id="hometown" name="hometown" placeholder="Hometown">
    </div>
    <div class="form-group col-md-6 col-xs-12 col-sm-12">
      <label for="maritalstatus">Marital Status</label>
      <select name="maritalstatus" id="maritalstatus" class="form-control">
        <option selected value="">Choose...</option>


        <option value="Single">Single</option>
        <option value="Engaged">Engaged</option>
        <option value="Married">Married</option>
      </select>
    </div>
    
  </div>



 <div class="form-row " style="margin-bottom: 2%;">
 	<div class="form-group col-md-12">
    <label for="profilepicture">Profile Picture</label>
    <input type="file" class="form-control" id = "profilepicture" name="image" >
    </div>
  </div>

<a href="home.php" target="_blank" style="float: left;">Skip For Now</a>
  <button type="submit" style="background-color: #00a1ff; border-color: #00a1ff; float: right;" name="continue" class="btn btn-primary">Continue</button>
</form>


<span>

<footer style=" display: table;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    margin-top:10%;">
	
  <p>2019  ©</p>
  
</footer>

</span>
</div>
</div>






</body>
</html>







<?php

$con->close();

?>