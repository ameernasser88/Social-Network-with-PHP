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


// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}



    $userId = $_SESSION['id']; 
    $authorId = $_POST['authorId'];
    $caption = $_POST['caption'];
    $state = $_POST['state'];
    if($_POST['image']==''){
        $image = NULL;
    }
    else{
        $image = $_POST['image'];
    }


    $sql = "INSERT INTO posts (authorId, caption, state, image)
        VALUES ('$authorId','$caption','$state','$image')";
        if(mysqli_query($con, $sql)){
            echo "Records inserted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }
    // echo($caption);
    //     $sql = "INSERT INTO users (authorId, caption, state, image)
    //     VALUES (?,?,?,?,?)"
    //     $stmt = mysqli_prepare($sql);
    //     $stmt->bind_param("sssss", $_POST['userna'], $_POST['email'], $_POST['password']);
    //     $stmt->execute();

    header('Location: home.php');
?>