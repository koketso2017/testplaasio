<?php
  require_once 'main.php';
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>System Settings</h3>
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
                    <h2>Configurations <small>user settings</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <!-- Smart Wizard -->
                    <p>This page gives you the accessibility to set your own system calculation, Measurements units, currency and system updates.</p> 
                   <?php
                    if(isset($_GET['settings_update_success']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #99C68E; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Settings comfirmation !</strong>  Settings successfully updated.
                         </div>
                         ";    
                       }

                    if(isset($_GET['settings_update_successfull']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #99C68E; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Settings update !</strong>  Settings successfully updated.
                         </div>
                         ";    
                       }

                    if(isset($_GET['setting_update_error']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #E77471; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Settings error !</strong> error occured while updating your new settings.
                         </div>
                         ";    
                       }
                       ?>
                      <?php if(isset($msgcx)) echo $msgcx;  ?>
                    <form class="form-horizontal form-label-left input_mask" method="POST">
                      <input type="hidden" name="ucid" value="<?php echo !empty($userid)?$userid:''; ?>">  
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select required="true" data-toggle="tooltip" title="Receive News & Updates" class="select2_single form-control" name="setnews">
                       <?php
                        if ($Updatestst == '') {
                          ?>
                            <option value="never">Never</option>
                       <?php
                        }else{
                       ?>
                            <option value="<?php echo !empty($Updatestst)?$Updatestst:''; ?>"><?php echo !empty($Updatestst)?$Updatestst:''; ?></option>
                       <?php
                        }
                       ?>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="never">Never</option>  
                          </select>
                        </div>
                      </div>  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_metrics";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Distance Measurements " style="width: 100%;" required="true" class="form-control" name="setdis" id="inputEmail3">
                       <?php
                        if ($distance == '') {
                          ?>
                       <option value="1">Kilometer - (Km)</option>
                       <?php
                        }else{
                       ?>
                       <option value="<?php echo !empty($distance)?$distance:''; ?>"><?php echo !empty($distancename)?$distancename:''; ?> - (<?php echo !empty($distancesymbol)?$distancesymbol:''; ?>)</option>
                       <?php
                        }
                       ?>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['name']?> - (<?php echo $row['sysmbol']?>)</option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_mass";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Weight Measurements " style="width: 100%;" required="true" class="form-control" name="setwei" id="inputEmail3">
                       <?php
                        if ($weight == '') {
                          ?>
                       <option value="1">kilotonne</option>
                       <?php
                        }else{
                       ?>
                       <option value="<?php echo !empty($weight)?$weight:''; ?>"><?php echo !empty($weightname)?$weightname:''; ?> - (<?php echo !empty($weightsymbol)?$weightsymbol:''; ?>)</option>
                       <?php
                        }
                       ?>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['name']?> - (<?php echo $row['sysmbol']?>)</option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_countries";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Currency Settings " style="width: 100%;" required="true" class="form-control" name="setcur" id="inputEmail3">
                       <?php
                        if ($currencyuse == '') {
                          ?>
                       <option value="<?php echo !empty($country)?$country:''; ?>"><?php echo !empty($country)?$country:''; ?> - (<?php echo !empty($currencyname)?$currencyname:''; ?>)</option>
                       <?php
                        }else{
                       ?>
                       <option value="<?php echo !empty($currencyuse)?$currencyuse:''; ?>"><?php echo !empty($setcuountname)?$setcuountname:''; ?> - (<?php echo !empty($setcurrencyname)?$setcurrencyname:''; ?>)</option>
                       <?php
                        }
                       ?>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['name']?> - (<?php echo $row['currency']?>)</option>
                       <?php } ?>
                       </select> 
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
  if(isset($_POST['savecat']))
   { 
    $accountid=$_POST['ucid']; 
    $metricids=$_POST['setwei']; 
    $distanceids=$_POST['setdis'];   
    $currencyids=$_POST['setcur'];  
    $updatess=$_POST['setnews'];  
    $lastmod = date("Y-m-d H:i:s");

    $count=mysqli_query($con,"SELECT * FROM plaas_user_setings WHERE userid = '$accountid'");
    if(mysqli_num_rows($count) < 1)
    {  
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "INSERT into plaas_user_setings(metricid, distanceid, userid, currencyid, updates) VALUES (?,?,?,?,?)";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($metricids,$distanceids,$accountid,$currencyids,$updatess));      
    echo '<meta content="2;main_user_settings.php?settings_update_success" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect(); 
    } 
     else
      {        
       $pdo = MyData::connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql2 = "UPDATE plaas_user_setings SET metricid = ?, distanceid = ?, currencyid = ?, updates = ?, modified = ? WHERE userid = ?";   
       $q2 = $pdo->prepare($sql2);
       $q2->execute(array($metricids,$distanceids,$currencyids,$updatess,$lastmod,$accountid));    
      echo '<meta content="2;main_user_settings.php?settings_update_successfull" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
    MyData::disconnect();  
      }
   }
?>