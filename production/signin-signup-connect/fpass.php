<?php
session_start();
require_once 'class.user.php';
$user = new USER();
 

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	
	$stmt = $user->runQuery("SELECT userID FROM property_spy_users WHERE userEmail=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE property_spy_users SET tokenCode=:token WHERE userEmail=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		
		echo"<center>
      <p style='color: #fff; font-weight: bold;'>	
				   Hello , $email
				   <br /><br />
				   We recieved a requested to reset your password, <br>if you do this then just click the following link to reset your password, <br>if not just ignore                   this message,
				   <br /><br />
				   Click The Following Link To Reset Your Password 
				   <br /><br />
				   <a href='resetpass.php?id=$id&code=$code'>click here to reset your password</a>
				   <br /><br />
				   thank you :)
            </p>
            </center>"; 
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry!</strong>  this email not found. 
			    </div>";
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Forgot Password | AparLink</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="../material/preloader/css/normalize.css">
    <link rel="stylesheet" href="../material/preloader/css/main.css">
    <script src="../material/preloader/js/vendor/modernizr-2.6.2.min.js"></script>
  
<style type="text/css">
::-webkit-scrollbar {
    -webkit-appearance: none;
}

::-webkit-scrollbar:vertical {
    width: 5px;
}

::-webkit-scrollbar:horizontal {
    height: 12px;
}

::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, .5);
    border-radius: 10px;
    border: 2px solid #98AFC7;
}

::-webkit-scrollbar-track {
    border-radius: 10px;  
    background-color:#98AFC7; 
}
</style>
  </head>
  <body id="login">
  <div id="loader-wrapper">
      <div id="loader"></div>

      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>

    </div>
    <div class="container">

      <form class="form-signin" method="post">
  <center> 
        <img width="100%" height="100%" style="border-radius: 30px;" src="../material/images/Aparlink.png">  
    </center>
        <hr style="margin-top: 1%; margin-bottom: 0px;"/>
        <h2 style="text-align: center;" class="form-signin-heading">forgot password</h2><hr />
        
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
				Please enter your email address. You will get a link to rest your password.!
				</div>  
                <?php
			}
			?>
        
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
     	<hr />
        <button  style="width: 65%;" class="btn btn-danger btn-primary" type="submit" name="btn-submit">Generate new Password</button>
        <a style="margin-left: 10%;" class="btn btn-default" href="index.php">Cancel</a> 
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script6
    <script src="bootstrap/js/bootstrap.min.js"></script1>

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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../material/preloader/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script src="../material/preloader/js/main.js"></script>
  </body>
</html>