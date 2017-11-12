<?php
  require_once 'main.php';

  $alphabetid = null;
  if ( !empty($_GET['alphabetid'])) {
    $alphabetid = $_REQUEST['alphabetid'];
  }

  if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
   $pid = null;
    if ( !empty($_GET['id'])) {
    $pid = $_REQUEST['id'];
   }
 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM `products` WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="1;main_products_display.php?product_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Products <small>Farmers products index</small></h3>
              </div>
                    
                  <?php
                    if(isset($_GET['livestock_add_sucess']))
                       {  
                        $msgcx = "
                         <div class='alert form-group has-feedback' style='  color: #000C2C; background-color: #99C68E; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Product comfirmation !</strong>  New product successfully registered.
                         </div>
                         ";    
                       }
               
                    if(isset($_GET['livestock_add_error']))
                       {  
                        $msgcx = "
                         <div class='alert form-group has-feedback' style='  color: #000C2C; background-color: #E77471; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Product error !</strong> error occured while registering new product.
                         </div>
                         ";    
                       } 
 
        if(isset($_GET['product_sucess_delete']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> Delete Comfimation !</strong>  Product successfully removed from list.
         </div>
         ";    
    }
    ?>

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

                  <div class="x_title">
                    <medium><a href="index.php">Dashboard</a> <i class="fa fa-play-circle"></i> <a href="main_products_display.php">Products</a> <i class="fa fa-play-circle"></i> <b>Product TagID index <?php echo !empty($alphabetid)?$alphabetid:''; ?></b></medium>
                    <ul class="nav navbar-right panel_toolbox"> 
                    </ul>
                    <div class="clearfix"></div>
                  </div>

            <div class="clearfix"></div>
             <?php if(isset($msgcx)) echo $msgcx;  ?> 

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-left">
                       <?php  
                        include_once 'dbConfig.php';
                        $query="SELECT * FROM plaas_aphabets";
                        $result= $con->query($query);
                       ?>     
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <ul class="pagination pagination-split">
                          <li><a href="main_products_display_by_alphabet.php?alphabetid=<?php echo $row['count']?>&user_key=<?php echo $userhashid?>"><?php echo $row['count']?></a></li> 
                        </ul>
                      <?php }

                        $query="SELECT * FROM categories WHERE category = 'livestock'";
                        $result= $con->query($query);
                       ?>     
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <ul class="pagination pagination-split alert-default" data-toggle="tooltip" title="Display by category <?php echo $row['name']?>">
                          <li><a href="main_products_display_by_category.php?categoryname=<?php echo $row['id']?>&user_key=<?php echo $userhashid?>"><?php echo $row['name']?></a></li> 
                        </ul>
                      <?php } ?> 
                      </div>   

                      <div class="clearfix"></div>
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM products WHERE tagid LIKE '$alphabetid%'";
             foreach ($pdo->query($sql) as $row) {     
                $category_id = $row['categoryid'];
                $productsex = $row['sex'];
                $produshwage = $row['dob'];
                $produshwbrd = $row['breedId'];
                $produshwimg = $row['image'];
                $produser= $row['userid'];
                $produshwcrd = date("Y-m-d");

                $query_ams_settings = "SELECT * FROM plaas_accounts WHERE id = '$produser'";
                $q = $pdo->prepare($query_ams_settings);
                $q->execute(array());
                $data = $q->fetch(PDO::FETCH_ASSOC); 
                $ownuser = $data['email_address'];
             
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query_ams_settings = "SELECT * FROM plaas_breeds WHERE id = '$produshwbrd'";
                $q = $pdo->prepare($query_ams_settings);
                $q->execute(array());
                $data = $q->fetch(PDO::FETCH_ASSOC); 
                $cbreedname = $data['name'];   
                $cbreedicon = $data['icon'];   
                
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query_ams_setting = "SELECT * FROM plaas_animal_sex WHERE id = '$productsex'";
                $qe = $pdo->prepare($query_ams_setting);
                $qe->execute(array());
                $data = $qe->fetch(PDO::FETCH_ASSOC); 
                $produshwsex = $data['sex'];
             
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query_ams_setting = "SELECT * FROM categories WHERE id = '$category_id'";
                $qe = $pdo->prepare($query_ams_setting);
                $qe->execute(array());
                $data = $qe->fetch(PDO::FETCH_ASSOC); 
                $categoryname = $data['name'];
 

                $diff = abs(strtotime($produshwcrd) - strtotime($produshwage));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

             ?> 

                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <p data-toggle="tooltip" title="Product Tag ID" class="brief"><i><strong><?php echo $row['tagid']; ?></strong></i> </p>
                            <div class="left col-xs-7">
                             <p></p> 
                              <p><strong>Color: <?php echo $row['color']; ?></strong></p>
                              <p><strong>Maturity: <?php echo !empty($produshwsex)?$produshwsex:''; ?> </strong></p>
                              <ul class="list-unstyled">
                                <p><strong>Category: <?php echo !empty($categoryname)?$categoryname:''; ?></strong></p>
                                <p><strong>Breed: <?php echo !empty($cbreedname)?$cbreedname:''; ?></strong></p>
                                <?php
                                if ($produshwage == '') {
                                  ?>
                                <p>Age: Uknown</p> 
                                <?php
                                }else{
                                ?>
                                <p>Age: <?php printf("%d years, %d months, %d days\n", $years, $months, $days); ?></p> 
                                <?php
                                }
                                ?> 
                                <p><strong>REF: <?php echo !empty($ownuser)?$ownuser:''; ?></strong></p>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                                <?php
                                if ($produshwimg == '') {
                                  ?>
                              <img src="images/<?php echo !empty($cbreedicon)?$cbreedicon:''; ?>" alt=" Icon" class="img-rounded profile-user-img img-responsive"> 
                                <?php
                                }else{
                                ?>
                              <img src="images/<?php echo $row['image'] ?>" alt=" Icon" class="img-rounded profile-user-img img-responsive"> 
                                <?php
                                }
                                ?>  
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <p class="ratings">
                                <a>Birth: </a>
                                <?php
                                if ($produshwage == '') {
                                  ?>
                                <strong>Uknown</strong>  
                                <?php
                                }else{
                                ?>
                                <strong><?php echo $row['dob']; ?></strong>  
                                <?php
                                }
                                ?>  
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <?php echo '<a href="main_new_livestock_selected_breed_update.php?product_id='. $row['id'] .'">'?><button data-toggle="tooltip" title="View | Edit <?php echo $row['tagid']; ?> details" type="button" class="btn btn-dark btn-xs">
                                <i class="fa fa-edit"> </i> </i> Edit
                              </button><?php echo '</a>'?> 
                               <a onclick="deleteLivestock(<?php echo $row['id']; ?>);" href="javascript:;" data-toggle="tooltip" title="Delete <?php echo $row['tagid']; ?>"><button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i>
                                Delete </button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                <?php
                }
                MyData::disconnect();
                ?>    
                  </div> 
 
 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content --> 
<script type="text/javascript">
  function deleteLivestock(Id){
    var iAnswer = confirm("Are you sure you want to delete selected product?"); 
  if(iAnswer){
    window.location = 'main_products_display.php?id=' + Id;
  }
  }
  
  $( document ).ready(function() {
  setTimeout(function() {
      $("#me").hide(300);
      $("#you").hide(300);
  }, 3000);
});
</script>


<?php
  require_once 'footer.php';
?>    