


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



<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'pt-BR'
    });
  });
</script>
  
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
                           <input  type="date"  name="birthdate" required="required">
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