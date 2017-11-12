<?php 
  include_once 'dbConfig.php';
  require_once 'signin-signup-connect/class.user.php';
  require_once 'signin-signup-connect/database.php';

  $productname = null;
  if ( !empty($_GET['pname'])) {
    $productname = $_REQUEST['pname'];
  }  

  $producttype = null;
  if ( !empty($_GET['pcatego'])) {
    $producttype = $_REQUEST['pcatego'];
  } 

  $producttotal = null;
  if ( !empty($_GET['ptotal'])) {
    $producttotal = $_REQUEST['ptotal'];
  } 

  $ownuser = null;
  if ( !empty($_GET['userid'])) {
    $ownuser = $_REQUEST['userid'];
  } 

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_products_statistics` WHERE name = '$productname'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $pptotal= $data['total']; 

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_products_statistics_user` WHERE name = '$productname' AND userid = '$ownuser'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $userpptotal= $data['total']; 
    MyData::disconnect();  

  $sumall = ($pptotal+$producttotal);
  $usersumall = ($userpptotal+$producttotal);
  $lastmod = date("Y-m-d H:i:s");

  if ( null==$productname ) {
   echo '<meta content="2;my_livestock_listing.php?livestock_add_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  }   

    $livesign = '+';
    $totaldcrss = '0';
/*
    echo "produt name : $productname";
    echo "produt sign : $livesign";
    echo "produt type : $producttype";
    echo "produt total : $producttotal";
*/
    $count=mysqli_query($con,"SELECT * FROM plaas_products_statistics WHERE name = '$productname'");
    if(mysqli_num_rows($count) < 1)
    {  
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $sql1 = "INSERT into plaas_products_statistics(name, updown, type, total, totalincrease, totaldecrease) VALUES (?, ?, ?, ?, ?, ?)";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($productname,$livesign,$producttype,$producttotal,$producttotal,$totaldcrss));     
    echo '<meta content="1;my_livestock_listing.php?livestock_add_sucess" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    } 
     else
      {        
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE plaas_products_statistics SET updown = ?, total = ?, totalincrease = ?, modified = ? WHERE name = ?";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($livesign,$sumall,$producttotal,$lastmod,$productname));      
    echo '<meta content="1;my_livestock_listing.php?livestock_add_sucess" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();  
      }

    $count1=mysqli_query($con,"SELECT * FROM plaas_products_statistics_user WHERE name = '$productname' AND  userid = '$ownuser'");
    if(mysqli_num_rows($count1) < 1)
    {  
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $sql1 = "INSERT into plaas_products_statistics_user(name, updown, type, total, totalincrease, totaldecrease, userid) VALUES (?, ?, ?, ?, ?, ?, ?)";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($productname,$livesign,$producttype,$producttotal,$producttotal,$totaldcrss,$ownuser));     
    echo '<meta content="1;my_livestock_listing.php?livestock_add_sucess" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    } 
     else
      {        
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE plaas_products_statistics_user SET updown = ?, total = ?, totalincrease = ?, modified = ? WHERE name = ? AND userid = ?";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($livesign,$usersumall,$producttotal,$lastmod,$productname,$ownuser));      
    echo '<meta content="1;my_livestock_listing.php?livestock_add_sucess" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();  
      }

?>    