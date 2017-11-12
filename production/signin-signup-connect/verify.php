<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$statusY = "1";
	$statusN = "0";
	
	$stmt = $user->runQuery("SELECT id,status,phrases,email_address,hashid FROM plaas_accounts WHERE id=:uID AND hashid=:code LIMIT 1");
	$stmt->execute(array(":uID"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0)
	{
	    $mykeys = $row['phrases'];
	    $myemail = $row['email_address'];
	    $myhashid = $row['hashid'];

		if($row['status']==$statusN)
		{
			$stmt = $user->runQuery("UPDATE plaas_accounts SET status=:status WHERE id=:uID");
			$stmt->bindparam(":status",$statusY);
			$stmt->bindparam(":uID",$id);
			$stmt->execute();	
			
			$msg = "
		           <div class='alert alert-success' style='border-radius: 4px;'> 
				    <strong>Welcome - $myemail: </strong> Account successfully activated, proceed to login using the links given below.<br><br>
                    <p style='color: #9F000F;'><b>NOTE:</b> Back up the given security phrases in a secure place and for account credientials use either the given email or ID below to login.</b><br>
                    <b><p style='font-size: 100%;'>Email: $myemail</p></b>
                    <b><p style='font-size: 100%; word-break: break-all; word-wrap: break-word;'>ID: $myhashid</p></b>
                    <b><p style='font-size: 100%;'>PHRASES: $mykeys</p></b>
			       </div>
			       ";	
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
					  <strong>Alert !</strong>  Your Account is already Activated. Proceed to login using any of the given login method below.</a>
			       </div>
			       "; 
		}
	}
	else
	{
		$msg = "
		       <div class='alert alert-danger' style='  color: #800517;
  background-color: #B5EAAA;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
			   <strong>sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
			   </div>
			   ";
	}	
} 

?>


<!DOCTYPE html>
<html lang="en-us">
<meta charset="utf-8" />
<head>
<title>Plaas | Registration | Proof-of-Extinction on the Blockchain</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
<link rel="shortcut icon" href="../logo.png.ico" type="image/x-icon">
<link rel="icon" href="logo.png.ico" type="../image/x-icon">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
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
.header{height:44px; width: 50%; margin-left: 25%; border-radius:10%; background:#7F5217;}
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
.sign{width:90%; padding:0 5%; height:50px; margin-left: 5%; display:table; background:#7F5217}
.sign div{display:inline-block; width:50%; line-height:50px; color:#ccc; font-size:14px}
.up{text-align:right}
.up a{display:block; background:#E8A317; text-align:center; height:35px; line-height:35px; width:50%; font-size:16px; text-decoration:none; color:#eee; border-bottom:solid 3px #C35817; border-radius:3px; font-weight:bold; margin-left:50%}
@media(max-width:480px){ .form{width:100%}}
.alert-success{color:#3c763d;background-color:#dff0d8;border-color:#d6e9c6}.alert-success hr{border-top-color:#c9e2b3}.alert-success .alert-link{color:#2b542c}.alert-info{color:#31708f;background-color:#d9edf7;border-color:#bce8f1}
.alert-danger{color:#a94442;background-color:#f2dede;border-color:#ebccd1}.alert-danger hr{border-top-color:#e4b9c0}.alert-danger .alert-link{color:#843534}@-webkit-keyframes progress-bar-stripes{from{background-position:40px 0}to{background-position:0 0}}
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
<div class="form">
<div class="header"><h2>Comfirmation</h2></div>
<center>
  <img style="margin-top: 3%;" class="img-circle border-effect" src="../images/pic3.png" alt=" " />
</center>
<div class="login">
<form>
<?php if(isset($msg)) echo $msg;  ?>
<ul> 
<input type="hidden" value="<?php echo !empty($myemail)?$myemail:'';?>" class="text" name="mymail"/> 
<input type="hidden" value="<?php echo !empty($myhashid)?$myhashid:'';?>" class="text" name="myphrase"/> 
<li>
<?php echo '<a class="btn" name="btndel" style="" href="index.php?reg_userselectedid='. $myemail .'">'?>CONTINUE <?php echo '</a>'?>
</li> 
</ul>
</form>
<div class="social">
<a href="#"><div class="fb"><i class="fa fa-book"></i> &nbsp; Phrase Login</div></a>
<a href="#"><div class="tw"><i class="fa fa-archive"></i> &nbsp;  Recover</div></a>
</div>
</div><br/>
<div class="sign">
<div class="need">Account already activated ?</div>
<div class="up"><a href="index.php">Login</a></div>
</div>
</div>
<br>
</body>
</html>