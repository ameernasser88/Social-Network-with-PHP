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

$birthdate = NULL;

$result2 = $con->query("SELECT nickName , phone, profilePicture , homeTown , maritalStatus , birthdate FROM users  where id = $id ");

 while ($row = $result2->fetch_assoc())
 {
 $nickname = $row['nickName'];
$profilepicture = $row['profilePicture'];

$phone =  $row['phone'];

$homeTown= $row['homeTown'];

$maritalStatus =  $row['maritalStatus'];

$birthdate = $row['birthdate'];

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


<!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="style\bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="style\icon.css">
		<link rel="stylesheet" href="style\loader.css">
		<link rel="stylesheet" href="style\idangerous.swiper.css">
		<link rel="stylesheet" href="style\stylesheet.css">
    <!--Google Webfont-->
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700' rel='stylesheet' type='text/css'>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>





<style>
	
	.avatar-pic {
width: 70%;
height: 70%;
display:inline;
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
        <a class="nav-link" href="discover.php">Discover</a>
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

 <form class="form-inline my-2 my-lg-0" method="POST" action="search.php">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn  my-2 my-sm-0" style="background-color: #00a1ff; border-color: white; color: white;" type="submit"><i class="fa fa-search"></i></button>
    </form>
    </ul>
   
  </div>
</nav>








<div class="content" style="margin-top:2%; margin-bottom: 0;" >

<div class="container bootstrap snippet">
  
    <div class="row">
        <div class="col-sm-10">
        
    </div>
    <div class="row">
    <div class="col-xs-12 col-md-4 left-feild">
					<div class="be-user-block style-3">
          <h1 class="text-center"><?=$name?></h1></div>
						<div class="be-user-detail">
            <div class="profilePicture">
               <a href="#" class="pull-left text-center"><img title="profile image" class="img-circle img-responsive avatar-pic" src="profilepictures/<?=$profilepicture?>" style="box-shadow:0 2px 4px rgba(0,0,0,0.5);"></a>
            </div>
							<a class="btn btn-primary buttons" id="followbtn" style="margin:7% 0px; color:white;"><i class="fa fa-plus light"></i>Follow</a>
							<div class="btn btn-danger" id="messagebtn" style="margin:7% 0px;">
								<i class="fa fa-envelope-o"></i>message
								<div class="message-popup">
									<div class="message-popup-inner container"> 
										<div class="row">
											<div class="col-xs-12 col-sm-8 col-sm-offset-2">
												<i class="fa fa-times close-button"></i>
												<h5 class="large-popup-title">Send Message to <?=$name?></h5>
												<div class="form-group">
													<textarea class="form-input" required="" placeholder="Your text"></textarea>
												</div>
												<a class="btn btn-right color-1 size-1 hover-1">send message</a>	
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="be-text-tags style-2">
								<a href="page1.html">UI/UX</a>,
								<a href="page1.html">Web Design</a>,
								<a href="page1.html">Art Direction</a>
							</div>
							<div class="be-user-social">							
								<a class="social-btn color-1" href="page1.html"><i class="fa fa-facebook"></i></a>
								<a class="social-btn color-2" href="page1.html"><i class="fa fa-twitter"></i></a>
								<a class="social-btn color-3" href="page1.html"><i class="fa fa-google-plus"></i></a>
								<a class="social-btn color-4" href="page1.html"><i class="fa fa-pinterest-p"></i></a>
								<a class="social-btn color-5" href="page1.html"><i class="fa fa-instagram"></i></a>
								<a class="social-btn color-6" href="page1.html"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="be-user-statistic" style="margin-left:auto; margin-right:auto; box-shadow:0 2px 4px rgba(0,0,0,0.5); color:blue">
							<div class="stat-row clearfix"><i class="stat-icon fas fa-home"></i><strong>Hometown</strong><span class="stat-counter"><?=$homeTown?></span></div>
							<div class="stat-row clearfix"><i class="stat-icon fas fa-heart"></i><strong>Status</strong><span class="stat-counter"><?=$maritalStatus?></span></div>
							<div class="stat-row clearfix"><i class="stat-icon fas fa-phone"></i><strong>Phone</strong><span class="stat-counter"><?=$phone?></span></div>
							<div class="stat-row clearfix"><i class="stat-icon fas fa-birthday-cake"></i><strong>Birthdate</strong><span class="stat-counter"><?=$birthdate?></span></div>
						</div>
					
					<div class="be-desc-block">
						<div class="be-desc-author">
							<div class="be-desc-label text-center">About Me</div>
							<div class="be-desc-text">
								Nam sit amet massa commodo, tristique metus at, consequat turpis. In vulputate justo at auctor mollis. Aliquam non sagittis tortor. Duis tristique suscipit risus, quis facilisis nisl congue vitae. Nunc varius pellentesque scelerisque. Etiam quis massa vitae lectus placerat ullamcorper pellentesque vel nisl.
							</div>
						</div>
						<div class="be-desc-author">
							<div class="be-desc-label text-center">My Values</div>
							<div class="be-desc-text">
								Sed dignissim scelerisque pretium. Vestibulum vel lacus laoreet nunc fermentum maximus. Proin id sodales sem, at consectetur urna. Proin vestibulum, erat a hendrerit sodales, nulla libero ornare dolor.
							</div>
						</div>
						<div class="be-desc-author">
							<div class="be-desc-label text-center">My Skills</div>
							<div class="be-desc-text">
								Praesent pharetra eget ante nec sodales. Sed et orci sit amet justo lobortis luctus. Curabitur sit amet congue purus. Sed arcu lectus, suscipit in finibus id, consequat sagittis arcu.
							</div>
						</div>
					</div>										
				</div>

		</div>



	<div class="content" style="margin: 0 auto;">




<span>

<footer style=" display: table;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    margin-top:20%;
    background-color:#f3f4f7">
  
  <p>2019  ©</p>
  
</footer>

</span>


</div>

<script src="script\jquery-2.1.4.min.js"></script>
	<script src="script\bootstrap.min.js"></script>		
	<script src="script\idangerous.swiper.min.js"></script>
	<script src="script\isotope.pkgd.min.js"></script>	
	<script src="script\jquery.viewportchecker.min.js"></script>	
	<script src="script\global.js"></script>

</body>
</html>







<?php

$con->close();

?>