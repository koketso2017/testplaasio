<?php
  require_once 'main_public.php';
  
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
                    <medium><a href="index.php">Dashboard</a> <i class="fa fa-play-circle"></i> <a href="public_pure_breeds_display.php">Pure Breeds</a> <i class="fa fa-play-circle"></i> Displaying <b><?php echo !empty($alphabetid)?$alphabetid:''; ?></b> index pure breeds</medium> 
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
                          <li><a href="public_pure_breeds_display_by_alphabet.php?alphabetid=<?php echo $row['name']?>&user_key=<?php echo $userhashid?>"><?php echo $row['name']?></a></li> 
                        </ul>
                      <?php }

                        $query="SELECT * FROM categories WHERE category = 'Livestock'";
                        $result= $con->query($query);
                       ?>     
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <ul class="pagination pagination-split alert-default" data-toggle="tooltip" title="Display by category <?php echo $row['name']?>">
                          <li><a href="public_pure_breeds_display_by_category.php?categoryname=<?php echo $row['id']?>&user_key=<?php echo $userhashid?>"><?php echo $row['name']?></a></li> 
                        </ul>
                      <?php } ?> 
                      </div>   

                      <div class="clearfix"></div>
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM plaas_breeds WHERE name LIKE '$alphabetid%'";
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
                            <h4 class="brief"><i><strong><?php echo $row['name']; ?></strong></i></h4>
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
                              <?php echo '<a href="#.php?animal_id='. $row['id'] .'">'?><button data-toggle="tooltip" title="View | More <?php echo $row['name']; ?> details" type="button" class="btn btn-dark btn-xs pull-right">
                                <i class="fa fa-edit"> </i> </i> More
                              </button><?php echo '</a>'?>  
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
?>    