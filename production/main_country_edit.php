<?php
  require_once 'main.php';
  
  $countryid = null;
  if ( !empty($_GET['country_id'])) {
    $countryid = $_REQUEST['country_id'];
  }

  if ( null==$countryid ) {
   echo '<meta content="2;main_countries.php?country_idupd_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  } 

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_countries` WHERE id = '$countryid'";
    $q = $pdo->prepare($sql);
    $q->execute(array($countryid));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $countrytname = $data['name'];
    $countrycurrency = $data['currency'];
    $countrysubcurrency=$data['subcurrency'];
    $countrylanguage=$data['language']; 
    $countrycallcode=$data['callcode']; 
    $countryflag=$data['flag']; 
    $countrycontinent=$data['continent']; 
    $countryarea=$data['area']; 
    $countrypopulation=$data['population']; 
    $countrydescription=$data['description']; 
    $countrygdp=$data['gdp']; 

  
    $query_ams_settings = "SELECT * FROM plaas_continents WHERE id = '$countrycontinent'";
    $qs = $pdo->prepare($query_ams_settings);
    $qs->execute(array());
    $data = $qs->fetch(PDO::FETCH_ASSOC); 
    $contname = $data['name'];

?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo !empty($countrytname)?$countrytname:''; ?> <small> nation update</small></h3>
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
                    <h2>Statistics <small> <span aria-hidden="true"><img src="images/<?php echo $countryflag ?>" class="img-rounded" width="6%;" height="8%"></span> Population: <?php echo !empty($countrypopulation)?$countrypopulation:''; ?> | - | Area: <?php echo !empty($countryarea)?$countryarea:''; ?> km²</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_countries_display.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <?php
        if(isset($_GET['cou_sucess_update']))
    {  
      $msgcx = "
         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> Country - $countrytname !</strong>  successfully updated.
         </div>
         ";    
    }

        if(isset($_GET['cou_error_update']))
    {  
      $msgcx = "
         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C;
  background-color: #E77471;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> Country - $countrytname Error!</strong>  error occored during updateds.
         </div>
         ";    
    }
    ?>

                  <div class="x_content"> 
                  <?php if(isset($msgcx)) echo $msgcx;  ?>
                    <form class="form-horizontal form-label-left input_mask" method="POST"> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country name" style="width: 100%;" name="couname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country name" value="<?php echo !empty($countrytname)?$countrytname:''; ?>">
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country currency" style="width: 100%;" name="coucur" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country currency" value="<?php echo !empty($countrycurrency)?$countrycurrency:''; ?>">
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country sub currency" style="width: 100%;" name="cousubcu" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country sub currency" value="<?php echo !empty($countrysubcurrency)?$countrysubcurrency:''; ?>">
                        <span class="fa fa-cc form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country Language" style="width: 100%;" name="coulan" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Language" value="<?php echo !empty($countrylanguage)?$countrylanguage:''; ?>">
                        <span class="fa fa-dot-circle-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country caller code" style="width: 100%;" name="coucod" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Call code" value="<?php echo !empty($countrycallcode)?$countrycallcode:''; ?>">
                        <span class="fa fa-phone-square form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country flag name" style="width: 100%;" name="couflag" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Display flag picture" value="<?php echo !empty($countryflag)?$countryflag:''; ?>">
                        <span class="fa fa-flag form-control-feedback left" aria-hidden="true"></span>
                      </div>
                <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                  <?php  
                  $query="SELECT * FROM plaas_continents";
                  $result= $con->query($query);
                   ?>    
                  <select data-toggle="tooltip" title="Continent selection" style="width: 100%;" required="true" class="form-control" name="coucont" id="inputEmail3">
                    <option value="<?php echo !empty($countrycontinent)?$countrycontinent:''; ?>"><?php echo !empty($contname)?$contname:''; ?></option>
                    <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                    <option value=<?php echo $row['id']?>><?php echo $row['name']?></option>
                    <?php } ?>
                  </select> 
                </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country area" style="width: 100%;" name="couarea" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country area" value="<?php echo !empty($countryarea)?$countryarea:''; ?>">
                        <span class="fa fa-map form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country population" style="width: 100%;" name="coupop" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country population" value="<?php echo !empty($countrypopulation)?$countrypopulation:''; ?>">
                        <span class="fa fa-anchor form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea data-toggle="tooltip" title="Country description" rows="5" style="width: 100%;" name="coudesc" class="resizable_textarea form-control" placeholder="Country description"><?php echo !empty($countrydescription)?$countrydescription:''; ?></textarea>
                    </div>
                  </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country GDP" style="width: 100%;" name="cougbp" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country growth rate" value="<?php echo !empty($countrygdp)?$countrygdp:''; ?>">
                        <span class="fa fa-bar-chart form-control-feedback left" aria-hidden="true"></span>
                      </div>
  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" name="savecat" class="btn btn-primary" style="width: 32%;">Update</button> 
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
    $countryname=$_POST['couname']; 
    $countrycurrency=$_POST['coucur']; 
    $countrysubcurrency=$_POST['cousubcu']; 
    $countrylanguage=$_POST['coulan']; 
    $countrycallcode=$_POST['coucod']; 
    $countryflag=$_POST['couflag'];
    $countrycontinent=$_POST['coucont']; 
    $countryarea=$_POST['couarea']; 
    $countrypopulation=$_POST['coupop']; 
    $countrydescription=$_POST['coudesc']; 
    $countrygdp=$_POST['cougbp'];  
    $lastmod = date("Y-m-d H:i:s");
 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE plaas_countries SET name = ?, currency = ?, subcurrency = ?, language = ?, callcode = ?, flag = ?, continent = ?, area = ?, population = ?, description = ?, gdp = ?, modified = ? WHERE id = ?";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($countryname,$countrycurrency,$countrysubcurrency,$countrylanguage,$countrycallcode,$countryflag,$countrycontinent,$countryarea,$countrypopulation,$countrydescription,$countrygdp,$lastmod,$countryid));    
    echo '<meta content="2;main_country_edit.php?country_id='. $countryid .'&cou_sucess_update" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();   
   }
?>   
