<?php
session_start();
require_once 'class.user.php';
require_once 'database.php';

    $pdo = MyData::connect(); 
    $sql = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql) as $row) { 
                $selectkey = $row['randkey'];  
            }

    $sql1 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql1) as $row) { 
                $selectkey1 = $row['randkey'];  
            }

    $sql2 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql2) as $row) { 
                $selectkey2 = $row['randkey'];  
            }

    $sql3 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql3) as $row) { 
                $selectkey3 = $row['randkey'];  
            }

    $sql19 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql19) as $row) { 
                $selectkey19 = $row['randkey'];  
            }

    $sql4 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql4) as $row) { 
                $selectkey4 = $row['randkey'];  
            }

    $sql5 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql5) as $row) { 
                $selectkey5 = $row['randkey'];  
            }

    $sql6 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql6) as $row) { 
                $selectkey6 = $row['randkey'];  
            }

    $sql7 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql7) as $row) { 
                $selectkey7 = $row['randkey'];  
            }

    $sql8 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql8) as $row) { 
                $selectkey8 = $row['randkey'];  
            }

    $sql9 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql9) as $row) { 
                $selectkey9 = $row['randkey'];  
            }

    $sql10 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql10) as $row) { 
                $selectkey10 = $row['randkey'];  
            }

    $sql11 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql11) as $row) { 
                $selectkey11 = $row['randkey'];  
            }

    $sql12 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql12) as $row) { 
                $selectkey12 = $row['randkey'];  
            }

    $sql13 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql13) as $row) { 
                $selectkey13 = $row['randkey'];  
            }

    $sql14 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql14) as $row) { 
                $selectkey14 = $row['randkey'];  
            }

    $sql15 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql15) as $row) { 
                $selectkey15 = $row['randkey'];  
            }

    $sql16 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql16) as $row) { 
                $selectkey16 = $row['randkey'];  
            }

    $sql17 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql17) as $row) { 
                $selectkey17 = $row['randkey'];  
            }

    $sql18 = "SELECT * FROM plaas_phrases order by RAND() LIMIT 20";
             foreach ($pdo->query($sql18) as $row) { 
                $selectkey18 = $row['randkey'];  
            }

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
  $reg_user->redirect('index.php');
}
  
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM plaas_accounts ORDER BY id DESC";
  $q = $pdo->prepare($sql);
  $q->execute(array());
  $data = $q->fetch(PDO::FETCH_ASSOC);
  $lastsee = $data['id'];   
  MyData::disconnect();

if(isset($_POST['btn-signup']))
{

    $cmyp1=$_POST['myp1'];  
    $cmyp2=$_POST['myp2'];  
    $cmyp3=$_POST['myp3'];  
    $cmyp4=$_POST['myp4'];  
    $cmyp5=$_POST['myp5'];  
    $cmyp6=$_POST['myp6'];  
    $cmyp7=$_POST['myp7'];  
    $cmyp8=$_POST['myp8'];  
    $cmyp9=$_POST['myp9'];  
    $cmyp10=$_POST['myp10'];  
    $cmyp11=$_POST['myp11'];  
    $cmyp12=$_POST['myp12'];  
    $cmyp13=$_POST['myp13'];  
    $cmyp14=$_POST['myp14'];  
    $cmyp15=$_POST['myp15'];  
    $cmyp16=$_POST['myp16'];  
    $cmyp17=$_POST['myp17'];  
    $cmyp18=$_POST['myp18'];  
    $cmyp19=$_POST['myp19'];  
    $cmyp20=$_POST['myp20'];

   $allcmp = $cmyp1 . ' ' . $cmyp2 . ' ' .$cmyp3 . ' ' . $cmyp4 . ' ' . $cmyp5 . ' ' .$cmyp6 . ' ' . $cmyp7 . ' ' . $cmyp8 . ' ' . $cmyp9 . ' ' .$cmyp10 . ' ' . 
    $cmyp11 . ' ' . $cmyp12 . ' ' .$cmyp13 . ' ' . $cmyp14 . ' ' . $cmyp15 . ' ' . $cmyp16 . ' ' .$cmyp17 . ' ' . $cmyp18 . ' ' . $cmyp19 . ' ' .$cmyp20;

  $email = trim($_POST['txtemail']);
  $keysystem1 = base64_encode($email); 
  $acmnm = rand(10, 99) . 'P' . time() . 'S';
  $keysystem = $keysystem1 . '' . $acmnm; 
  $uphrase = $allcmp;
  $upass = 'plaas';
  $utype = 'public'; 
  $ustatus = '0';
  $ucode = '0'; 
  $uattempt = '0'; 
  $uhashid = $keysystem;  
  
  $stmt = $reg_user->runQuery("SELECT * FROM plaas_accounts WHERE email_address=:email_id");
  $stmt->execute(array(":email_id"=>$email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if($stmt->rowCount() > 0)
  {
    $msg = "
        <div class='alert alert-danger' style='  color: #990012;
  background-color: #FBBBB9;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
          <strong>Email Error !</strong>  Address already exists, try using different email address or recover your address.
        </div>
        ";
  }
  else
  {
    if($reg_user->register($email,$uphrase,$upass,$uhashid,$ustatus,$ucode,$uattempt,$utype))
    {     
      $id = $reg_user->lasdID();    
      $key = base64_encode($id);
      $id = $key; 

    $msg = "
        <div class='alert alert-success' style='  color: #347235;
  background-color: #B5EAAA;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
          <strong>Confirmation !</strong> Account successfully created, check your email address: <b>$email</b> and copy the activation link on to your browser to activate the account.<br>
        <a href='verify.php?id=$id&code=$uhashid'> Click here to activate now ::)</a> 
        </div>
        "; 
    }
    else
    { 
    $msg = "
        <div class='alert alert-danger' style='  color: #990012;
  background-color: #FBBBB9;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
          <strong>Sorry !</strong> An error occured, try using different email address or recover your address.
        </div>
        ";  
    }   
  }
}
?>

<!DOCTYPE html>
<html lang="en-us">
<meta charset="utf-8" />
<head>
<title>Plaas | Registration | Proof-of-Extinction on the Blockchain</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <link rel="stylesheet" href="../css/loaders.min.css">
  <link rel="stylesheet" href="../preloader/css/main.css">
  <script src="../preloader/js/vendor/modernizr-2.6.2.min.js"></script>
<link rel="shortcut icon" href="../pic3.png" type="image/x-icon">
<link rel="icon" href="../pic3.png" type="image/x-icon">
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
  <div id="loader-wrapper" style="background-color:#7F5217;">  
      <div class="main" style="margin-top: -6%;"> 
      <div data-loader="ball-auto"></div> 
    </div> 

    </div>
<div class="form" style="border-bottom:solid 3px 3px #036; background-color: #7E3817; border-radius:2%;">
<div class="header"><h2>Sign Up</h2></div>
<center>
  <img style="margin-top: 3%;" class="img-circle border-effect" src="../images/pic3.png" alt=" " />
</center>
<div class="login">
<form method="POST">
<?php if(isset($msg)) echo $msg;  ?>
<ul> 
<li>
<span class="un"><i class="fa fa-user"></i></span><input type="text" required class="text" name="txtemail" placeholder="Email Address"/></li>
<input type="hidden" class="email" name="myp1">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp2" value="<?php echo !empty($selectkey1)?$selectkey1:'';?>" placeholder="p2">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp3" value="<?php echo !empty($selectkey2)?$selectkey2:'';?>" placeholder="p3">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp4" value="<?php echo !empty($selectkey3)?$selectkey3:'';?>" placeholder="p4">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp5" value="<?php echo !empty($selectkey4)?$selectkey4:'';?>" placeholder="p5">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp6" value="<?php echo !empty($selectkey5)?$selectkey5:'';?>" placeholder="p6">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp7" value="<?php echo !empty($selectkey6)?$selectkey6:'';?>" placeholder="p7">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp8" value="<?php echo !empty($selectkey7)?$selectkey7:'';?>" placeholder="p8">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp9" value="<?php echo !empty($selectkey8)?$selectkey8:'';?>" placeholder="p9">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp10" value="<?php echo !empty($selectkey9)?$selectkey9:'';?>" placeholder="p10">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp11" value="<?php echo !empty($selectkey10)?$selectkey10:'';?>" placeholder="p11">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp12" value="<?php echo !empty($selectkey11)?$selectkey11:'';?>" placeholder="p12">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp13" value="<?php echo !empty($selectkey12)?$selectkey12:'';?>" placeholder="p13">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp14" value="<?php echo !empty($selectkey13)?$selectkey13:'';?>" placeholder="p14">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp15" value="<?php echo !empty($selectkey14)?$selectkey14:'';?>" placeholder="p15">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp16" value="<?php echo !empty($selectkey15)?$selectkey15:'';?>" placeholder="p16">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp17" value="<?php echo !empty($selectkey16)?$selectkey16:'';?>" placeholder="p17">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp18" value="<?php echo !empty($selectkey17)?$selectkey17:'';?>" placeholder="p18">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp19" value="<?php echo !empty($selectkey18)?$selectkey18:'';?>" placeholder="p19">
<input style="border-radius: 5px;" type="hidden" class="email" name="myp20" value="<?php echo !empty($selectkey19)?$selectkey19:'';?>" placeholder="p20">
                
<li>
<input type="submit" value="REGISTER" name="btn-signup" class="btn">
</li> 
</ul>
</form>
<div class="social">
<a href="#"><div class="fb"><i class="fa fa-book"></i> &nbsp; Phrase Login</div></a>
<a href="#"><div class="tw"><i class="fa fa-archive"></i> &nbsp;  Recover</div></a>
</div>
</div><br/>
<div class="sign">
<div class="need">Own an account ?</div>
<div class="up"><a href="index.php">Login</a></div>
</div>
<br>
</div><br><br><br>
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