<?php
    require_once 'main.php'; 

  if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
   $pid = null;
    if ( !empty($_GET['id'])) {
    $pid = $_REQUEST['id'];
   }

    $succd = 'cat_sucess_delete';
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlz = "SELECT * FROM `plaas_product_images` WHERE eid = '$pid'";
    $qz = $pdo->prepare($sqlz);
    $qz->execute(array());
    $data = $qz->fetch(PDO::FETCH_ASSOC); 
    $ppid = $data['id'];

    $sql = "SELECT * FROM `products` WHERE id = '$ppid'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $prproductIuniqueid = $data['uniqueid']; 

    $sql = "DELETE FROM `plaas_product_images` WHERE eid = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="0;main_product_display_information.php?productid='. $ppid .'&productIuniqueid='. $prproductIuniqueid .'&gallery_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 

    $productIuniqueid = null;
    if ( !empty($_GET['productIuniqueid'])) {
    $productIuniqueid = $_REQUEST['productIuniqueid'];
    }

    $productid = null;
    if ( !empty($_GET['productid'])) {
    $productid = $_REQUEST['productid'];
    }

error_reporting(E_ALL & ~E_NOTICE);
@ini_set('post_max_size', '64M');
@ini_set('upload_max_filesize', '64M');

/* * *********************************************** */
// database constants
define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE', 'api_plaas');

$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}


if (isset($_POST["sub1"])) {
  // include resized library
  require_once('php-image-magician/php_image_magician.php');
  $msg = ""; 
  $emsg = "";
  $valid_image_check = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/bmp");
  if (count($_FILES["user_files"]) > 0) {
    $folderName = "uploads/";

    $sql = "INSERT INTO plaas_product_images(image_name, id) VALUES (:img, $productid)";
    $stmt = $DB->prepare($sql);

    for ($i = 0; $i < count($_FILES["user_files"]["name"]); $i++) {

      if ($_FILES["user_files"]["name"][$i] <> "") {

        $image_mime = strtolower(image_type_to_mime_type(exif_imagetype($_FILES["user_files"]["tmp_name"][$i])));
        // if valid image type then upload
        if (in_array($image_mime, $valid_image_check)) {

          $ext = explode("/", strtolower($image_mime));
          $ext = strtolower(end($ext));
          $filename = rand(10000, 990000) . '_' . time() . '.' . $ext;
          $filepath = $folderName . $filename;

          if (!move_uploaded_file($_FILES["user_files"]["tmp_name"][$i], $filepath)) {
            $emsg .= "Failed to upload <strong>" . $_FILES["user_files"]["name"][$i] . "</strong>. <br>";
            $counter++;
          } else {
            $smsg .= "<strong>" . $_FILES["user_files"]["name"][$i] . "</strong> uploaded successfully. <br>";

            $magicianObj = new imageLib($filepath);
            $magicianObj->resizeImage(130, 100);
            $magicianObj->saveImage($folderName . 'thumb/' . $filename, 100);

            /*             * ****** insert into database starts ******** */
            try {
              $stmt->bindValue(":img", $filename);
              $stmt->execute();
              $result = $stmt->rowCount();
              if ($result > 0) {
                // file uplaoded successfully.
              } else {
                // failed to insert into database.
              }
            } catch (Exception $ex) {
              $emsg .= "<strong>" . $ex->getMessage() . "</strong>. <br>";
            }
            /*             * ****** insert into database ends ******** */
          }
        } else {
          $emsg .= "<strong>" . $_FILES["user_files"]["name"][$i] . "</strong> not a valid image. <br>";
        }
      }
    } 

    $msg = "Product picture successfully";
    echo '<meta content="1;main_product_display_information.php?productid='. $productid .'&productIuniqueid='. $productIuniqueid .'" http-equiv="refresh" />';
    //$msg .= (strlen($smsg) > 0) ? successMessage($smsg) : "";
    //$msg .= (strlen($emsg) > 0) ? errorMessage($emsg) : "";
  } else {
    $msg = errorMessage("You must upload atleast one file");
  }
} 


    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `products` WHERE id = '$productid' AND uniqueid = '$productIuniqueid'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);  
    $productsex = $data['sex'];
    $produshwage = $data['dob'];
    $produsuniqueid= $data['uniqueid'];
    $produsrelationship= $data['relationship'];
    $producolor= $data['color'];
    $produshwbrd = $data['breedId'];
    $produshwimg = $data['image'];
    $produser= $data['userid'];
    $produfarmID= $data['farmID'];
    $produtagid= $data['tagid'];
    $produtyoungone= $data['youngone'];
    $produtotal= $data['total'];
    $produproductsize= $data['productsize'];
    $producate= $data['categoryid'];
    $produselectedbreed = $data['selectedbreed'];
    $produshwcrd = date("Y-m-d");

   $query_ams_setting7 = "SELECT * FROM plaas_accounts WHERE id = '$produser'";
   $q7 = $pdo->prepare($query_ams_setting7);
   $q7->execute(array());
   $data = $q7->fetch(PDO::FETCH_ASSOC); 
   $premail_address= $data['email_address'];

   $query_ams_setting6 = "SELECT * FROM products WHERE youngone = '$produtyoungone'";
   $q6 = $pdo->prepare($query_ams_setting6);
   $q6->execute(array());
   $data = $q6->fetch(PDO::FETCH_ASSOC); 
   $prprodutagid = $data['tagid'];
   $prprodusuniqueid= $data['uniqueid'];

   $query_ams_setting5 = "SELECT * FROM plaas_user_setings WHERE userid = '$produser'";
   $q5 = $pdo->prepare($query_ams_setting5);
   $q5->execute(array());
   $data = $q5->fetch(PDO::FETCH_ASSOC); 
   $metricidname = $data['metricid'];

    $query_ams_settings = "SELECT * FROM plaas_mass WHERE id = '$metricidname'";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $metricname = $data['name']; 
    $metricsymbol = $data['sysmbol']; 
              
   $query_ams_setting4 = "SELECT * FROM plaas_animal_sex WHERE id = '$productsex'";
   $q4 = $pdo->prepare($query_ams_setting4);
   $q4->execute(array());
   $data = $q4->fetch(PDO::FETCH_ASSOC); 
   $productsexname = $data['sex'];
              
   $query_ams_setting3 = "SELECT * FROM plaas_data_farm WHERE farmID = '$produfarmID'";
   $q3 = $pdo->prepare($query_ams_setting3);
   $q3->execute(array());
   $data = $q3->fetch(PDO::FETCH_ASSOC); 
   $farmIDname = $data['farmname'];
              
   $query_ams_setting = "SELECT * FROM categories WHERE id = '$producate'";
   $qe = $pdo->prepare($query_ams_setting);
   $qe->execute(array());
   $data = $qe->fetch(PDO::FETCH_ASSOC); 
   $categoryname = $data['name'];
   $categoryicon = $data['icon'];
              
   $query_ams_setting1 = "SELECT * FROM $produselectedbreed WHERE id = '$produshwbrd'";
   $qq = $pdo->prepare($query_ams_setting1);
   $qq->execute(array());
   $data = $qq->fetch(PDO::FETCH_ASSOC); 
   $categorybreedname = $data['name'];
   $categorybreedicon = $data['icon'];
 
   $diff = abs(strtotime($produshwcrd) - strtotime($produshwage));

   $years = floor($diff / (365*60*60*24));
   $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
   $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
              
 $query_ams_setting2 = "SELECT * FROM plaas_product_images WHERE id = '$productid' ORDER BY eid DESC";
   $q2 = $pdo->prepare($query_ams_setting2);
   $q2->execute(array());
   $data = $q2->fetch(PDO::FETCH_ASSOC); 
   $productidpicture = $data['image_name'];

if ($resultkids = mysqli_query($con, "SELECT id FROM products WHERE youngone = '$productid' ORDER BY id")) {

    /* determine number of rows result set */
    $row_cntkids = mysqli_num_rows($resultkids);

    //printf("%d \n", $row_cnt);
    $contkids = $row_cntkids;
    /* close result set */
    mysqli_free_result($resultkids);
}
    MyData::disconnect(); 

if ( $productid=='') {
    echo '<meta content="2;main_products_display.php?error_operation" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  }

  if ( $productIuniqueid=='') {
    echo '<meta content="2;main_products_display.php?error_operation" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  }


?>
<script language="javascript" type="text/javascript">
function getXMLHTTP() {
    var xmlhttp=false;  
    try{
      xmlhttp=new XMLHttpRequest();
    }
    catch(e)  {   
      try{      
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e){
        try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e1){
          xmlhttp=false;
        }
      }
    }
      
    return xmlhttp;
    }
  
  function getUser(useridId) {    
    
    var strURL="findUser.php?userid="+useridId;
    var req = getXMLHTTP();
    
    if (req) {
      
      req.onreadystatechange = function() {
        if (req.readyState == 4) {
          // only if "OK"
          if (req.status == 200) {            
            document.getElementById('statediv').innerHTML=req.responseText;         
          } else {
            alert("Problem while using XMLHTTP:\n" + req.statusText);
          }
        }       
      }     
      req.open("GET", strURL, true);
      req.send(null);
    }   
  } 
</script>
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Livestock : <?php echo !empty($categoryname)?$categoryname:''; ?> <img style="width: 5%;" src="images/<?php echo !empty($categoryicon)?$categoryicon:''; ?>"></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <span style="font-size: 100%;"><a href="index.php">Home</a> <i class="fa fa-arrow-circle-right"></i><a href="main_products_display.php"> Products</a> <i style="color: red;" class="fa fa-map-marker"></i> <a href="#"><?php echo !empty($farmIDname)?$farmIDname:''; ?></a>  <span style="color: #000; font-size: 100%; font-weight: bold;"><i class="fa fa-arrow-circle-right"></i> <?php echo !empty($productIuniqueid)?$productIuniqueid:''; ?></span></span>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div> 
                  <?php if(isset($smsg)) echo $smsg;  ?> 
                  <?php if(isset($emsg)) echo $emsg;  ?>  
                  <div class="x_content">

                    <div class="col-md-7 col-sm-7 col-xs-12"> 
                      <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm"><div class="product-image">
                        <img class="img-responsive" src="uploads/<?php echo !empty($productidpicture)?$productidpicture:''; ?>" alt=" Product Picture" />
                      </div> </a>
                      <?php    
                       $pdo = MyData::connect(); 
                       $sql = "SELECT * FROM plaas_product_images WHERE id = '$productid' ORDER BY eid DESC LIMIT 8";
                       foreach ($pdo->query($sql) as $row) {     
                        $imageid = $row['eid'];
                        $imageimage_name = $row['image_name'];
                      ?>
                      <div class="product_gallery img-responsive">
                        <a onclick="deleteProductImage(<?php echo $row['eid']; ?>);" href="javascript:;" data-toggle="tooltip" title="Delete Image ID <?php echo $row['eid']; ?>" style="color: red;">
                          <img style="margin-top: 3%;" class="img-responsive" src="uploads/thumb/<?php echo !empty($imageimage_name)?$imageimage_name:''; ?>" alt="..." />
                        <caption><i class="fa fa-trash-o"></i> Delete</caption> 
                        </a> 
                      </div>
                     <?php
                     }
                     MyData::disconnect();
                    ?>  
                    </div>
                    <br>

                    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5; color: #000;">

                      <h3 style="font-weight: bold; margin-top: 5%;" class="prod_title"><i class="fa fa-tags"></i> <?php echo !empty($produtagid)?$produtagid:''; ?></h3>

                      <p><i class="fa fa-adjust"></i> Breed: <?php echo !empty($categorybreedname)?$categorybreedname:''; ?></p>
                      <p><i class="fa fa-calendar"></i> Date Of Birth: <?php echo !empty($produshwage)?$produshwage:''; ?></p>
                      <p><i class="fa fa-bullseye"></i> Maturity: <?php echo !empty($productsexname)?$productsexname:''; ?></p>
                      <p><i class="fa fa-spinner"></i> Color: <?php echo !empty($producolor)?$producolor:''; ?></p>
                      <p><i class="fa fa-bars"></i> Age: <?php printf("%d years, %d months, %d days\n", $years, $months, $days); ?></p>
                      <p><i class="fa fa-calculator"></i> Count: <?php echo !empty($produtotal)?$produtotal:''; ?></p> 
                          <?php
                          if ($contkids == '') {
                            ?>
                      <p style="font-weight: bold;"><i class="fa fa-crosshairs"></i> NO Of Young Ones: 0</p> 
                          <?php
                          }else{
                            ?> 
                      <p style="font-weight: bold;"><i class="fa fa-crosshairs"></i> NO Of Young Ones: <?php echo !empty($contkids)?$contkids:''; ?></p>
                       <?php
                        $pdo = MyData::connect(); 
                        $sql = "SELECT * FROM products WHERE youngone = '$productid' order by id DESC LIMIT 10";
                        foreach ($pdo->query($sql) as $row) {   
                        $manimalID = $row['id'];   
                        $mtagID = $row['tagid'];    
                        $mentryuniqueid = $row['uniqueid'];    
                        ?>
                        </i> 
                        <?php echo '<a href="main_product_display_information.php?productid='. $row['id'].'&productIuniqueid='.$row['uniqueid'].'">'?><p><i class="fa fa-check-square" style="font-size: 100%; color: #2B1B17;"> </i> </i> <?php echo !empty($mentryuniqueid)?$mentryuniqueid:'';?></p><?php echo '</a>'?>
                        <?php
                        }
                       }
                        MyData::disconnect();
                        ?>

                      <div class="">
                        <div class="product_price">
                          <h2 class="price"><i class="fa fa-anchor"></i> Weight</h2>
                          <span class="price-tax"><?php echo !empty($produproductsize)?$produproductsize:''; ?> <?php echo !empty($metricname)?$metricname:''; ?> (<?php echo !empty($metricsymbol)?$metricsymbol:''; ?>)</span>
                          <br>
                        </div>
                      </div>

                      <div class="">
                        <button type="button" class="btn btn-dark"><i class="fa fa-shopping-cart"></i> Advertise</button>
                        <button type="button" class="btn btn-default"><i class="fa fa-gavel"></i> Auction</button>
                        <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Remove</button>
                      </div> 

                    </div>


                    <div class="col-md-12" style="margin-top: 2%;">

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Details</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Vaccination</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Blood Line</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            
                    <form class="form-horizontal form-label-left input_mask" method="POST">  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Tracking chip identification number attached the product" type="text" style="width: 100%;" name="prcid" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Tracking chip identification number attached the product" value="<?php echo !empty($produsuniqueid)?$produsuniqueid:''; ?>">
                        <span class="fa fa-sliders form-control-feedback left" aria-hidden="true"></span>
                      </div>   
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea data-toggle="tooltip" title="Tag or branding identification number attached the product" rows="3" style="width: 100%;" name="prtid" class="resizable_textarea form-control" placeholder="Tag or branding identification number attached the product"><?php echo !empty($produtagid)?$produtagid:''; ?></textarea>
                       </div>
                      </div>  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Product size in <?php echo !empty($weightname)?$weightname:''; ?> | <?php echo !empty($weightsymbol)?$weightsymbol:''; ?>" type="text" style="width: 100%;" name="prsiz" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Product size in <?php echo !empty($weightname)?$weightname:''; ?> | <?php echo !empty($weightsymbol)?$weightsymbol:''; ?>" value="<?php echo !empty($produproductsize)?$produproductsize:''; ?>">
                        <span class="fa fa-anchor form-control-feedback left" aria-hidden="true"></span>
                      </div>  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Product color" type="text" style="width: 100%;" name="prcol" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Product color" value="<?php echo !empty($producolor)?$producolor:''; ?>">
                        <span class="fa fa-spinner form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_animal_sex WHERE categoryid = '$producate'";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Maturity selection" style="width: 100%;" class="form-control" name="prsex" id="inputEmail3">
                       <option value="<?php echo !empty($productsex)?$productsex:''; ?>"><?php echo !empty($productsexname)?$productsexname:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['sex']?></option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >  
                       <?php  
                        $query="SELECT * FROM products WHERE categoryid = '$producate'";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Mother Or Father" style="width: 100%;" class="form-control" name="prbrthch" id="inputEmail3">
                        <option value="<?php echo !empty($produtyoungone)?$produtyoungone:''; ?>"><?php echo !empty($prprodutagid)?$prprodutagid:''; ?> - <?php echo !empty($prprodusuniqueid)?$prprodusuniqueid:''; ?></option>
                       <option value=""></option>
                        <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <option value=<?php echo $row['id']?>><?php echo $row['tagid']?> - <?php echo $row['chipid']?></option>
                        <?php } ?>
                       </select> 
                      </div>   
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >   
                       <select data-toggle="tooltip" title="selected product relationship" style="width: 100%;" class="form-control" name="prbrtrl" id="inputEmail3">
                        <option value="<?php echo !empty($produsrelationship)?$produsrelationship:''; ?>"><?php echo !empty($produsrelationship)?$produsrelationship:''; ?></option> 
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option> 
                        <option value="other">other</option> 
                       <option value=""></option>
                       </select> 
                      </div>   
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Product date of birth" type="date" style="width: 100%;" name="prdob" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Product date of birth" value="<?php echo !empty($produshwage)?$produshwage:''; ?>">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >  
                       <?php  
                        $query="SELECT * FROM plaas_accounts";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Select Product Owner" style="width: 100%;" class="form-control" name="userid" onChange="getUser(this.value)" id="inputEmail3">
                        <option value="<?php echo !empty($produser)?$produser:''; ?>"><?php echo !empty($premail_address)?$premail_address:''; ?></option>
                        <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <option value=<?php echo $row['id']?>><?php echo $row['email_address']?></option>
                        <?php } ?>
                       </select> 
                      </div> 
                      <div id="statediv" class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >  
                       <select data-toggle="tooltip" title="Product location" style="width: 100%;" class="form-control" name="state" id="inputEmail3">
                       <option value="<?php echo !empty($produfarmID)?$produfarmID:''; ?>"><?php echo !empty($farmIDname)?$farmIDname:''; ?></option> 
                       </select> 
                      </div>  <br><br> 
  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" name="savecat" class="btn btn-dark" style="width: 32%;">Update</button> 
                        </div>
                      </div> 

                    </form>
                    <hr>
                    <div class="clearfix"></div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <p>Vaccine</p>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p>Relashionship </p>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<script type="text/javascript">
  function deleteProductImage(Id){
    var iAnswer = confirm("Are you sure to delete selected image?"); 
  if(iAnswer){
    window.location = 'main_product_display_information.php?id=' + Id;
  }
  }
  
  $( document ).ready(function() {
  setTimeout(function() {
      $("#me").hide(300);
      $("#you").hide(300);
  }, 3000);
});
</script>

<?php
  require_once 'footer.php';
?>    
 
                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><?php echo !empty($produtagid)?$produtagid:''; ?></h4>
                        </div>
                        <div class="modal-body">
                          <h4>Change product picture</h4>
                          <img class="img-responsive" src="uploads/<?php echo !empty($productidpicture)?$productidpicture:''; ?>" alt=" Product Picture" />
        <article>
          <?php echo $msg; ?>
          <div class="height20"></div>
          <div style="width: 100%; margin: 0 auto;"> 
            <form name="f1" method="post" enctype="multipart/form-data">            
              <fieldset>
                <legend><?php echo $_data['apart_sig']; ?></legend>
                <?php echo $_data['apart_multh']; ?>
                <input class="files form-control border-input" required="true" name="user_files[]" type="file" multiple="multiple" >
                <div class="height10"></div>
                <br>
                <div><input type="submit" class="btn btn-dark" name="sub1" value="Upload Image" /> </div>
              </fieldset> 
            </form> 
          </div>  
        </article> 
                        </div>
                        <div class="modal-footer">
                          <button type="button" style="color: red; font-weight: bold;" class="btn btn-default" data-dismiss="modal">Cancel</button> 
                        </div>

                      </div>
                    </div>
                  </div>