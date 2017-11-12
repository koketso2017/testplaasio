<?php
  require_once 'main_public.php';

  $myfarmid = null;
  if ( !empty($_GET['myfarm_id'])) {
    $myfarmid = $_REQUEST['myfarm_id'];
  }

  if ( null==$myfarmid ) {
   echo '<meta content="2;myfarms.php?farm_id_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  } 

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_data_farm` WHERE farmID = '$myfarmid'";
    $q = $pdo->prepare($sql);
    $q->execute(array($myfarmid));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $farmname= $data['farmname'];
    $farmcate= $data['category'];
    $farmloca=$data['location'];
    $farmvill=$data['village']; 
    $farmcoun=$data['country']; 
    $farmsize=$data['areasize']; 
    $farmdesc=$data['description']; 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo !empty($farmname)?$farmname:''; ?> <small>farm information</small></h3>
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
                    <h2>Location <small>area | products </small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="myfarms.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content"> 
                  <?php
                    if(isset($_GET['farm_sucess_update']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #99C68E; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Farm update comfirmation !</strong> $farmname successfully updated.
                         </div>
                         ";    
                       } 
                       ?>
                      <?php if(isset($msgcx)) echo $msgcx;  ?>
                    <form class="form-horizontal form-label-left input_mask" method="POST">  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input required="true" data-toggle="tooltip" title="Fam name, plot NO, Garden Identity, Field ID" type="text" style="width: 100%;" name="plotid" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Fam name, plot NO, Garden Identity, Field ID" value="<?php echo !empty($farmname)?$farmname:''; ?>">
                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select required="true" data-toggle="tooltip" title="Farming Type" class="select2_single form-control" name="catselection">
                            <option value="<?php echo !empty($farmcate)?$farmcate:''; ?>"><?php echo !empty($farmcate)?$farmcate:''; ?></option>
                            <option value="crops">Crops</option>
                            <option value="livestock">Livestock</option>
                            <option value="vegetables">Vegetables</option>
                            <option value="crops, vegetables & livestock">Crops, Vegetables & Livestock</option>
                            <option value="other">Other</option> 
                          </select>
                        </div>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Sub village, ie cattle post name, farm location" type="text" style="width: 100%;" name="farmloc" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Sub village, ie cattle post name, farm location" value="<?php echo !empty($farmloca)?$farmloca:''; ?>">
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Village identification" type="text" style="width: 100%;" name="farmvil" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Village identification" value="<?php echo !empty($farmvill)?$farmvill:''; ?>">
                        <span class="fa fa-location-arrow form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_countries";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Country of allocation" style="width: 100%;" required="true" class="form-control" name="ucou" id="inputEmail3">
                       <option value="<?php echo !empty($farmcoun)?$farmcoun:''; ?>"><?php echo !empty($farmcoun)?$farmcoun:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['name']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Farm area / size in <?php echo !empty($distancesymbol)?$distancesymbol:''; ?>²" type="number" style="width: 100%;" name="farmar" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Farm area / size in <?php echo !empty($distancesymbol)?$distancesymbol:''; ?>²" value="<?php echo !empty($farmsize)?$farmsize:''; ?>">
                        <span class="fa fa-exchange form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea data-toggle="tooltip" title="Farm description" rows="5" style="width: 100%;" name="famdesc" class="resizable_textarea form-control" placeholder="Description"><?php echo !empty($farmdesc)?$farmdesc:''; ?></textarea>
                    </div>
                  </div>
  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" name="savecat" class="btn btn-dark" style="width: 32%;">Update</button> 
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
    $farmname=$_POST['plotid']; 
    $categoryid=$_POST['catselection']; 
    $farmlocation=$_POST['farmloc']; 
    $farmvillage=$_POST['farmvil']; 
    $farmcountry=$_POST['ucou'];
    $farmarea=$_POST['farmar'];   
    $description=$_POST['famdesc'];
    $lastmod = date("Y-m-d H:i:s"); 
 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE plaas_data_farm SET farmname = ?, category = ?, location = ?, village = ?, country = ?, areasize = ?, description = ?, modified = ? WHERE farmID = ?";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($farmname,$categoryid,$farmlocation,$farmvillage,$farmcountry,$farmarea,$description,$lastmod,$myfarmid));     
    echo '<meta content="2;myfarm_edit.php?myfarm_id='. $myfarmid .'&farm_sucess_update" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();
   }
?>   
