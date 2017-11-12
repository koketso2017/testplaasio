<?php
session_start();

require_once 'signin-signup-connect/class.user.php';
require_once 'signin-signup-connect/database.php';
require_once 'dbConfig.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
  $user_home->redirect('signin-signup-connect/index.php');
}
    
    $pdo = MyData::connect(); 
    $stmt = $user_home->runQuery("SELECT * FROM plaas_accounts WHERE id=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['userSession']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    $userid = $row['id'];
    $useraddress = $row['email_address'];
    $userphrase = $row['phrases'];
    $userhashid = $row['hashid'];
    $userstatus = $row['status'];
    $usercode = $row['code'];
    $userattempts = $row['attempts']; 
    $usertype = $row['userType'];
    $userreg = $row['regdate'];   
    $modified = $row['modified'];
    
    $stmt = $user_home->runQuery("SELECT * FROM plaas_user_details WHERE accountid =:uid");
    $stmt->execute(array(":uid"=>$_SESSION['userSession']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    $firstname = $row['fname'];
    $lastname = $row['lname'];
    $gender=$row['gender'];
    $dateofbith = $row['dob'];
    $publicsts = $row['publicstatus'];
    $contact=$row['contact']; 
    $residentialad = $row['residential'];
    $country = $row['country'];
    $citytown=$row['city']; 
    $citystreet=$row['street']; 
    $pictu = $row['picture'];
    $modlast = $row['modified'];
    $added=$row['added'];

    if ($publicsts == 'N') {
       $dispme = 'NO';
    }else {
       $dispme = 'YES';
    }
    
    $stmt = $user_home->runQuery("SELECT * FROM plaas_user_setings WHERE userid =:uid");
    $stmt->execute(array(":uid"=>$_SESSION['userSession']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    $weight = $row['metricid'];
    $distance = $row['distanceid'];
    $currencyuse=$row['currencyid'];
    $Updatestst = $row['updates']; 
    $setmodlast = $row['modified'];
    $setadded=$row['added'];
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM plaas_mass WHERE id = '$weight'";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $weightname = $data['name'];
    $weightkilo = $data['defunit'];
    $weightvalue = $data['value'];
    $weightsymbol = $data['sysmbol']; 
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM products ORDER by id DESC LIMIT 1";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $selbreed = $data['breedId']; 
    $lastsignmod = $data['upsign']; 
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM products WHERE userid = '$userid' ORDER by id DESC LIMIT 1";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $lastsignmod = $data['upsign'];
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM plaas_products_statistics_user WHERE name = 'Cattle' AND userid = '$userid' ORDER by id DESC LIMIT 1";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $viewtotalup = $data['total'];
    $lasttotalup = $data['totalincrease'];
    $lasttotaldown = $data['totaldecrease'];
    $updownsigncattle = $data['updown']; 
    $updowncattlemod = $data['modified']; 
    $date = new DateTime($updowncattlemod);
    $new_date_format = $date->format('Y-m-d');

    $cattlepercentcount =  ($lasttotalup / 100 * $viewtotalup); 
    $cattlepercentcount_string = number_format($cattlepercentcount, 2);

    $cattlepercentcountdown =  ($lasttotaldown / 100 * $viewtotalup); 
    $cattlepercentcountdown_string = number_format($cattlepercentcountdown, 2);
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM plaas_products_statistics_user WHERE name = 'Goat' AND userid = '$userid' ORDER by id DESC LIMIT 1";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $viewtotalupGT = $data['total'];
    $lasttotalupGT = $data['totalincrease'];
    $lasttotaldownGT = $data['totaldecrease'];
    $updownsigngoat = $data['updown']; 
    $updowngoatmod = $data['modified']; 
    $dateGT = new DateTime($updowngoatmod);
    $new_date_formatGT = $dateGT->format('Y-m-d');

    $goatpercentcount =  ($lasttotalupGT / 100 * $viewtotalupGT); 
    $goatpercentcount_string = number_format($goatpercentcount, 2);

    $goatpercentcountdown =  ($lasttotaldownGT / 100 * $viewtotalupGT); 
    $goatpercentcountdown_string = number_format($goatpercentcountdown, 2);
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM plaas_products_statistics_user WHERE name = 'Horse' AND userid = '$userid' ORDER by id DESC LIMIT 1";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $viewtotalupHS = $data['total'];
    $lasttotalupHS = $data['totalincrease'];
    $lasttotaldownHS = $data['totaldecrease'];
    $updownsignhorse = $data['updown']; 
    $updownhorsemod = $data['modified']; 
    $dateHS = new DateTime($updownhorsemod);
    $new_date_formatHS = $dateHS->format('Y-m-d');

    $horsepercentcount =  ($lasttotalupHS / 100 * $viewtotalupHS); 
    $horsepercentcount_string = number_format($horsepercentcount, 2);

    $horsepercentcountdown =  ($lasttotaldownHS / 100 * $viewtotalupHS); 
    $horsepercentcountdown_string = number_format($horsepercentcountdown, 2);
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM plaas_products_statistics_user WHERE name = 'Sheep' AND userid = '$userid' ORDER by id DESC LIMIT 1";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $viewtotalupSP = $data['total'];
    $lasttotalupSP = $data['totalincrease'];
    $lasttotaldownSP = $data['totaldecrease'];
    $updownsignsheep = $data['updown']; 
    $updownsheepmod = $data['modified']; 
    $dateSP = new DateTime($updownsheepmod);
    $new_date_formatSP = $dateSP->format('Y-m-d');

    $sheeppercentcount =  ($lasttotalupSP / 100 * $viewtotalupSP); 
    $sheeppercentcount_string = number_format($sheeppercentcount, 2);

    $sheeppercentcountdown =  ($lasttotaldownSP / 100 * $viewtotalupSP); 
    $sheeppercentcountdown_string = number_format($sheeppercentcountdown, 2);
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM plaas_products_statistics_user WHERE name = 'Pig' AND userid = '$userid' ORDER by id DESC LIMIT 1";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $viewtotalupPG = $data['total'];
    $lasttotalupPG = $data['totalincrease'];
    $lasttotaldownPG = $data['totaldecrease'];
    $updownsignpig = $data['updown']; 
    $updownpigmod = $data['modified']; 
    $datePG = new DateTime($updownpigmod);
    $new_date_formatPG = $datePG->format('Y-m-d');

    $pigpercentcount =  ($lasttotalupPG / 100 * $viewtotalupPG); 
    $pigpercentcount_string = number_format($pigpercentcount, 2);

    $pigpercentcountdown =  ($lasttotaldownPG / 100 * $viewtotalupPG); 
    $pigpercentcountdown_string = number_format($pigpercentcountdown, 2);


if ($result0122 = mysqli_query($con, "SELECT sum(total) as userproductstotal FROM plaas_products_statistics_user WHERE userid = '$userid'")) {
 
while ($row = mysqli_fetch_assoc($result0122))
{ 
   $usersprocducts =  $row['userproductstotal'];
   $usersprocducts_string = number_format($usersprocducts, 2);
}
    /* close result set */
    mysqli_free_result($result0122);
}

$userallproducts = ($viewtotalup+$viewtotalupGT+$viewtotalupHS+$viewtotalupSP+$viewtotalupPG);
$userotherproducts = $usersprocducts-$userallproducts; 

    $mainpercentcount =  ($userotherproducts / 100 * $usersprocducts); 
    $mainpercentcount_string = number_format($mainpercentcount, 2);

             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM plaas_products_statistics_user WHERE name = 'Chicken' AND userid = '$userid' ORDER by id DESC LIMIT 1";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $viewtotalupCK = $data['total'];
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM plaas_products_statistics_user WHERE name = 'Ducks' AND userid = '$userid' ORDER by id DESC LIMIT 1";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $viewtotalupDK = $data['total'];
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM plaas_metrics WHERE id = '$distance'";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $distancename = $data['name'];
    $distancekilo = $data['defunit'];
    $distancevalue = $data['value'];
    $distancesymbol = $data['sysmbol'];
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM plaas_countries WHERE id = '$currencyuse'";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $setcuountname = $data['name'];
    $setcurrencyname = $data['currency'];
    $setcountrycode = $data['callcode'];
    $setcoucontinent=$data['continent'];
    $setcountrycur = $data['subcurrency']; 

    $stmt = $user_home->runQuery("SELECT * FROM plaas_countries WHERE name =:coun");
    $stmt->execute(array(":coun"=>$country));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    $currencyname = $row['currency'];
    $countrycode = $row['callcode'];
    $coucontinent=$row['continent'];

if ($result01 = mysqli_query($con, "SELECT sum(total) as productstotal FROM products WHERE categoryid = '1' AND userid = '$userid'")) {
 
while ($row = mysqli_fetch_assoc($result01))
{ 
   $procductscattle =  $row['productstotal'];
   $procductscattle_string = number_format($procductscattle, 2);
}
    /* close result set */
    mysqli_free_result($result01);
}

if ($result0122 = mysqli_query($con, "SELECT sum(total) as userproductstotal FROM plaas_products_statistics_user WHERE userid = '$userid'")) {
 
while ($row = mysqli_fetch_assoc($result0122))
{ 
   $usersprocducts =  $row['userproductstotal'];
   $usersprocducts_string = number_format($usersprocducts, 2);
}
    /* close result set */
    mysqli_free_result($result0122);
}

$userallproducts = ($viewtotalup+$viewtotalupGT+$viewtotalupHS+$viewtotalupSP+$viewtotalupPG);
$userotherproducts = ($usersprocducts-$userallproducts);
             
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query_ams_settings = "SELECT * FROM products WHERE categoryid = '1' AND userid = '$userid' ORDER by id DESC LIMIT 1";
$q = $pdo->prepare($query_ams_settings);
$q->execute(array());
$data = $q->fetch(PDO::FETCH_ASSOC); 
$lastsignmodct = $data['upsign']; 

if ($result02 = mysqli_query($con, "SELECT sum(total) as productstotal FROM products WHERE categoryid = '2'")) {
 
while ($row = mysqli_fetch_assoc($result02))
{ 
   $procductsgoats =  $row['productstotal'];
   $procductsgoats_string = number_format($procductsgoats, 2);
}
    /* close result set */
    mysqli_free_result($result02);
}
             
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query_ams_settings = "SELECT * FROM products WHERE categoryid = '2' AND userid = '$userid' ORDER by id DESC LIMIT 1";
$q = $pdo->prepare($query_ams_settings);
$q->execute(array());
$data = $q->fetch(PDO::FETCH_ASSOC); 
$lastsignmodgt = $data['upsign'];

if ($result011 = mysqli_query($con, "SELECT sum(total) as uptotal FROM products WHERE categoryid = '2' AND userid = '$userid' ORDER by id DESC LIMIT 1")) {
 
while ($row = mysqli_fetch_assoc($result011))
{ 
   $upprocductgoat =  $row['uptotal'];
}
    /* close result set */
    mysqli_free_result($result011);
}

$updownpercentgt =  ($upprocductgoat / 100 * $procductsgoats);  
$upprocductgoat_string = number_format($updownpercentgt, 2);

if ($result03 = mysqli_query($con, "SELECT sum(total) as productstotal FROM products WHERE categoryid = '8' AND userid = '$userid'")) {
 
while ($row = mysqli_fetch_assoc($result03))
{ 
   $procductshorse =  $row['productstotal'];
   $procductshorse_string = number_format($procductshorse, 2);
}
    /* close result set */
    mysqli_free_result($result03);
}
             
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query_ams_settings = "SELECT * FROM products WHERE categoryid = '8' AND userid = '$userid' ORDER by id DESC LIMIT 1";
$q = $pdo->prepare($query_ams_settings);
$q->execute(array());
$data = $q->fetch(PDO::FETCH_ASSOC); 
$lastsignmodhs = $data['upsign'];

if ($result012 = mysqli_query($con, "SELECT sum(total) as uptotal FROM products WHERE categoryid = '8' AND userid = '$userid' ORDER by id DESC LIMIT 1")) {
 
while ($row = mysqli_fetch_assoc($result012))
{ 
   $upprocducthorse =  $row['uptotal'];
}
    /* close result set */
    mysqli_free_result($result012);
}

$updownpercenths =  ($upprocducthorse / 100 * $procductshorse);  
$upprocducthorse_string = number_format($updownpercenths, 2);

if ($result03 = mysqli_query($con, "SELECT sum(total) as productstotal FROM products WHERE categoryid = '14' AND userid = '$userid'")) {
 
while ($row = mysqli_fetch_assoc($result03))
{ 
   $procductsheep =  $row['productstotal'];
   $procductsheep_string = number_format($procductsheep, 2);
}
    /* close result set */
    mysqli_free_result($result03);
}
             
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query_ams_settings = "SELECT * FROM products WHERE categoryid = '14' AND userid = '$userid' ORDER by id DESC LIMIT 1";
$q = $pdo->prepare($query_ams_settings);
$q->execute(array());
$data = $q->fetch(PDO::FETCH_ASSOC); 
$lastsignmodsp = $data['upsign'];

if ($result013 = mysqli_query($con, "SELECT sum(total) as uptotal FROM products WHERE categoryid = '14' AND userid = '$userid' ORDER by id DESC LIMIT 1")) {
 
while ($row = mysqli_fetch_assoc($result013))
{ 
   $upprocductsheep =  $row['uptotal'];
}
    /* close result set */
    mysqli_free_result($result013);
}

$updownpercentshp =  ($upprocductsheep / 100 * $procductsheep);  
$upprocductsheep_string = number_format($updownpercentshp, 2);

if ($result04 = mysqli_query($con, "SELECT sum(total) as productstotal FROM products WHERE categoryid = '15' AND userid = '$userid'")) {
 
while ($row = mysqli_fetch_assoc($result04))
{ 
   $procductpig =  $row['productstotal'];
   $procductpig_string = number_format($procductpig, 2);
}
    /* close result set */
    mysqli_free_result($result04);
}
             
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query_ams_settings = "SELECT * FROM products WHERE categoryid = '15' AND userid = '$userid' ORDER by id DESC LIMIT 1";
$q = $pdo->prepare($query_ams_settings);
$q->execute(array());
$data = $q->fetch(PDO::FETCH_ASSOC); 
$lastsignmodpg = $data['upsign'];

if ($result015 = mysqli_query($con, "SELECT sum(total) as uptotal FROM products WHERE categoryid = '15' AND userid = '$userid' ORDER by id DESC LIMIT 1")) {
 
while ($row = mysqli_fetch_assoc($result015))
{ 
   $upprocductpig =  $row['uptotal'];
}
    /* close result set */
    mysqli_free_result($result015);
}

$updownpercentpig =  ($upprocductsheep / 100 * $procductpig);  
$upprocductpig_string = number_format($updownpercentpig, 2);

$calculatedproductssum = ($procductscattle+$procductsgoats+$procductshorse+$procductsheep+$procductpig);

if ($result05 = mysqli_query($con, "SELECT sum(total) as productstotal FROM products WHERE userid = '$userid'")) {
 
while ($row = mysqli_fetch_assoc($result05))
{ 
   $procductall =  $row['productstotal'];
   $procductall_string = number_format($procductall, 2);
}
    /* close result set */
    mysqli_free_result($result05);
} 

if ($result66 = mysqli_query($con, "SELECT id FROM plaas_breeds ORDER BY id")) {

    /* determine number of rows result set */
    $row_cnt66 = mysqli_num_rows($result66);

    //printf("%d \n", $row_cnt);
    $cont66 = $row_cnt66;
    /* close result set */
    mysqli_free_result($result66);
}

if ($result70 = mysqli_query($con, "SELECT id FROM products WHERE userid = 
'$userid' ORDER BY id")) {

    /* determine number of rows result set */
    $row_cnt70 = mysqli_num_rows($result70);

    //printf("%d \n", $row_cnt);
    $cont70 = $row_cnt70;
    /* close result set */
    mysqli_free_result($result70);
}

$mainproductcount = (51 - $cont70);


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query_ams_settings = "SELECT * FROM products WHERE categoryid = '4' AND userid = '$userid' ORDER by id DESC LIMIT 1";
$q = $pdo->prepare($query_ams_settings);
$q->execute(array());
$data = $q->fetch(PDO::FETCH_ASSOC); 
$lastsignmodot = $data['upsign'];

$otherproducts = ($procductall - $calculatedproductssum);

$updownpercentall =  ($otherproducts / 100 * $procductall);  
$upprocductall_string = number_format($updownpercentall, 2);

    if ($usertype != 'public') {
    echo '<meta content="2;logout.php" http-equiv="refresh" />';
    }else{
    }
    MyData::disconnect();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Plaas | Farms Management System | Limited Proof of Extinction on the Blockchain: <?php echo !empty($userhashid)?$userhashid:''; ?></title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- ICO -->
    <link rel="icon" type="image/png" href="images/pic3.ico">
    
    <!-- Scrool bar -->
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
    border: 1px solid #7F5217;
}

::-webkit-scrollbar-track {
    border-radius: 10px;  
    background-color:#7F5217; 
}
</style> 
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="farmers-management-application.php" class="site_title"> <i class="fa fa-arrows"></i>   <span>P l a a s   </span> <i class="fa fa-arrows"></i></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/pic3.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Decentralized Farms </span>
                <h2 style="font-size: 100%;">Management System</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3 style="font-size: 60%;">Limited Proof of Extinction</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="farmers-management-application.php">Dashboard</a></li>
                      <li><a href="#plaas.php">Plaas Market</a></li> 
                    </ul>
                  </li>  
                  <li><a><i class="fa fa-pagelines"></i> Crops & Vegetables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#add_new_vegetable.php">Add Vegetables</a></li>
                      <li><a href="#crops_vegatablelist.php">List</a></li>
                      <li><a href="#crops_gallery.php">Gallery</a></li>
                      <li><a href="#seed_scout.php">Scout Seeds</a></li>
                      <li><a href="#seed_scout_findings.php">Scout Findings</a></li>
                      <li><a href="#other_seed_scout_findings.php">Seeds Finders</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-map-marker"></i> Farm & Locations<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="myfarm_add.php">Add</a></li>
                      <li><a href="myfarms.php">Farm List</a></li> 
                      <li><a href="#farmsearch.php">Scout Location</a></li>
                      <li><a href="#myfarmsearch.html">My Scouts</a></li> 
                    </ul>
                  </li>
                  <li><a><i class="fa fa-codepen"></i> Livestock <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu"> 
                        <li><a>Breed Listing<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="public_pure_breeds_display.php">Pure Breeds</a>
                            </li>
                            <li><a href="#animal_breed_cross_list.php">Cross Breed</a>
                            </li>
                            <li><a href="#animal_breed_hybreed_list.php">Hybrid</a>
                            </li>
                          </ul>
                        </li>  
                        <li><a href="#animal_gallery.php">Gallery</a></li>
                        <li><a href="#livestock_scout.php">Scout Livestock</a></li>
                        <li><a href="#livestock_scout_findings.php">Scout Findings</a></li>
                        <li><a href="#other_livestock_scout_findings.html">Livestock Finders</a></li>
                        </li>
                    </ul>
                  </li>  
                  <li><a><i class="fa fa-truck"></i> Products <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#myproducts_categories.php">Categories</a></li>
                      <li><a href="#myproducts.php">Product List</a></li>
                      <li><a href="public_products_display.php">Livestock</a></li>
                      <li><a href="#addmylifestock.php">Add Livestock</a></li>
                      <li><a href="#crops_vegatable.php">Crops & Vegetables</a></li>
                      <li><a href="#addcrops_vegatable.php">Add Crop / Vegetable</a></li> 
                    </ul>
                  </li>
                  <li><a><i class="fa fa-money"></i>Sales & Marketing <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#products_promo_sales.php">My Promo Sales</a></li> 
                      <li><a href="#products_local_sales.php">Local Sales</a></li>
                      <li><a href="#products_continent_sales.php">Continent Sales</a></li>
                      <li><a href="#products_world_sales.php">World Sales</a></li>
                      <li><a href="#products_sold_sales.php">Sold Products</a></li>
                    </ul>
                  </li> 
                  <li><a><i class="fa fa-book"></i>Suppliers<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#products_promo_sales.php">My Suppliers</a></li> 
                      <li><a href="#products_local_sales.php">New Supplier</a></li>
                      <li><a href="#products_continent_sales.php">Stock Sales</a></li> 
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live News & Updates</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-arrows"></i> Plaas Market <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#plaas_tokens.php">Tokens</a></li>
                      <li><a href="#plaas_estimations.php">Network Growth</a></li>
                      <li><a href="#plaas_investments.php">Investments</a></li> 
                    </ul>
                  </li>
                  <li><a><i class="fa fa-shopping-cart"></i> My Store <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#my_qoutation.php">Quotation</a></li>
                      <li><a href="#my_pre_order.php">Pre-Order</a></li>
                      <li><a href="#my_com_order.php">Comfimed Orders</a></li>
                      <li><a href="#livestock_dealers.php">Livestock Dealers</a></li>
                      <li><a href="#crop_veg_dealers.php">Crop & Vegetable Dealers</a></li>
                      <li><a href="#products_price_comparism.php">Price Comparism</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-files-o"></i> Reports & Printouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#my_farm_prints.php">Farms & Locations</a>
                        <li><a>Products<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="#my_livestock_print.php">Livestock</a>
                            </li>
                            <li><a href="#my_crops_veg_print.php">Crops & Vegatable</a>
                            </li>
                            <li><a href="#my_statistics_print.php">Statistics</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#my_sales_print.php">Sales</a>
                        <li><a href="#my_order_print.php">Order</a>
                        <li><a href="#my_sales_print.php">Sales</a>
                        </li>
                    </ul>
                  </li> 
                  <li><a><i class="fa fa-envelope"></i> Support <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu"> 
                      <li><a href="#help_contact.php">Help Desk</a></li>
                      <li><a href="#contacts.php">Contacts</a></li>
                      <li><a href="#plaas_faq.php">FAQ</a></li>
                    </ul>
                  </li>
                 </ul>
              </div>

            </div>
            <!-- /sidebar menu --> 
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i style="color: #C68E17;" class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?php
                    if ($pictu == '') {
                     ?>
                    <img src="images/user.png" alt="">Farmer
                    <span class=" fa fa-angle-down"></span>
                    <?php
                    }else{
                  ?>
                    <img src="images/<?php echo $pictu ?>" alt="">Farmer
                    <span class=" fa fa-angle-down"></span>
                  <?php
                  }
                  ?>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="farmer_user_profile.php"> Profile</a></li>
                    <li>
                      <a href="system_user_settings.php"> 
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
<?php
MyData::disconnect(); 
?>