<?php

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit();
}





$_SESSION['registered'] = TRUE;

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'socialnetwork';




$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$id = $_SESSION['id'];

$results = $con->query("SELECT firstName , lastName  FROM users  where id = $id ");

$fName = NULL;
$lName = NULL;

while ($row = $results->fetch_assoc()) {
    $fName = $row['firstName'];
    $lName = $row['lastName'];
}

$fName = strtolower($fName);
$lName = strtolower($lName);
$fName = ucwords($fName);
$lName = ucwords($lName);

$name = $fName . " " . $lName;

$nickname = NULL;

$profilepicture = NULL;

$phone = NULL;

$homeTown = NULL;

$maritalStatus = NULL;

$result2 = $con->query("SELECT id, firstName , lastName , nickName , phone, profilePicture , homeTown , maritalStatus , about FROM users  where id = $id ");

while ($row = $result2->fetch_assoc()) {
    $id = $row['id'];

    $nickname = $row['nickName'];

    $profilepicture = $row['profilePicture'];

    $phone =  $row['phone'];

    $homeTown = $row['homeTown'];

    $maritalStatus =  $row['maritalStatus'];

    $about = $row['about'];
}



if ($nickname != NULL) {
    $name = ucwords($nickname);
}


$friendRequests = $con->query("SELECT id , firstName , lastName , nickName , profilePicture FROM users WHERE id =  ANY (SELECT userB FROM friends WHERE userA = $id AND status = 0 )  ORDER BY firstName");


$requestCount = mysqli_num_rows($friendRequests);

$posts = $con->query("SELECT caption , state , image , time  FROM posts  WHERE authorId = $id  ORDER BY time DESC");






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
    <title><?= $name ?></title>
    <link href="css/stylesheet.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

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
                    <a class="nav-link" href="#"><i class="fas fa-home"></i> <?= $name ?><span class="sr-only">(current)</span></a>
                </li>


                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-bell"></i> Notifications
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="friendrequests.php"><i class="fas fa-users"></i> <?= $requestCount ?> Friend Request(s)</a>

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








    <div class="content" style="margin-top:2%; margin-bottom: 0;">
        <!-- <h4>Welcome , <?= $name ?> !</h4> -->



        <div class="container-fluid gedf-wrapper">
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="box-shadow:0 2px 4px rgba(0,0,0,.4);">
                        <div class="card-body">
                            <div>
                                <img class="img-circle img-responsive img-fluid" src="profilepictures/<?= $profilepicture ?>" style="border-radius:50%">
                            </div>
                            <div class="h5">@<?= $nickname ?></div>
                            <div class="h7 text-muted">Fullname : <?php echo ($fName . " " . $lName); ?></div>
                            <div class="h7">
                                <?= $about ?>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="h6 text-muted"><i class="fas fa-home"></i> <?= $homeTown ?></div>
                                <div class="h6 text-muted"><i class="fas fa-phone"></i> <?= $phone ?></div>
                                <div class="h6 text-muted"><i class="fas fa-heart"></i> <?= $maritalStatus ?></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 gedf-main">

                    <!--- \\\\\\\Post-->
                    <form action="submitpost.php" method="POST" id="postForm" value="postForm">
                        <div class="card gedf-card" style="margin-bottom:5px;">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                                            a post</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                        <div class="form-group">
                                            <label class="sr-only" for="message">post</label>
                                            <textarea form="postForm" name="caption" class="form-control" id="message" rows="3" placeholder="What is on your mind?"></textarea>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Upload image</label>
                                            </div>
                                        </div>
                                        <div class="py-4"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="authorId" value="<?= $id ?>" />
                                <div class="btn-toolbar justify-content-between">
                                    <div class="btn-group">
                                        <select class="custom-select" id="type" name="state">
                                          
                                            <option value="1">Public</option>
                                            <option value="2">Friends only</option>
                                            <option value="3">Only me</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">share</button>

                                    </div>
                                </div>
                            </div>
                    </form>
                    <!-- <div class="btn-group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-globe"></i>
                                </button>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                </div>
                            </div> -->
                </div>
                    <?php while ($row = $posts->fetch_assoc()) { ?>
                        <!--- \\\\\\\Post-->
                        <div class="card gedf-card" style="margin-top: 10px;">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-2">
                                            <img class="rounded-circle" width="45" src="profilepictures/<?= $profilepicture ?>" alt="">
                                        </div>
                                        <div class="ml-2">
                                            <div class="h5 m-0">@<?= $nickname ?></div>
                                            <div class="h7 text-muted"><?php echo ($fName . " " . $lName); ?></div>
                                        </div>
                                    </div>
                                    <div>
                                        <!-- <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                            <div class="h6 dropdown-header">Configuration</div>
                                            <a class="dropdown-item" href="#">Save</a>
                                            <a class="dropdown-item" href="#">Hide</a>
                                            <a class="dropdown-item" href="#">Report</a>
                                        </div>
                                    </div> -->
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="text-muted h7 mb-2"> <i class="fa fa-clock"></i> <?= $row['time'] ?></div>
                                <!-- <a class="card-link" href="#">
                                <h5 class="card-title">Caption</h5>
                            </a> -->

                                <p class="card-text">
                                    <?= $row['caption'] ?>
                                </p>
                            </div>
                            <!-- <div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                            <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                            <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                        </div> -->
                        </div>
                        <!-- Post /////-->
                    

            <?php } ?>
                </div>

        </div>
    </div>
    <!-- Post /////-->

    <!-- 
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10">
            <h1><?= $name ?></h1></div>
        <div class="col-sm-2">
            <a href="#" class="pull-right"><img title="profile image" class="img-circle img-responsive avatar-pic" src="profilepictures/<?= $profilepicture ?>"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
    

            <ul class="list-group">
                <li class="list-group-item text-muted">Info</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Hometown   </strong></span><?= $homeTown ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Phone   </strong></span> <?= $phone ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Status   </strong></span> <?= $maritalStatus ?></li>
            </ul>
        </div>
		</div> -->



    <div class="content" style="margin: 0 auto;">




        <span>

            <footer style=" display: table;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    margin-top:20%;">

                <p>2019 ©</p>

            </footer>

        </span>


    </div>



</body>

</html>







<?php

$con->close();

?>