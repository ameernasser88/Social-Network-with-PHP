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


if($friendID==$id){
  header('Location: home.php');
}



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



$result3 = $con->query("SELECT firstName , lastName , nickName  FROM users  where id = $id ");


 $mynickname = NULL;
$myfname =NULL;
$mylname =NULL;


 while ($row = $result3->fetch_assoc())
 {
 $mynickname = $row['nickName'];
$myfname =$row['firstName'];
$mylname =$row['lastName'];


$myfname = strtolower($myfname);
$mylname = strtolower($mylname);
$myfname = ucwords($myfname);
$mylname = ucwords($mylname);

$myname = $myfname." ".$mylname; 

 }



if( $mynickname != NULL )
{
 $myname =ucwords($mynickname);
}





////////// FRIENDSHIP STATUS //////////

 $fStatus = NULL ;
 $statusA = NULL;
 $statusB = NULL;

/* 

fStatus is a variable that will hold one of 4 values 

       0 means that the logged in user is not friends with the displayed user

       1 means that the displayed user has sent the logged in user a friend request and waiting for approval

       2 means that the logged in user has sent the displayed user a friend request and waiting for approval

       3 means that the 2 users are friends

       


*/

   $userASQL = $con->query("SELECT status FROM friends  WHERE userA = $id AND userB = $friendID ");

if (mysqli_num_rows($userASQL)==0) { $fStatus = 0;}


   $userBSQL = $con->query("SELECT status FROM friends  WHERE userA = $friendID AND userB = $id ");

 if (mysqli_num_rows($userBSQL)==0) { $fStatus = 0;}  



while ($row = $userASQL->fetch_assoc())
 {
     $statusA = $row['status'];
 }

 while ($row = $userBSQL->fetch_assoc())
 {
     $statusB = $row['status'];
 }


// case 1 
if( $statusA == 0 && $statusB == 1  )
{
  $fStatus = 1;
}

// case 2
else if ( $statusA == 1 && $statusB == 0)
{
  $fStatus = 2;
}

// case 3
else if ( $statusA == 1 && $statusB == 1) {

  $fStatus = 3;
}



$friendRequests = $con->query("SELECT id , firstName , lastName , nickName , profilePicture FROM users WHERE id =  ANY (SELECT userB FROM friends WHERE userA = $id AND status = 0 )  ORDER BY firstName"); 


$requestCount = mysqli_num_rows($friendRequests);


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
        <a class="nav-link" href="home.php"><i class="fas fa-home"></i> <?=$myname?><span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-bell"></i>  Notifications
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="friendrequests.php"><i class="fas fa-users"></i> <?=$requestCount?> Friend Request(s)</a>

        </div>
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
			<!-- <h4>Welcome , <?=$name?> !</h4> -->

      <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="box-shadow:0 2px 4px rgba(0,0,0,.4);">
                    <div class="card-body">
                         <div>
                            <img class="img-circle img-responsive img-fluid" src="profilepictures/<?=$profilepicture?>" style="border-radius:50%">
                        </div>
                        <div style="margin:5px auto; text-align:center; width:100%;">
                        <?php 
                          if($fStatus==0) {?>
                                      <form method="POST" action="addfriend.php?id=<?=$friendID?>"  >
                                      <button   class="btn btn-sm btn-primary " style=" margin-top: 5%; width: 150px;   background-color: #00a1ff; border-color: #00a1ff; "><strong>Add Friend</strong></button>
                                      </form>

                          <?php 
                          }
                          ?>




                          <?php 

                          if($fStatus==1){ ?>
                                      <form method="POST" action="acceptfriend.php?id=<?=$friendID?>"  >
                                      <button   class="btn btn-sm btn-success " style=" margin-top: 5%; width: 150px; background-color: #64dd17; border-color: #64dd17;  "> <strong>Accept Request</strong></button>
                                      </form>
                                      <form method="POST" action="removefriend.php?id=<?=$friendID?>"  >
                                      <button   class="btn btn-sm btn-danger " style=" margin-top: 5%; width: 150px;  "> <strong>Decline Request</strong></button>
                                      </form>

                          <?php 
                          }
                          ?>





                          <?php 

                          if($fStatus==2) {?>
                                      <form method="POST" action="removefriend.php?id=<?=$friendID?>"  >
                                      <button   class="btn btn-sm btn-warning " style=" margin-top: 5%; width: 150px; color: white;"><strong>Cancel Request</strong></button>
                                      </form>

                          <?php 
                          }
                          ?>






                          <?php 

                          if($fStatus==3) {?>
                                      <form method="POST" action="removefriend.php?id=<?=$friendID?>"  >
                                      <button   class="btn btn-sm btn-danger " style=" margin-top: 5%; width: 150px; "><strong>Remove Friend</strong></button>
                                      </form>

                          <?php 
                          }
                          ?>
                        </div>
                        <div class="h5">@<?=$nickname?></div>
                        <div class="h7 text-muted">Fullname : <?php echo($fName." ".$lName);?></div>
                        <div class="h7">Developer of web applications, JavaScript, PHP, Java, Python, Ruby, Java, Node.js,
                            etc.
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted"><i class="fas fa-home"></i> <?=$homeTown?></div>
                            <?php 
                          if($fStatus==0) {?>
                                      

                          <?php 
                          }
                          ?>




                          <?php 

                          if($fStatus==1){ ?>
                                     

                          <?php 
                          }
                          ?>





                          <?php 

                          if($fStatus==2) {?>
                                     

                          <?php 
                          }
                          ?>






                          <?php 

                          if($fStatus==3) {?>
                            <div class="h6 text-muted"><i class="fas fa-phone"></i> <?=$phone?></div>
                            <div class="h6 text-muted"><i class="fas fa-heart"></i> <?=$maritalStatus?></div>

                          <?php 
                          }
                          ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 gedf-main">

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