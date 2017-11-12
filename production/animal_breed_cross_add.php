<?php
  require_once 'main.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Cross Breed <small>species</small></h3>
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
                    <h2>Livestock <small>animal | species | production</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="animal_breed_cross_list.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
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
                        <input type="text" data-toggle="tooltip" title="Breed name" style="width: 100%;" name="brename" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Breed name">
                        <span class="fa fa-bullseye form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM categories WHERE category = 'Livestock'";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Livestock Category" style="width: 100%;" required="true" class="form-control" name="brecat" id="inputEmail3">
                       <option value="">Select Livestock Category</option>
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
                       <option value="">Select breead one</option>
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
                       <option value="">Select breed two</option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Production type, ie: meat, wool, sport, dairy. etc" style="width: 100%;" name="brepro" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Production type, ie: meat or dairy">
                        <span class="fa fa-certificate form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_countries";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Country of origin" style="width: 100%;" required="true" class="form-control" name="brecou" id="inputEmail3">
                       <option value="">Select country of origin</option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Breed display picture / icon name" style="width: 100%;" name="brepic" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Display breed picture name">
                        <span class="fa fa-photo form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea rows="5" data-toggle="tooltip" title="Breed description" style="width: 100%;" name="bredesc" class="resizable_textarea form-control" placeholder="Breed description"></textarea>
                    </div>
                  </div>
  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" data-toggle="tooltip" title="Save details" name="savecat" class="btn btn-primary" style="width: 32%;">Save</button> 
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
    $breedproduct=$_POST['brepro']; 
    $breedcountry=$_POST['brecou'];
    $breedcrossa=$_POST['crobrea']; 
    $breedcrossb=$_POST['crobreb']; 
    $breedescription=$_POST['bredesc']; 
    $breedicon=$_POST['brepic']; 

    $count=mysqli_query($con,"SELECT * FROM plaas_cross_breeds WHERE name = '$breedname'");
    if(mysqli_num_rows($count) < 1)
    {  
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "INSERT into plaas_cross_breeds(name, categoryid, cross_a, cross_b, productiontype, countryoforigin, description, icon) VALUES (?,?,?,?,?,?,?,?)";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($breedname,$breedcategory,$breedcrossa,$breedcrossb,$breedproduct,$breedcountry,$breedescription,$breedicon));      
    echo '<meta content="2;animal_breed_cross_list.php?breed_sucess" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();  
    } 
     else
      {        
      echo '<meta content="2;animal_breed_cross_list.php?breed_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
      }
   }
?>   
