<?php
  require_once 'main.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Continents <small>globe</small></h3>
              </div>
              <?php
               require_once 'search.php';
              ?>
            </div> 

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Globe <small>countries | cities | populations</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_continents_display.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content"> 
                    <form class="form-horizontal form-label-left input_mask" method="POST"> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" style="width: 100%;" name="contname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Continent name">
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" style="width: 100%;" name="contpop" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Continent population">
                        <span class="fa fa-line-chart form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="number" style="width: 100%;" name="contcou" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Number of countries">
                        <span class="fa fa-sitemap form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" style="width: 100%;" name="contarea" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Total area / size in <?php echo !empty($distancesymbol)?$distancesymbol:''; ?>²">
                        <span class="fa fa-anchor form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" style="width: 100%;" name="contflag" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Display flag picture">
                        <span class="fa fa-flag form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea rows="5" style="width: 100%;" name="contdesc" class="resizable_textarea form-control" placeholder="Continent description"></textarea>
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
    $Continentname=$_POST['contname']; 
    $Continentpopu=$_POST['contpop']; 
    $Continentcoun=$_POST['contcou']; 
    $Continentarea=$_POST['contarea']; 
    $contdescription=$_POST['contdesc']; 
    $Continentflag=$_POST['contflag']; 

    $count=mysqli_query($con,"SELECT * FROM plaas_continents WHERE name = '$Continentname'");
    if(mysqli_num_rows($count) < 1)
    {  
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "INSERT into plaas_continents(name, population, nofcountries, area, description, icon) VALUES (?,?,?,?,?,?)";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($Continentname,$Continentpopu,$Continentcoun,$Continentarea,$contdescription,$Continentflag));      
    echo '<meta content="2;main_continents_display.php?cont_sucess" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();  
    } 
     else
      {        
      echo '<meta content="2;main_continents_display.php?cont_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
      }
   }
?>   
