<?php
  session_start();
  require_once 'database.php'; 
  require_once 'class.user.php';
  require_once '../dbConfig.php'; 
  
  $userpass = '';
  $useremail = null;
  if (!empty($_GET['reg_userselectedid'])) {
    $useremail = $_REQUEST['reg_userselectedid'];
  }


    $pdo = MyData::connect();
    $sql = "(select * from plaas_accounts WHERE email_address = '$useremail')";
    foreach ($pdo->query($sql) as $row){ 
     $useraddress = $row['email_address']; 
     $userhash = $row['hashid'];  
     $userpass = $row['password'];  
    }
    $checkpass = 'plaas';    
    $password = md5($checkpass);
    MyData::disconnect();
 
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
  if ($_SESSION['userTyp']=='administrator') {
  $user_login->redirect('../index.php'); 
  }
  elseif ($_SESSION['userTyp']=='public') {
  $user_login->redirect('../farmers-management-application.php');
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
    if ($_SESSION['userTyp']=='administrator') {
  $user_login->redirect('../index.php'); 
  }
  elseif ($_SESSION['userTyp']=='Tenant') {
  $user_login->redirect('../farmers-management-application.php');
  }
  else {
  $user_login->redirect('index.php');
  }
  }
}

$msgp = "
         <div class='alert alert-danger' style='  color: #800517;
  background-color: #B5EAAA;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong>Warning !</strong> Before you continue, change the default password and make your own strong password.
         </div>
         ";

if(isset($_POST['passworddetails']))
  { 
    $mypass=$_POST['mynewpass'];
    $mypassre=$_POST['myrecpass'];  
    $newedit = md5($mypass);
    $activity = '1'; 
    $delactivity = '0'; 

    $count=mysqli_query($con,"SELECT * FROM plaas_accounts WHERE password = '$mypass' AND email_address = '$useremail'");
    if(mysqli_num_rows($count) < 1)
    {     
     if ($mypass != $mypassre) {
      $msg = "
          <div class='alert alert-danger' style='  color: #800517;
  background-color: #B5EAAA;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'>
           <button class='close' data-dismiss='alert'>&times;</button>
           <strong>Password Error !</strong> Passwords did not match. Enter same passwords on both fields.</a>
          </div>
             ";
     }else{ 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE plaas_accounts SET password = ? WHERE email_address = ?";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($newedit,$useremail));  

    $sql19 = "INSERT INTO plaas_activities (email_address, status, delstatus) VALUES (?, ?, ?)";   
    $q19 = $pdo->prepare($sql19);
    $q19->execute(array($useremail,$activity,$delactivity)); 
    $msg = "
           <div class='alert alert-success' style='  color: #347235;
  background-color: #BCE954;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
            <strong>Comfirmation !</strong> Password successfully updated. Proceed to login using any of the given login method below.</p>
           </div>
             "; 
    MyData::disconnect(); 
     }
    } 
     else
      {   
       $msg = "
         <div class='alert alert-warning' style='  color: #990012;
  background-color: #FBBBB9;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong>Warning !</strong> No change made, change the default password and make your own secure combination.
         </div>
         "; 
      }
  }
?>

<!DOCTYPE html>
<html lang="en-us">
<meta charset="utf-8" />
<head>
<title>Plaas | Login | Farmers Management System: Proof-of-Extinction on the Blockchain</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <link rel="stylesheet" href="../css/loaders.min.css">
  <link rel="stylesheet" href="../preloader/css/main.css">
  <script src="../preloader/js/vendor/modernizr-2.6.2.min.js"></script>
<link rel="shortcut icon" href="../logo.png.ico" type="image/x-icon">
<link rel="icon" href="../logo.png.ico" type="image/x-icon"> 
<style>
@import url("http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");
@import url("http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700");
*{margin:0; padding:0}
body{
    background: url(../images/2462433.jpg) no-repeat 0px 0px;
    background-size: cover;
  -webkit-background-size: cover;
   -moz-background-size: cover;
    -ms-background-size: cover;
    -o-background-size: cover; font-family: 'Source Sans Pro', sans-serif}
.form{width:400px; margin:0 auto; border: 2px; border-color:#AF7809; margin-top:100px}
.header{height:44px; width: 30%; margin-left: 35%; border-radius:10%;}
.header h2{height:44px; line-height:44px; color:#fff; text-align:center}
.login{padding:0 20px}
.login span.un{width:10%; text-align:center; color:#7F5217; border-radius:3px 0 0 3px}
.text{background:#493D26; width:90%; border-radius:0 3px 3px 0; border:none; outline:none; color:#ffd; font-family: 'Source Sans Pro', sans-serif} 
.text,.login span.un{display:inline-block; vertical-align:top; height:40px; line-height:40px; background:#493D26;}

.btn{height:40px; border:none; background:#7F5217; width:100%; outline:none; font-family: 'Source Sans Pro', sans-serif; font-size:20px; font-weight:bold; color:#eee; border-bottom:solid 3px #493D26; border-radius:3px; cursor:pointer}
ul li{height:40px; margin:15px 0; list-style:none}
.span{display:table; width:100%; font-size:14px;}
.ch{display:inline-block; width:50%; color:#fff}
.ch a{color:#fff; text-decoration:none}
.ch:nth-child(2){text-align:right}
/*social*/
.social{height:30px; line-height:30px; display:table; width:100%}
.social div{display:inline-block; width:42%; color:#eee; font-size:12px; text-align:center; border-radius:3px}
.social div i.fa{font-size:16px; line-height:30px}
.fb{background:#423D26; border-bottom:solid 3px #806517} .tw{background:#6F4E37; margin-left:16%; border-bottom:solid 3px #806517}
/*bottom*/
.sign{width:80%; padding:0 5%; height:50px; margin-left: 5%; display:table; background:#7F5217}
.sign div{display:inline-block; width:50%; line-height:50px; color:#ccc; font-size:14px}
.up{text-align:right}
.up a{display:block; background:#E8A317; text-align:center; height:35px; line-height:35px; width:50%; font-size:16px; text-decoration:none; color:#eee; border-bottom:solid 3px #C35817; border-radius:3px; font-weight:bold; margin-left:50%}
@media(max-width:480px){ .form{width:100%}}
</style>

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
    border: 2px solid #7F5217;
}

::-webkit-scrollbar-track {
    border-radius: 10px;  
    background-color:#7F5217; 
}
</style>
</head>
<body>
  <div id="loader-wrapper" style="background-color:#7F5217;">  
      <div class="main" style="margin-top: -6%;"> 
      <div data-loader="ball-auto"></div> 
    </div> 

    </div>
<div class="form" style="border-bottom:solid 3px 3px #036; background-color: #7E3817; border-radius:2%;">
<div class="header"><h2>Sign In</h2></div>
<center>
  <img style="margin-top: 3%;" class="img-circle border-effect" src="../images/pic3.png" alt=" " />
</center> 
<?php 
if ($userpass == $password) {
?>
<div class="login">
<?php if(isset($msgp)) echo $msgp;  ?>
<form method="POST">
<ul>
<li>
<span class="un"><i class="fa fa-lock"></i></span><input type="password" required class="text" name="mynewpass" placeholder="New Password" value=""/></li> 
<li>
<span class="un"><i class="fa fa-lock"></i></span><input type="password" required class="text" name="myrecpass" placeholder="Comfirm Password"/></li>
<li>
<input type="submit" value="SAVE CHANGES" name="passworddetails" class="btn">
</li> 
</ul>
</form>
<div class="social">
<a href="#" disabled="true"><div class="fb"><i class="fa fa-book"></i> &nbsp; Phrase Login</div></a>
<a href="#" disabled="true"><div class="tw"><i class="fa fa-archive"></i> &nbsp;  Recover</div></a>
</div>
</div><br/>
<?php
}else{
?>
<div class="login">
    <?php 
    if(isset($_GET['inactive']))
    { 
      $msgcx = "
         <div class='alert alert-danger' style='  color: #990012;
  background-color: #FBBBB9;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong>Account Error !</strong> Account is inactive. Visit your email address and use the activation link sent to you | If you encounter any problem visit <a href='http://plaas.io'>Plaas</a> site and log your request to the support team.
         </div>
         "; 
    }
    ?>
   <?php
        if(isset($_GET['error']))
    {  
      $msgcx = "
         <div class='alert alert-danger' style='  color: #990012;
  background-color: #FBBBB9;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Validation Error !</strong>  Supplied email address and password does not match.
         </div>
         ";  
    }
    ?>
   <?php
        if(isset($_GET['error-message']))
    {  
      $msgcx = "
         <div class='alert alert-warning' style='  color: #614051;
  background-color: #EDC9AF;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong>Unknown Account Error !</strong> We could not find your account. Visit <a href='http://plaas.io'>Plaas</a> site and log your request to the support team.
         </div>
         ";  
    }
    ?>
<?php echo !empty($msgcx)?$msgcx:''; ?>
<?php if(isset($msg)) echo $msg;  ?>
<form method="POST">
<ul>
<li>
<span class="un"><i class="fa fa-user"></i></span><input type="text" required class="text" name="txtemail" placeholder="Email Address" value=""/></li>
<li>
<span class="un"><i class="fa fa-lock"></i></span><input type="password" required class="text" name="txtupass" placeholder="Password"/></li>
<li>
<input type="submit" value="LOGIN" name="btn-login" class="btn">
</li>
<li><div class="span"><span class="ch"><input type="checkbox" id="r"> <label for="r">Remember Me</label> </span> <span class="ch"><a href="#">Forgot Password?</a></span></div></li>
</ul>
</form>
<div class="social">
<a href="#"><div class="fb"><i class="fa fa-book"></i> &nbsp; Phrase Login</div></a>
<a href="#"><div class="tw"><i class="fa fa-archive"></i> &nbsp;  Recover</div></a>
</div>
</div><br/>
<?php 
}
?>
<div class="sign">
<div class="need">Need Account ?</div>
<div class="up"><a href="signup.php">Register</a></div>
</div>
<br>
</div>
<br>
</body>
</html>
 
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
<script>window.jQuery || document.write('<script src="../preloader/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script src="../preloader/js/main.js"></script>