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
    
    $stmt = $user_home->runQuery("SELECT * FROM plaas_countries WHERE name =:coun");
    $stmt->execute(array(":coun"=>$country));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    $currencyname = $row['currency'];
    $countrycode = $row['callcode'];
    $coucontinent=$row['continent'];
    
    if ($usertype != 'public') {
    echo '<meta content="2;logout.php" http-equiv="refresh" />';
    }else{
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Plaas | Farmer Management System | Proof of Extinction on the Blockchain: <?php echo !empty($userhashid)?$userhashid:''; ?></title>

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
    border: 2px solid #7F5217;
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
              <a href="index.html" class="site_title"> <i class="fa fa-arrows"></i>   <span>P l a a s   </span> <i class="fa fa-arrows"></i></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/pic3.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Decentralized Famers </span>
                <h2 style="font-size: 100%;">Management System</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3 style="font-size: 60%;">Proof of Extinction on the Blockchain</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php">Dashboard</a></li>
                      <li><a href="plaas.php">Plaas Market</a></li> 
                    </ul>
                  </li>
                  <li><a><i class="fa fa-map-marker"></i> Farm & Locations<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="myfarms.php">Farm List</a></li>
                      <li><a href="myfarmadd.php">Add Farm</a></li>
                      <li><a href="farmsearch.php">Scout Location</a></li>
                      <li><a href="myfarmsearch.html">My Scouts</a></li> 
                    </ul>
                  </li>
                  <li><a><i class="fa fa-truck"></i> Products <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="myproducts.php">Product List</a></li>
                      <li><a href="mylivestock.php">Livestock</a></li>
                      <li><a href="addmylifestock.php">Add Livestock</a></li>
                      <li><a href="crops_vegatable.php">Crops & Vegetables</a></li>
                      <li><a href="addcrops_vegatable.php">Add Crop / Vegetable</a></li> 
                    </ul>
                  </li>
                  <li><a><i class="fa fa-codepen"></i> Livestock <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="animal_list.php">List</a></li>
                      <li><a href="animal_gallery.php">Gallery</a></li>
                      <li><a href="livestock_scout.php">Scout Livestock</a></li>
                      <li><a href="livestock_scout_findings.php">Scout Findings</a></li>
                      <li><a href="other_livestock_scout_findings.html">Livestock Finders</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-yelp"></i> Crops & Vegetables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="crops_vegatablelist.php">List</a></li>
                      <li><a href="crops_gallery.php">Gallery</a></li>
                      <li><a href="seed_scout.php">Scout Seeds</a></li>
                      <li><a href="seed_scout_findings.php">Scout Findings</a></li>
                      <li><a href="other_seed_scout_findings.php">Seeds Finders</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-money"></i>Sales & Marketing <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="products_promo_sales.php">My Promo Sales</a></li>
                      <li><a href="products_continent_sales.php">Continent Sales</a></li>
                      <li><a href="products_local_sales.php">Local Sales</a></li>
                      <li><a href="products_continent_sales.php">Continent Sales</a></li>
                      <li><a href="products_world_sales.php">World Sales</a></li>
                      <li><a href="products_sold_sales.php">Sold Products</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live News & Updates</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-arrows"></i> Plaas Market <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="plaas_tokens.php">Tokens</a></li>
                      <li><a href="plaas_estimations.php">Network Growth</a></li>
                      <li><a href="plaas_investments.php">Investments</a></li>
                      <li><a href="contacts.php">Contacts</a></li>
                      <li><a href="plaas_faq.php">FAQ</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-shopping-cart"></i> My Store <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-files-o"></i> Report & Printouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
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
                    <img src="images/img.jpg" alt="">farmer
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
