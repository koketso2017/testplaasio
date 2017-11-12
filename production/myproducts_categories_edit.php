<?php
  require_once 'main.php';

  $productid = null;
  if ( !empty($_GET['product_id'])) {
    $productid = $_REQUEST['product_id'];
  }

  if ( null==$productid ) {
   echo '<meta content="2;main_categories_display.php?product_id_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  } 

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `categories` WHERE id = '$productid'";
    $q = $pdo->prepare($sql);
    $q->execute(array($productid));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $categoryid = $data['category'];
    $categoryname = $data['name'];
    $catdescription=$data['description'];
    $categoryicon=$data['icon']; 

?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Category <small>product update</small></h3>
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
                    <h2>Product <small> <span aria-hidden="true"><img src="images/<?php echo $categoryicon ?>" class="img-rounded" width="8%;" height="8%"></span> <?php echo !empty($categoryname)?$categoryname:''; ?> - <?php echo !empty($categoryid)?$categoryid:''; ?> </small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_categories_display.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-bars"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <?php
        if(isset($_GET['cat_sucess_update']))
    {  
      $msgcx = "
         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> $categoryname !</strong>  successfully updated.
         </div>
         ";    
    }
    ?>

                  <div class="x_content"> 
                  <?php if(isset($msgcx)) echo $msgcx;  ?>
                    <form class="form-horizontal form-label-left input_mask" method="POST">  
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control" name="catid" tabindex="-1">
                            <option><?php echo !empty($categoryid)?$categoryid:''; ?></option>
                            <option value="crops">Crops</option>
                            <option value="livestock">Livestock</option>
                            <option value="vegetables">Vegetables</option>
                            <option value="other">Other</option> 
                          </select>
                        </div>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" style="width: 100%;" name="caticon" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Icon / display picture" value="<?php echo !empty($categoryicon)?$categoryicon:''; ?>">
                        <span class="fa fa-picture-o form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" style="width: 100%;" name="catname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Name / Identity" value="<?php echo !empty($categoryname)?$categoryname:''; ?>">
                        <span class="fa fa-dot-circle-o form-control-feedback left" aria-hidden="true"></span>              
                      </div> <br><br>
 

                  <div class="form-group"> 
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea rows="5" style="width: 100%;" name="catdesc" class="resizable_textarea form-control" placeholder="Description"><?php echo !empty($catdescription)?$catdescription:''; ?></textarea>
                    </div>
                  </div>
  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" name="saveupd" class="btn btn-success" style="width: 32%;">Update</button> 
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
    $category=$_POST['catname']; 
    $categoryid=$_POST['catid']; 
    $icon=$_POST['caticon']; 
    $description=$_POST['catdesc']; 
    $succ = 'cat_sucess_update';
    $lastmod = date("Y-m-d H:i:s");
 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "UPDATE categories SET category = ?, name = ?, description = ?, icon = ?, modified = ? WHERE id = ?";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($categoryid,$category,$description,$icon,$lastmod,$productid));    
    echo '<meta content="2;myproducts_categories_edit.php?product_id='. $productid .'&cat_sucess_update='. $succ . '" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();   
   }
?>   
