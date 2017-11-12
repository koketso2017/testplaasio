<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
  if ($_SESSION['userTyp']=='Landlord') {
  $user_login->redirect('../index.php'); 
  }
  elseif ($_SESSION['userTyp']=='Tenant') {
  $user_login->redirect('../index-tenant.php');
  }
  else {
  $user_login->redirect('index.php');
  }
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email,$upass))
	{
		if ($_SESSION['userTyp']=='Landlord') {
  $user_login->redirect('../index.php'); 
  }
  elseif ($_SESSION['userTyp']=='Tenant') {
  $user_login->redirect('../index-tenant.php');
  }
  else {
  $user_login->redirect('index.php');
  }
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login | Property Spy</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9] <![endif]--> 
   
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <link rel="stylesheet" href="../material/preloader/css/normalize.css">
    <link rel="stylesheet" href="../material/preloader/css/main.css">
    <script src="../material/preloader/js/vendor/modernizr-2.6.2.min.js"></script>

    <link rel="shortcut icon" href="../favicon.ico"> 
    <link rel="stylesheet" type="text/css" href="../css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../css/style2.css" />
    <script type="text/javascript" src="../js/modernizr.custom.86080.js"></script>
  </head>
    <div id="loader-wrapper">
      <div id="loader"></div>

      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>

    </div>
  <body id="login">
            <!-- Codrops top bar -->
            <div class="codrops-top" style="width: 100%; height: 30px; margin-top: -3%; margin-bottom: 1%;">
                <a href="welcome.html" target="_blank">
                    <strong>&laquo; Property Spy - </strong>the leading property management Application
                </a>
                <span class="right">
                    <a href="#">Developed and Maintained By</a>
                    <a href="#" target="_blank">Tebogo Ishmael</a>
                    <a href="#">
                        <strong style="color: snow;">All Rights Reserved @ Property Spy</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
        <ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3>Pro.per.ty spy</h3></div></li>
            <li><span>Image 02</span><div><h3>the·real·deal</h3></div></li>
            <li><span>Image 03</span><div><h3>where·property·style</h3></div></li>
            <li><span>Image 04</span><div><h3>it.is·all.yours</h3></div></li>
            <li><span>Image 05</span><div><h3>come·rent·it</h3></div></li>
            <li><span>Image 06</span><div><h3>re·lax·a·tion</h3></div></li>
        </ul>
    <div class="container">
		<?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Sorry!</strong> This Account is Deactivated, use your personal email address and send a request for activation to Email: ishmael.tebogo1992@gmail or contact Cell: +267 76250638. 
			</div>
            <?php
		}
		?>
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
		{
			?>
        <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Wrong Details!</strong> 
			</div>
            <?php
		}
		?>
        <img style="margin-left: 10%;" width="70%" height="50%" src="../material/images/navlogo_a.png">
        <img style="margin-left: 8%;" width="30%" height="20%" src="../material/images/spylogo.png">
        <p style="text-align: center; font-weight: bold;">ACCOMODATION<font color="darkblue"> GENIUS</font></p>
        <hr />
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />
     	<hr style="margin-top: 1%;" />
        <button style="margin-left: -30%;" class="btn btn-large btn-primary" type="submit" name="btn-login">Sign in</button>
        <a href="signup.php" style="float:right;" class="btn btn-default btn-large">Sign Up</a><hr />
        <p style="font-weight: bold; margin-left: 6%;">AVAILABLE ON PROPERTY-SPY 1.1</p>
      <button disabled="true" style="width: 100%; text-align: center; margin-top: 0%; font-size: 15px;" type="buttoni" class="btn btn-danger btn-large"><img style="width: 30px; height: 30px;" src="../material/images/gp.png" /> GOOGLE ACCOUNT</button>
        <button disabled="true" style="width: 100%; text-align: center; margin-top: 2%; font-size: 15px;" type="button" class="btn btn-primary btn-large"><img style="width: 30px; height: 30px;" src="../material/images/fb.png" /> FACEBOOK ACCOUNT</button><hr style="margin-top: 1%;" />
        <a style="float: right; margin-top: 1%;" href="fpass.php">Forgot Your Password ? </a>
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Preloader -->
   <script type="text/javascript">
    //<![CDATA[
    $(window).load(function() { // makes sure the whole site is loaded
      $('#status').fadeOut(); // will first fade out the loading animation
      $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
      $('body').delay(350).css({'overflow':'visible'});
    })
  //]]>
</script> 
<script>window.jQuery || document.write('<script src="../material/preloader/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script src="../material/preloader/js/main.js"></script>

  </body>
</html>