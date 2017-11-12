<?php
  require_once 'main.php';

  $continentid = null;
  if ( !empty($_GET['continent_id'])) {
    $continentid = $_REQUEST['continent_id'];
  }

  if ( null==$continentid ) {
   echo '<meta content="2;main_continents_display.php?continent_id_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  } 

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_continents` WHERE id = '$continentid'";
    $q = $pdo->prepare($sql);
    $q->execute(array($continentid));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $Continentname = $data['name'];
    $Continentpopu = $data['population'];
    $Continentcoun=$data['nofcountries'];
    $Continentarea=$data['area']; 
    $continentdesc=$data['description']; 
    $continenticon=$data['icon']; 

?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo !empty($Continentname)?$Continentname:''; ?> <small>continent update</small></h3>
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
                    <h2>Statistics <small> <span aria-hidden="true"><img src="images/<?php echo $continenticon ?>" class="img-rounded" width="4%;" height="4%"></span> Population: <?php echo !empty($Continentpopu)?$Continentpopu:''; ?> | - | Area: <?php echo !empty($Continentarea)?$Continentarea:''; ?> km²</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_continents_display.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <?php
        if(isset($_GET['cont_sucess_update']))
    {  
      $msgcx = "
         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> Continent - $Continentname !</strong>  successfully updated.
         </div>
         ";    
    }
    ?>

                  <div class="x_content"> 
                  <?php if(isset($msgcx)) echo $msgcx;  ?>
                    <form class="form-horizontal form-label-left input_mask" method="POST"> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Continent name" style="width: 100%;" name="contname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Continent name" value="<?php echo !empty($Continentname)?$Continentname:''; ?>">
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Continent population" style="width: 100%;" name="contpop" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Continent population" value="<?php echo !empty($Continentpopu)?$Continentpopu:''; ?>">
                        <span class="fa fa-line-chart form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="number" data-toggle="tooltip" title="Number of countries" style="width: 100%;" name="contcou" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Number of countries" value="<?php echo !empty($Continentcoun)?$Continentcoun:''; ?>">
                        <span class="fa fa-sitemap form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Total area" style="width: 100%;" name="contarea" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Total area" value="<?php echo !empty($Continentarea)?$Continentarea:''; ?>">
                        <span class="fa fa-anchor form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Display flag picture" style="width: 100%;" name="contflag" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Display flag picture" value="<?php echo !empty($continenticon)?$continenticon:''; ?>">
                        <span class="fa fa-flag form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea rows="5" data-toggle="tooltip" title="Continent description" style="width: 100%;" name="contdesc" class="resizable_textarea form-control" placeholder="Continent description"><?php echo !empty($continentdesc)?$continentdesc:''; ?></textarea>
                    </div>
                  </div>
  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" data-toggle="tooltip" title="Save changes to the database" name="saveupd" class="btn btn-success" style="width: 32%;">Update</button> 
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
  if(isset($_POST['saveupd']))
   { 
    $Continentname=$_POST['contname']; 
    $Continentpopu=$_POST['contpop']; 
    $Continentcoun=$_POST['contcou']; 
    $Continentarea=$_POST['contarea']; 
    $contdescription=$_POST['contdesc']; 
    $Continentflag=$_POST['contflag']; 
    $lastmod = date("Y-m-d H:i:s");
 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE plaas_continents SET name = ?, population = ?, nofcountries = ?, area = ?, description = ?, icon = ?, modified = ? WHERE id = ?";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($Continentname,$Continentpopu,$Continentcoun,$Continentarea,$contdescription,$Continentflag,$lastmod,$continentid));    
    echo '<meta content="2;main_continent_edit.php?continent_id='. $continentid .'&cont_sucess_update" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();   
   }
?>   
