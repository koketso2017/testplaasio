<?php
  require_once 'main.php';
  
  $animalid = null;
  if ( !empty($_GET['animal_id'])) {
    $animalid = $_REQUEST['animal_id'];
  }

  if ( null==$animalid ) {
   echo '<meta content="2;animal_breed_hybreed_list.php?animal_idupd_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  } 

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_hy_breeds` WHERE id = '$animalid'";
    $q = $pdo->prepare($sql);
    $q->execute(array($animalid));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $animalname = $data['name'];
    $animalcategory = $data['categoryid'];
    $animalproduct=$data['productiontype'];
    $animalorigin=$data['countryoforigin']; 
    $animaldescription=$data['description']; 
    $animalicon=$data['icon'];  
    $breeda = $data['cross_a'];
    $breedb = $data['cross_b'];
    $breedc = $data['cross_c'];

  
    $query_ams_settings = "SELECT * FROM plaas_countries WHERE id = '$animalorigin'";
    $qs = $pdo->prepare($query_ams_settings);
    $qs->execute(array());
    $data = $qs->fetch(PDO::FETCH_ASSOC); 
    $countrytname = $data['name'];

  
    $query_ams_setting = "SELECT * FROM categories WHERE id = '$animalcategory'";
    $qc = $pdo->prepare($query_ams_setting);
    $qc->execute(array());
    $data = $qc->fetch(PDO::FETCH_ASSOC); 
    $categoryname = $data['name'];
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settingx = "SELECT * FROM plaas_breeds WHERE id = '$breeda'";
    $qx = $pdo->prepare($query_ams_settingx);
    $qx->execute(array());
    $data = $qx->fetch(PDO::FETCH_ASSOC); 
    $breadaname = $data['name']; 
          
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settingr = "SELECT * FROM plaas_breeds WHERE id = '$breedb'";
    $qr = $pdo->prepare($query_ams_settingr);
    $qr->execute(array());
    $data = $qr->fetch(PDO::FETCH_ASSOC); 
    $breadbname = $data['name']; 
          
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settingv = "SELECT * FROM plaas_cross_breeds WHERE id = '$breedc'";
    $qv = $pdo->prepare($query_ams_settingv);
    $qv->execute(array());
    $data = $qv->fetch(PDO::FETCH_ASSOC); 
    $breadcname = $data['name']; 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo !empty($animalname)?$animalname:''; ?> <small> <span aria-hidden="true"><img src="images/<?php echo $animalicon ?>" class="img-rounded" width="10%;" height="10%"></span> product update</small></h3>
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

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Livestock <small>animal | purpose | production</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="animal_breed_hybreed_list.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <?php
                    if(isset($_GET['breed_sucess_update']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #99C68E; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Breed - $animalname !</strong>  successfully updated.
                         </div>
                         ";    
                       }
                      ?>

                  <div class="x_content"> 
                   <?php if(isset($msgcx)) echo $msgcx;  ?>
                    <form class="form-horizontal form-label-left input_mask" method="POST"> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Breed name" style="width: 100%;" name="brename" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Breed name" value="<?php echo !empty($animalname)?$animalname:''; ?>">
                        <span class="fa fa-bullseye form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM categories WHERE category = 'Livestock'";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Livestock Category" style="width: 100%;" required="true" class="form-control" name="brecat" id="inputEmail3">
                       <option value="<?php echo !empty($animalcategory)?$animalcategory:''; ?>"><?php echo !empty($categoryname)?$categoryname:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_breeds";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Crossed breed A" style="width: 100%;" required="true" class="form-control" name="crobrea" id="inputEmail3">
                       <option value="<?php echo !empty($breeda)?$breeda:''; ?>"><?php echo !empty($breadaname)?$breadaname:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_breeds";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Crossed breed B" style="width: 100%;" required="true" class="form-control" name="crobreb" id="inputEmail3">
                       <option value="<?php echo !empty($breedb)?$breedb:''; ?>"><?php echo !empty($breadbname)?$breadbname:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_cross_breeds";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Crossed breed C" style="width: 100%;" required="true" class="form-control" name="crobrec" id="inputEmail3">
                       <option value="<?php echo !empty($breedc)?$breedc:''; ?>"><?php echo !empty($breadcname)?$breadcname:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Production type, ie: meat, fun, sport, dairy, etc" style="width: 100%;" name="brepro" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Production type, ie: meat or dairy" value="<?php echo !empty($animalproduct)?$animalproduct:''; ?>">
                        <span class="fa fa-certificate form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_countries";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Country of origin" style="width: 100%;" required="true" class="form-control" name="brecou" id="inputEmail3">
                       <option value="<?php echo !empty($animalorigin)?$animalorigin:''; ?>"><?php echo !empty($countrytname)?$countrytname:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Breed display picture / icon name" style="width: 100%;" name="brepic" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Display breed picture name" value="<?php echo !empty($animalicon)?$animalicon:''; ?>">
                        <span class="fa fa-photo form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea rows="5" data-toggle="tooltip" title="Breed description" style="width: 100%;" name="bredesc" class="resizable_textarea form-control" placeholder="Breed description"><?php echo !empty($animaldescription)?$animaldescription:''; ?></textarea>
                    </div>
                  </div>
  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" data-toggle="tooltip" title="update details" name="savecat" class="btn btn-primary" style="width: 32%;">Update</button> 
                        </div>
                      </div> 

                    </form>
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
    $breedname=$_POST['brename']; 
    $breedcategory=$_POST['brecat'];
    $breedcrossa=$_POST['crobrea']; 
    $breedcrossb=$_POST['crobreb']; 
    $breedcrossc=$_POST['crobrec']; 
    $breedproduct=$_POST['brepro']; 
    $breedcountry=$_POST['brecou']; 
    $breedescription=$_POST['bredesc']; 
    $breedicon=$_POST['brepic']; 
    $lastmod = date("Y-m-d H:i:s");
 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE plaas_hy_breeds SET name = ?, categoryid = ?, cross_a = ?, cross_b = ?, cross_c = ?, productiontype = ?, countryoforigin = ?, description = ?, icon = ?, modified = ? WHERE id = ?";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($breedname,$breedcategory,$breedcrossa,$breedcrossb,$breedcrossc,$breedproduct,$breedcountry,$breedescription,$breedicon,$lastmod,$animalid));    
    echo '<meta content="2;main_animal_hybrid_edit.php?animal_id='. $animalid .'&breed_sucess_update" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect(); 
   }
?>   
