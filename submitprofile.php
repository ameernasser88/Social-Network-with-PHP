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



$userId = $_SESSION['id']; 

$nickname = NULL;
$phone = NULL;
$hometown = NULL;
$maritalstatus= NULL;
$about= NULL;

$profilepicture = NULL;

$msg = "";

if(  (isset($_POST['nickname']) )&&($_POST['nickname']!="")){$nickname =$_POST['nickname'];}

if(( isset($_POST['phone']) )  &&($_POST['phone']!="") ){$phone =$_POST['phone'];}

if((isset($_POST['hometown'])) &&($_POST['hometown']!="") ){$hometown =$_POST['hometown'];}

if((isset($_POST['about'])) &&($_POST['about']!="") ){$about =$_POST['about'];}


$ppquery = $con->query("SELECT profilePicture  FROM users  where id = $userId ");

$pp = NULL;

 while ($row = $ppquery->fetch_assoc())
 {
    $pp = $row['profilePicture'];
 }




if(isset($_POST['maritalstatus'])  && $_POST['maritalstatus']== ""   ){$maritalstatus =NULL;}
if(  $_POST['maritalstatus']!= ""){$maritalstatus =$_POST['maritalstatus'];}

//$sql = ("UPDATE users SET nickName=$nickname , phone=$phone , homeTown=$hometown , maritalStatus=$maritalstatus , about=$about  WHERE  id=$userId");
  
//$con->query($sql);
//////////////////////////////////////////////////////////
if ($stmt = $con->prepare('UPDATE users SET nickName = ?, phone = ?, homeTown = ? , maritalStatus = ? , about = ? WHERE id = ?') ) {
	$stmt->bind_param('ssssss', $nickname, $phone, $hometown, $maritalstatus, $about , $userId);
	$stmt->execute();
}
/////////////////////////////////////////////////////






if (isset($_POST['continue']) ) {



// if the user doesnt upload a photo , if he/she already has one it will remain unchanged or his/her profile picture will be set according to gender field
if (

     (isset($_SESSION['editing']) && ( ($_FILES['image']['name']==NULL  || $_FILES['image']['name']=="" )) )

                                                   ||
            
     ( ($pp=="male.png" || $pp=="female.png" )  && ($_FILES['image']['name']==NULL  || $_FILES['image']['name']=="" ) ) ) 


               {

               }



	else{

    // Get image name
	$image = $_FILES['image']['name'];


	if ( ($image=="" || $image==NULL) && !isset($_SESSION['editing']) ) {
		$image = NULL;
	}



if($image!=NULL){
	$image = $userId.$image;
}


  	// image file directory
  	$target = "profilepictures/".basename($image);

   // $sql = "UPDATE users SET profilepicture =$image  WHERE    id=$userId";
    // $con->query($sql);


   if ($stmt = $con->prepare('UPDATE users SET profilePicture = ? WHERE id = ?') ) {
	$stmt->bind_param('ss', $image , $userId);
	$stmt->execute();
}



  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}



}



  }






header('Location: home.php');


  //echo $userId;

// echo $_POST['nickname'];
// echo $_POST['phone'];
// echo $_POST['hometown'];
// echo $_POST['about'];
// echo $_POST['maritalstatus'];

$con->close();


?>