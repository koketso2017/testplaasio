<?php
  require_once 'main.php';

  if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
   $pid = null;
    if ( !empty($_GET['id'])) {
    $pid = $_REQUEST['id'];
   }
 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM `plaas_breeds` WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="1;main_pure_breeds_display.php?breed_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Pure Breeds <small>Livestock index</small></h3>
              </div>
                    
                  <?php
        if(isset($_GET['breed_sucess']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='  color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Comfirmation !</strong>  Breed successfully registered.
         </div>
         ";  
    }


        if(isset($_GET['cat_error']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #E77471;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Category Error!</strong>  uknown error occured during registration.
         </div>
         ";  
    }
 
        if(isset($_GET['breed_sucess_delete']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> Delete Comfimation !</strong>  breed successfully removed from list.
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
                    <medium><a href="index.php">Dashboard</a> <i class="fa fa-play-circle"></i> <b>Displaying 51 out of <?php echo !empty($cont66)?$cont66:''; ?> random pure breeds</b></medium>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="animal_breed_add.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button><?php echo '</a>'?></li> 
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
                          <li><a href="main_pure_breeds_display_by_alphabet.php?alphabetid=<?php echo $row['name']?>&user_key=<?php echo $userhashid?>"><?php echo $row['name']?></a></li> 
                        </ul>
                      <?php }

                        $query="SELECT * FROM categories WHERE category = 'livestock'";
                        $result= $con->query($query);
                       ?>     
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <ul class="pagination pagination-split alert-default" data-toggle="tooltip" title="Display by category <?php echo $row['name']?>">
                          <li><a href="main_pure_breeds_display_by_category.php?categoryname=<?php echo $row['id']?>&user_key=<?php echo $userhashid?>"><?php echo $row['name']?></a></li> 
                        </ul>
                      <?php } ?> 
                      </div>   

                      <div class="clearfix"></div>
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM plaas_breeds order by RAND() LIMIT 51";
             foreach ($pdo->query($sql) as $row) {     
                $category_id = $row['categoryid'];
                $countryorigin = $row['countryoforigin'];
             
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query_ams_settings = "SELECT * FROM plaas_countries WHERE id = '$countryorigin'";
                $q = $pdo->prepare($query_ams_settings);
                $q->execute(array());
                $data = $q->fetch(PDO::FETCH_ASSOC); 
                $countryname = $data['name']; 
             
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query_ams_setting = "SELECT * FROM categories WHERE id = '$category_id'";
                $qe = $pdo->prepare($query_ams_setting);
                $qe->execute(array());
                $data = $qe->fetch(PDO::FETCH_ASSOC); 
                $categoryname = $data['name'];  
             ?> 

                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i><strong><?php echo $row['name']; ?></strong></i><?php echo '<a href="main_new_livestock_selected_breed.php?animal_breed_id='. $row['id'] .'&user_key=<?php echo $userhashid?>">'?><button data-toggle="tooltip" title="Register <?php echo $row['name']; ?> breed" type="button" class="btn btn-success btn-xs pull-right">
                                <i class="fa fa-plus"> </i> </i> Add
                              </button><?php echo '</a>'?> </h4> 
                            <div class="left col-xs-7">
                              <p><strong>Category: <?php echo !empty($categoryname)?$categoryname:''; ?></strong></p>
                              <p><strong>Production: <?php echo $row['productiontype']; ?> </strong></p>
                              <ul class="list-unstyled">
                                <p>Added: <?php echo $row['added']; ?></p>
                                <p>Modified: <?php echo $row['modified']; ?></p>  
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="images/<?php echo $row['icon'] ?>" alt=" Icon" class="img-rounded profile-user-img img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <p class="ratings">
                                <a>Origin: </a>
                                <strong><a href="#"><?php echo !empty($countryname)?$countryname:''; ?></a></strong> 
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <?php echo '<a href="main_animal_edit.php?animal_id='. $row['id'] .'">'?><button data-toggle="tooltip" title="View | Edit <?php echo $row['name']; ?> details" type="button" class="btn btn-dark btn-xs">
                                <i class="fa fa-edit"> </i> </i> Edit
                              </button><?php echo '</a>'?> 
                               <a onclick="deleteLivestock(<?php echo $row['id']; ?>);" href="javascript:;" data-toggle="tooltip" title="Delete <?php echo $row['name']; ?>"><button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i>
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
    var iAnswer = confirm("Are you sure you want to delete the selected breed?"); 
  if(iAnswer){
    window.location = 'main_pure_breeds_display.php?id=' + Id;
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

  $selected_pure_breed_id = $_GET['selected_pure_breed_id'];

  /*$selected_pure_breed_id = null;
  if ( !empty($_GET['selected_pure_breed_id'])) {
    $selected_pure_breed_id = $_REQUEST['selected_pure_breed_id'];
  }*/
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_breeds` WHERE id = '$selected_pure_breed_id'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $productname = $data['name'];
    MyData::disconnect();

?>    
 

                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><?php echo !empty($productname)?$productname:''; ?></h4>
                        </div>
                        <div class="modal-body">
                          <h4>Text in a modal</h4>
                          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                          <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals --> 