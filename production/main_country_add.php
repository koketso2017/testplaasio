<?php
  require_once 'main.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Country <small>nation registration</small></h3>
              </div>
              <?php
               require_once 'search.php';
              ?>
            </div> 

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Location <small>area | cities | populations</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_countries_display.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
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
                        <input type="text" data-toggle="tooltip" title="Country name" style="width: 100%;" name="couname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country name">
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country currency" style="width: 100%;" name="coucur" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country currency">
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country sub currency" style="width: 100%;" name="cousubcu" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country sub currency">
                        <span class="fa fa-cc form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country Language" style="width: 100%;" name="coulan" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Language">
                        <span class="fa fa-dot-circle-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country caller code" style="width: 100%;" name="coucod" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Call code">
                        <span class="fa fa-phone-square form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country flag name" style="width: 100%;" name="couflag" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Display flag picture">
                        <span class="fa fa-flag form-control-feedback left" aria-hidden="true"></span>
                      </div>
                <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                  <?php  
                  $query="SELECT * FROM plaas_continents";
                  $result= $con->query($query);
                   ?>    
                  <select data-toggle="tooltip" title="Continent selection" style="width: 100%;" required="true" class="form-control" name="coucont" id="inputEmail3">
                    <option value="">Select Continent</option>
                    <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                    <option value=<?php echo $row['id']?>><?php echo $row['name']?></option>
                    <?php } ?>
                  </select> 
                </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country area" style="width: 100%;" name="couarea" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country area">
                        <span class="fa fa-map form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country population" style="width: 100%;" name="coupop" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country population">
                        <span class="fa fa-anchor form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea data-toggle="tooltip" title="Country description" rows="5" style="width: 100%;" name="coudesc" class="resizable_textarea form-control" placeholder="Country description"></textarea>
                    </div>
                  </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Country GDP" style="width: 100%;" name="cougbp" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Country growth rate">
                        <span class="fa fa-bar-chart form-control-feedback left" aria-hidden="true"></span>
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

    $count=mysqli_query($con,"SELECT * FROM plaas_countries WHERE name = '$countryname'");
    if(mysqli_num_rows($count) < 1)
    {  
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "INSERT into plaas_countries(name, currency, subcurrency, language, callcode, flag, continent, area, population, description, gdp) VALUES (?,?,?,?,?,?,?,?,?,?,?)";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($countryname,$countrycurrency,$countrysubcurrency,$countrylanguage,$countrycallcode,$countryflag,$countrycontinent,$countryarea,$countrypopulation,$countrydescription,$countrygdp));      
    echo '<meta content="2;main_countries_display.php?cou_sucess" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();  
    } 
     else
      {        
      echo '<meta content="2;main_country_add.php?cou_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
      }
   }
?>   
