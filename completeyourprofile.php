<?php

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
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
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="shortcut icon" type="image/x-icon" href="css/icon.png" />

<style>
	
	.avatar-pic {
width: 125px;
}
</style>



</head>
<body class="loggedin">
	<nav class="navtop">
			<div>
				<h1>The Social Network</h1>
				
				<a href="signout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>

		<div class="content" style="margin-top:2px; margin-bottom: 0;" >
			<h4>Welcome , <?=$name?> !</h4>

		</div>

		<div class="content" style=" margin-bottom: 25px;">
           <h3 ">Please complete your profile ! </h3>
		</div>

	<div class="content" style="margin: 0 auto;">




<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nickname">Nickname</label>
      <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Nickname">
    </div>
    <div class="form-group col-md-6">
      <label for="phone">Phone Number</label>
      <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number">
    </div>
  </div>
  <div class="form-group">
    <label for="about">About</label>
    <input type="text" class="form-control" name="about"  id="about" placeholder="Tell Us Something About Yourself !">
  </div>
 
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="hometown">Hometown</label>
      <input type="text" class="form-control" id="hometown" name="hometown" placeholder="Hometown">
    </div>
    <div class="form-group col-md-6">
      <label for="maritalstatus">Marital Status</label>
      <select name="maritalstatus" id="maritalstatus" class="form-control">
        <option selected value="">Choose...</option>


        <option value="Single">Single</option>
        <option value="Engaged">Engaged</option>
        <option value="Married">Married</option>
      </select>
    </div>
    
  </div>



 <div class="form-group">
    <label for="profilepicture">Profile Picture</label>
    <input type="file" class="form-control" id = "profilepicture" name="profilepicture" >
  </div>



  
 
  <button type="submit" style="background-color: #00a1ff; border-color: #00a1ff; float: right;" class="btn btn-primary">Continue</button>
</form>


<span>

<footer style=" display: table;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    margin-top:6%;">
	
  <p>2019  ©</p>
  
</footer>

</span>
</div>



</body>
</html>







<?php

$con->close();

?>