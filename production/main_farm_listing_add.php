<?php
  require_once 'main.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Farm <small>location registration</small></h3>
              </div>
              <?php
               require_once 'search.php';
              ?>
            </div> 

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Location <small>area | products </small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_user_farms_display.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content"> 
                  <?php
                    if(isset($_GET['farm_add_sucess']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #99C68E; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Farm add comfirmation !</strong>  New Farm successfully registered.
                         </div>
                         ";    
                       }
               
                    if(isset($_GET['farm_add_error']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #E77471; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Farm error !</strong> error occured while registering new farm.
                         </div>
                         ";    
                       }
                       ?>
                      <?php if(isset($msgcx)) echo $msgcx;  ?>
                    <form class="form-horizontal form-label-left input_mask" method="POST"> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_accounts";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Farm / location owner" style="width: 100%;" required="true" class="form-control" name="fmow" id="inputEmail3">
                       <option value="">Select Farm Owner</option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['email_address']?></option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input required="true" data-toggle="tooltip" title="Fam name, plot NO, Garden Identity, Field ID" type="text" style="width: 100%;" name="plotid" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Fam name, plot NO, Garden Identity, Field ID">
                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select required="true" data-toggle="tooltip" title="Farming Type" class="select2_single form-control" name="catselection">
                            <option>Select Category</option>
                            <option value="crops">Crops</option>
                            <option value="livestock">Livestock</option>
                            <option value="vegetables">Vegetables</option>
                            <option value="crops, vegetables & livestock">Crops, Vegetables & Livestock</option>
                            <option value="other">Other</option> 
                          </select>
                        </div>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Sub village, ie cattle post name, farm location" type="text" style="width: 100%;" name="farmloc" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Sub village, ie cattle post name, farm location" value="<?php echo !empty($citystreet)?$citystreet:''; ?>">
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Village identification" type="text" style="width: 100%;" name="farmvil" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Village identification" value="<?php echo !empty($citytown)?$citytown:''; ?>">
                        <span class="fa fa-location-arrow form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_countries";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Country of allocation" style="width: 100%;" required="true" class="form-control" name="ucou" id="inputEmail3">
                       <option value="<?php echo !empty($country)?$country:''; ?>"><?php echo !empty($country)?$country:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['name']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Farm area / size in <?php echo !empty($distancesymbol)?$distancesymbol:''; ?>²" type="number" style="width: 100%;" name="farmar" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Farm area / size in <?php echo !empty($distancesymbol)?$distancesymbol:''; ?>²">
                        <span class="fa fa-exchange form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea data-toggle="tooltip" title="Farm description" rows="5" style="width: 100%;" name="famdesc" class="resizable_textarea form-control" placeholder="Description"></textarea>
                    </div>
                  </div>
  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" name="savecat" class="btn btn-primary" style="width: 32%;">Save</button> 
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
    $uniqueid=md5($farmcountry). rand(10000, 990000) . 'P' . time() . 'LS'; 
    $farmname=$_POST['plotid']; 
    $categoryid=$_POST['catselection']; 
    $farmlocation=$_POST['farmloc']; 
    $farmvillage=$_POST['farmvil']; 
    $farmcountry=$_POST['ucou'];
    $farmarea=$_POST['farmar'];   
    $description=$_POST['famdesc']; 
    $fmuserid=$_POST['fmow']; 
    $fmusericon='fm.png'; 

    $count=mysqli_query($con,"SELECT * FROM plaas_data_farm WHERE uniqueid = '$uniqueid' and farmname = '$farmname'");
    if(mysqli_num_rows($count) < 1)
    {  
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "INSERT into plaas_data_farm(uniqueid, farmname, category, location, village, country, areasize, userid, description, icon) VALUES (?,?,?,?,?,?,?,?,?,?)";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($uniqueid,$farmname,$categoryid,$farmlocation,$farmvillage,$farmcountry,$farmarea,$fmuserid,$description,$fmusericon));      
    echo '<meta content="2;main_user_farms_display.php?farm_add_sucess" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();  
    } 
     else
      {        
      echo '<meta content="2;main_user_farms_display.php?farm_add_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
      }
   }
?>   
