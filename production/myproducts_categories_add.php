<?php
  require_once 'main.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Category <small>product registration</small></h3>
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
                    <h2>Products <small>Crops | Livestock | Vegetables</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_categories_display.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content"> 
                    <form class="form-horizontal form-label-left input_mask" method="POST">  
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control" name="catid" tabindex="-1">
                            <option>Select Category</option>
                            <option value="crops">Crops</option>
                            <option value="livestock">Livestock</option>
                            <option value="vegetables">Vegetables</option>
                            <option value="other">Other</option> 
                          </select>
                        </div>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" style="width: 100%;" name="caticon" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Icon / display picture">
                        <span class="fa fa-picture-o form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" style="width: 100%;" name="catname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Name / Identity">
                        <span class="fa fa-dot-circle-o form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea rows="5" style="width: 100%;" name="catdesc" class="resizable_textarea form-control" placeholder="Description"></textarea>
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
    $category=$_POST['catname']; 
    $categoryid=$_POST['catid']; 
    $icon=$_POST['caticon']; 
    $description=$_POST['catdesc']; 

    $count=mysqli_query($con,"SELECT * FROM categories WHERE name = '$category'");
    if(mysqli_num_rows($count) < 1)
    {  
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "INSERT into categories(category, name, description, icon) VALUES (?,?,?,?)";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($categoryid,$category,$description,$icon));      
    echo '<meta content="2;main_categories_display.php?cat_sucess" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();  
    } 
     else
      {        
      echo '<meta content="2;main_categories_display.php?cat_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
      }
   }
?>   
