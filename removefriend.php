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


if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}



$userID = $_SESSION['id']; 
$friendID = $_GET['id'];




if ($stmt = $con->prepare('DELETE FROM friends
WHERE userA = ? AND
userB = ?') ) {
	

	$stmt->bind_param('ii', $userID ,$friendID);
	$stmt->execute();
}



if ($stmt = $con->prepare('DELETE FROM friends
WHERE userA = ? AND
userB = ?
') ) {
	

	$stmt->bind_param('ii', $friendID, $userID);
	$stmt->execute();
}



//header("Location: userprofile.php?id=".$friendID);
header('Location: ' . $_SERVER['HTTP_REFERER']);





?>



