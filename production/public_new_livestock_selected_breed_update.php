<?php
  require_once 'main_public.php'; 

  $product_id = null;
  if ( !empty($_GET['product_id'])) {
    $product_id = $_REQUEST['product_id'];
  } 

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `products` WHERE id = '$product_id'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $uniqueid= $data['uniqueid'];
    $chipid= $data['chipid'];
    $tagid= $data['tagid'];
    $color= $data['color'];
    $sex= $data['sex'];
    $dob= $data['dob'];
    $image= $data['image'];
    $categoryid= $data['categoryid'];
    $userid= $data['userid'];
    $farmID= $data['farmID'];
    $breedId= $data['breedId'];
    $selectedbreed= $data['selectedbreed'];
    $youngone= $data['youngone'];
    $relationship= $data['relationship'];
    $total= $data['total'];
    $upsign= $data['upsign'];
    $productsize= $data['productsize'];
    $modified= $data['modified'];

    $sql = "SELECT * FROM `products` WHERE id = '$youngone'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $mofaki= $data['tagid'];
    $mofaid= $data['chipid'];

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_breeds` WHERE id = '$breedId'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $categoname= $data['categoryid'];
    $bredname= $data['name'];

    $sql = "SELECT * FROM `plaas_animal_sex` WHERE id = '$sex'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $psex= $data['sex'];

    $sql = "SELECT * FROM `plaas_accounts` WHERE id = '$userid'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $powner= $data['email_address'];

    $sql = "SELECT * FROM `plaas_data_farm` WHERE farmID = '$farmID'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $pfmowner= $data['farmname'];
    $pcowner= $data['country'];

    $sql = "SELECT * FROM `categories` WHERE id = '$categoname'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $categonamea= $data['name'];
    $dispcatetype = $data['category'];

  /*if ( null==$mypurebreedid ) {
   echo '<meta content="2;add_new_livestock.php?selection_id_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  }*/

    $liveuniqueidsel=md5($country). rand(9000, 20080) . 'PL' . time() . 'S';
    $livetaggaingsel=rand(1000, 200) . 'PL' . time() . 'S';
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
                <h3><?php echo !empty($bredname)?$bredname:''; ?> <small> product updates</small> </h3>
              </div>
              <?php
               require_once 'search.php';
              ?>
            </div>

            <div class="clearfix"></div>
                  <?php
                    if(isset($_GET['uknown_add_error']))
                       {  
                        $msgcx = "
                         <div class='alert form-group has-feedback' style='  color: #000C2C; background-color: #E77471; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Unkown !</strong>  Unkwon error occured.
                         </div>
                         ";    
                       }

                    if(isset($_GET['upudate_success']))
                       {  
                        $msgcx = "
                         <div class='alert form-group has-feedback' style='  color: #000C2C; background-color: #99C68E;; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Comfirmation !</strong> product $chipid successfully updated.
                         </div>
                         ";    
                       }
                   ?>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo !empty($tagid)?$tagid:''; ?> <small> <a href="public_products_display.php">Products</a> <i class="fa fa-chevron-right"></i> <?php echo '<a href="public_products_display_by_category.php?categoryname='. $categoname .'&user_key=<?php echo $userhashid?>">'?> <?php echo !empty($categonamea)?$categonamea:''; ?> selection <?php echo '</a>'?> <i class="fa fa-chevron-right"></i> <b><a href="#"><?php echo !empty($bredname)?$bredname:''; ?></a></b></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="public_products_display.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-list"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <?php if(isset($msgcx)) echo $msgcx;  ?> 
                    <form class="form-horizontal form-label-left input_mask" method="POST">  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Tracking chip identification number attached the product" type="text" style="width: 100%;" name="prcid" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Tracking chip identification number attached the product" value="<?php echo !empty($chipid)?$chipid:''; ?>">
                        <span class="fa fa-sliders form-control-feedback left" aria-hidden="true"></span>
                      </div>   
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea data-toggle="tooltip" title="Tag or branding identification number attached the product" rows="3" style="width: 100%;" name="prtid" class="resizable_textarea form-control" placeholder="Tag or branding identification number attached the product"><?php echo !empty($tagid)?$tagid:''; ?></textarea>
                       </div>
                      </div>  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Product size in <?php echo !empty($weightname)?$weightname:''; ?> | <?php echo !empty($weightsymbol)?$weightsymbol:''; ?>" type="text" style="width: 100%;" name="prsiz" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Product size in <?php echo !empty($weightname)?$weightname:''; ?> | <?php echo !empty($weightsymbol)?$weightsymbol:''; ?>" value="<?php echo !empty($productsize)?$productsize:''; ?>">
                        <span class="fa fa-anchor form-control-feedback left" aria-hidden="true"></span>
                      </div>  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Product color" type="text" style="width: 100%;" name="prcol" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Product color" value="<?php echo !empty($color)?$color:''; ?>">
                        <span class="fa fa-spinner form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_animal_sex WHERE categoryid = '$categoname'";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Maturity selection" style="width: 100%;" class="form-control" name="prsex" id="inputEmail3">
                       <option value="<?php echo !empty($sex)?$sex:''; ?>"><?php echo !empty($psex)?$psex:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['sex']?></option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >  
                       <?php  
                        $query="SELECT * FROM products WHERE categoryid = '$categoname' AND userid = '$userid'";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Select birth chain (Mother, Father, Young one)" style="width: 100%;" class="form-control" name="prbrthch" id="inputEmail3">
                        <option value="<?php echo !empty($youngone)?$youngone:''; ?>"><?php echo !empty($mofaki)?$mofaki:''; ?> - <?php echo !empty($mofaid)?$mofaid:''; ?></option>
                        <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <option value=<?php echo $row['id']?>><?php echo $row['tagid']?> - <?php echo $row['chipid']?></option>
                        <?php } ?>
                       </select> 
                      </div>   
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >   
                       <select data-toggle="tooltip" title="selected product relationship" style="width: 100%;" class="form-control" name="prbrtrl" id="inputEmail3">
                        <option value="<?php echo !empty($relationship)?$relationship:''; ?>">-<?php echo !empty($relationship)?$relationship:''; ?></option> 
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option> 
                        <option value="other">other</option> 
                       </select> 
                      </div>   
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Product date of birth" type="date" style="width: 100%;" name="prdob" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Product date of birth" value="<?php echo !empty($dob)?$dob:''; ?>">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >  
                       <?php  
                        $query="SELECT * FROM plaas_accounts WHERE id = '$userid'";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Select Refernece" style="width: 100%;" class="form-control" name="userid" onChange="getUser(this.value)" id="inputEmail3">
                        <option value="<?php echo !empty($userid)?$userid:''; ?>"><?php echo !empty($powner)?$powner:''; ?></option>
                        <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <option value=<?php echo $row['id']?>><?php echo $row['email_address']?></option>
                        <?php } ?>
                       </select> 
                      </div> 
                      <div id="statediv" class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >  
                       <select data-toggle="tooltip" title="Product location" style="width: 100%;" class="form-control" name="state" id="inputEmail3">
                       <option value="<?php echo !empty($farmID)?$farmID:''; ?>"><?php echo !empty($pfmowner)?$pfmowner:''; ?> - <?php echo !empty($pcowner)?$pcowner:''; ?></option> 
                       </select> 
                      </div>    
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Total number of product(s)" type="number" style="width: 100%;" name="prtot" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Total number of product(s)" value="<?php echo !empty($total)?$total:''; ?>">
                        <span class="fa fa-calculator form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br> 
  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" name="savecat" class="btn btn-dark" style="width: 32%;">Update</button> 
                        </div>
                      </div> 

                    </form>
                    <hr>
                    <div class="clearfix"></div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content --> 

<?php
  require_once 'footer.php';

  include_once 'dbConfig.php';
  if(isset($_POST['savecat']))
   {  
    $livechip=$_POST['prcid']; 
    $livetag=$_POST['prtid']; 
    $livecolor=$_POST['prcol']; 
    $livesex=$_POST['prsex'];  
    $livedob=$_POST['prdob'];  
    $liveuser=$_POST['userid'];  
    $livefarmid=$_POST['state'];   
    $liveyoung=$_POST['prbrthch']; 
    $liverelation=$_POST['prbrtrl']; 
    $livetotal=$_POST['prtot'];  
    $productsize =$_POST['prsiz'];
    $lastmod = date("Y-m-d H:i:s");
              

 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE products SET chipid = ?, tagid = ?, color = ?, sex = ?, dob = ?, userid = ?, farmID = ?, youngone = ?, relationship = ?, total = ?, productsize = ?, modified = ? WHERE id = ?";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($livechip,$livetag,$livecolor,$livesex,$livedob,$liveuser,$livefarmid,$liveyoung,$liverelation,$livetotal,$productsize,$lastmod,$product_id)); 
      echo '<meta content="2;public_new_livestock_selected_breed_update.php?pname='. $categonamea .'&pcatego='. $dispcatetype .'&ptotal='. $livetotal .'&userid='. $liveuser .'&product_id='. $product_id .'" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();  
   }
?>    