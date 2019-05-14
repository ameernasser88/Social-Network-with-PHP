<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: register.html');
	exit();
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'dbproject1';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM users WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('s', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();






$id=$_SESSION['id'];

$depquery= $con->query("SELECT dep_id,reg_date FROM users  where id = $id ");

$depid = NULL;
$regdate=NULL;

while($rows = $depquery->fetch_assoc() ){

$depid=$rows['dep_id'];
$regdate=$rows['reg_date'];

}
if($depid === NULL){
	header('Location: choosedepartment.php');
}

$results = $con->query("SELECT * FROM departments  where id = $depid ");


$depname=NULL;
$depdesc=NULL;

while($rows = $results->fetch_assoc() ){

$depname=$rows['name'];
$depdesc=$rows['description'];

}







?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="css/stylesheet.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="shortcut icon" type="image/x-icon" href="css/icon.png" />
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Database 2019</h1>
				<a href="home.php"><i class="fas fa-home"></i>Home</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<h2>Account Info:</h2>
				<table class="table">
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>

					<tr>
						<td>Department:</td>
						<td><?=$depname?></td>
					</tr>

					<tr>
						<td>Description:</td>
						<td><?=$depdesc?></td>
					</tr>

					<tr>
						<td>Joined on:</td>
						<td><?=$regdate?></td>
					</tr>



				</table>





			</div>
		</div>


		<footer style=" display: table;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    margin-top:5%;">
	
  <p>Ameer Nasser<br>Noha Magdy<br>2019  ©</p>
  
</footer>
	</body>
</html>

<?php

$con->close();

?>