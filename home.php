<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
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


$id=$_SESSION['id'];

$depquery= $con->query("SELECT dep_id FROM users  where id = $id ");

$depid = NULL;

while($rows = $depquery->fetch_assoc() ){

$depid=$rows['dep_id'];

}

//$results = $con->query("SELECT name , description , instructor , hours FROM courses INNER JOIN departments on courses.dep_id = departments.id where courses.dep_id = $_SESSION['dep_id']");


//select all enrolled courses according to the department id
$results = $con->query("SELECT name , description , instructor , hours FROM courses  where dep_id = $depid ");


if($depid === NULL){
	header('Location: choosedepartment.php');
}


?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="css/stylesheet.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="shortcut icon" type="image/x-icon" href="css/icon.png" />
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Database 2019</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>


		<div class="content">
			<h2>Home Page</h2>
			<h3>Welcome , <?=$_SESSION['name']?> !<br><br> Here is a list of all your courses</h3>




			<table class="table table-bordered">
				<thead>
				<tr>
				<th>Course</th>
				<th>Description</th>
				<th>Instructor</th>
				<th>Hours</th>
                 </tr>
 </thead>
  <tbody>


          <?php
               while ($row = $results->fetch_assoc()) {
?>
                  <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['instructor']; ?></td>
                <td><?php echo  $row['hours']; ?></td>
                
            </tr>
    <?php
               }

            ?>

</tbody>
			</table>

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