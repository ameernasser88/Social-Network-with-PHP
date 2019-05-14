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

$results = $con->query("SELECT nickName FROM users  where id = $id ");

$nickname=NULL;


 while ($row = $results->fetch_assoc())
 {
 $nickname =$row['nickName'];
 
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
			<h4>Welcome , <?=$nickname?> !</h4>

		</div>

		

	<div class="content" style="margin: 0 auto;">







</div>



</body>
</html>







<?php

$con->close();

?>