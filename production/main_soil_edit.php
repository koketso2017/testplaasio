<?php
  require_once 'main.php';
  
    $soilid = null;
  if ( !empty($_GET['soil_id'])) {
    $soilid = $_REQUEST['soil_id'];
  }

  if ( null==$soilid ) {
   echo '<meta content="2;main_soil_categories_display.php?soil_idupd_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  } 

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_soil` WHERE id = '$soilid'";
    $q = $pdo->prepare($sql);
    $q->execute(array($soilid));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $soilname = $data['name'];
    $soildesc = $data['description'];
    $soilicon=$data['icon']; 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo !empty($soilname)?$soilname:''; ?> <small>soil update</small></h3>
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
                    <h2><?php echo !empty($soilname)?$soilname:''; ?><small>soil</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_soil_categories_display.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <?php
        if(isset($_GET['soil_sucess_update']))
    {  
      $msgcx = "
         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> Soil - $soilname !</strong>  successfully updated.
         </div>
         ";    
    }
    ?>

                  <div class="x_content"> 
                   <?php if(isset($msgcx)) echo $msgcx;  ?>
                    <form class="form-horizontal form-label-left input_mask" method="POST"> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Soil type name"  style="width: 100%;" name="soilname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Soil type name" value="<?php echo !empty($soilname)?$soilname:''; ?>">
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" style="width: 100%;" data-toggle="tooltip" title="Display soil icon / picture" name="soilicon" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Display soil picture" value="<?php echo !empty($soilicon)?$soilicon:''; ?>">
                        <span class="fa fa-ge form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea data-toggle="tooltip" title="Soil type description" rows="5" style="width: 100%;" name="soildesc" class="resizable_textarea form-control" placeholder="Soil type description"><?php echo !empty($soildesc)?$soildesc:''; ?></textarea>
                    </div>
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
    $soilname=$_POST['soilname']; 
    $soilicon=$_POST['soilicon']; 
    $soildesc=$_POST['soildesc'];  
    $lastmod = date("Y-m-d H:i:s");
 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE plaas_soil SET name = ?, icon = ?, description = ?, modified = ? WHERE id = ?";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($soilname,$soilicon,$soildesc,$lastmod,$soilid));    
    echo '<meta content="2;main_soil_edit.php?soil_id='. $soilid .'&soil_sucess_update" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();  
   }
?>   
