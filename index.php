


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


if (isset($_SESSION['loggedin'])) {


   header('Location: completeyourprofile.php');
  
}


?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Welcome!</title>
      <!-- Meta tags -->
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      
      <script>
         addEventListener("load", function () { setTimeout(hideURLbar, 0); }, false); function hideURLbar() { window.scrollTo(0, 1); }
      </script>
      <!-- Meta tags -->
      <!--stylesheets-->
      <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//style sheet end here-->
      <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
      <link rel="stylesheet" href="css/bootstrap.css">
   </head>
   <body>
      <div class="mid-class">
         <div class="art-right-w3ls">
            <h2>Sign In Here</h2>
            <form action="signin.php" method="post" autocomplete="off">
               <div class="main">
                  <div class="form-left-to-w3l">
                     <input type="email" name="email" placeholder="E-mail" required="required">
                  </div>
                  <div class="form-left-to-w3l ">
                     <input type="password" name="password" placeholder="Password" required="required">
                     <div class="clear"></div>
                  </div>
               </div>
              
               <div class="clear"></div>
               <div class="btnn">
                  <button type="submit">Sign In</button>
               </div>
            </form>
            <div class="w3layouts_more-buttn">
               <h3>Don't Have an account..?
                  <a href="#content1">Sign Up Here
                  </a>
               </h3>
            </div>
            <!-- popup-->
            <div id="content1" class="popup-effect">
               <div class="popup">
                  <!--login form-->
                  <div class="letter-w3ls">
                     <form action="signup.php" method="POST" autocomplete="off">
                        <div class="form-left-to-w3l">
                           <input type="text" name="firstname" placeholder="First Name" required="required">
                        </div>
                         <div class="form-left-to-w3l">
                           <input type="text" name="lastname" placeholder="Last Name" required="required">
                        </div>
                        <div class="form-left-to-w3l">
                           <input type="email" name="email" placeholder="Email" required="required">
                        </div>
                        <div class="form-left-to-w3l">
                           <input type="password" name="password1" placeholder="Password" required="required">
                        </div>
                        <div class="form-left-to-w3l margin-zero">
                           <input type="password" name="password2" placeholder="Confirm Password" required="required">
                        </div>

                         <div class="form-left-to-w3l" style="margin-top: 25px; margin-bottom: 25px; ">
                           <div style="float: left; margin-bottom: 15px;">Birth Date :</div> 
                           <input type="date" name="birthdate" required="required">
                        </div>

<div   style="margin-top: 30px; height: 20px; float: inherit;">


<div  class="gender" style="float: left;">Gender :</div>          
  <input  type="radio" name="gender" value="male" checked> Male
  <input style="margin-left: 30px" type="radio" name="gender" value="female"> Female
 


</div>
                        <div class="btnn">
                           <button  type="submit">Sign Up</button>
                           <br>
                        </div>
                     </form>
                     <div class="clear"></div>
                  </div>
                  <!--//login form-->
                  <a class="close" href="#">&times;</a>
               </div>
            </div>
            <!-- //popup -->
         </div>
         <div class="art-left-w3ls">
            <h1 class="header-w3ls">
               Social Network Database 2019
            </h1>
         </div>
      </div>
      <footer class="bottem-wthree-footer"> 
        
   
         <p >


            © 2019     
         </p>
      </footer>
   </body>
</html>