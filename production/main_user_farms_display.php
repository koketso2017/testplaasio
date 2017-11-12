<?php
  require_once 'main.php';

  if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
   $pid = null;
    if ( !empty($_GET['id'])) {
    $pid = $_REQUEST['id'];
   }
 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM `plaas_data_farm` WHERE farmID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="1;main_user_farms_display.php?farm_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Farms <small>Location index</small></h3>
              </div>
                    
                  <?php
                    if(isset($_GET['farm_add_sucess']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #99C68E; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Farm add comfirmation !</strong>  New Farm successfully registered.
                         </div>
                         ";    
                       }
               
                    if(isset($_GET['farm_add_error']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #E77471; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Farm error !</strong> error occured while registering new farm.
                         </div>
                         ";    
                       } 
 
        if(isset($_GET['farm_sucess_delete']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> Delete Comfimation !</strong>  farm successfully removed from list.
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
                    <medium><a href="index.php">Dashboard</a> <i class="fa fa-play-circle"></i> <b>Displaying random 30 farmers locations</b></medium>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_farm_listing_add.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button><?php echo '</a>'?></li> 
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
                          <li><a href="main_user_farms_display_by_alphabet.php?alphabetid=<?php echo $row['name']?>&user_key=<?php echo $userhashid?>"><?php echo $row['name']?></a></li> 
                        </ul>
                      <?php } ?> 
                      </div> 

                      <div class="clearfix"></div>
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM plaas_data_farm order by RAND() LIMIT 30";
             foreach ($pdo->query($sql) as $row) {    
              $pictest = $row['category'];   
              $farmuserid = $row['userid'];

              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql1 = "SELECT * FROM `plaas_accounts` WHERE id = '$farmuserid'";
              $q1 = $pdo->prepare($sql1);
              $q1->execute(array());
              $data = $q1->fetch(PDO::FETCH_ASSOC);
              $usermail= $data['email_address'];

              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql1 = "SELECT * FROM `plaas_user_setings` WHERE userid = '$farmuserid'";
              $q1 = $pdo->prepare($sql1);
              $q1->execute(array());
              $data = $q1->fetch(PDO::FETCH_ASSOC);
              $fmdistanceid= $data['distanceid']; 

              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql1 = "SELECT * FROM `plaas_metrics` WHERE id = '$fmdistanceid'";
              $q1 = $pdo->prepare($sql1);
              $q1->execute(array());
              $data = $q1->fetch(PDO::FETCH_ASSOC);
              $fmdistancesmb= $data['sysmbol'];  
             ?> 

                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i><strong><?php echo $row['farmname']; ?></strong></i></h4>
                            <div class="left col-xs-7">
                              <p><strong>Location: <?php echo $row['location']; ?></strong></p>
                              <p><strong>Village: <?php echo $row['village']; ?></strong> </p>
                              <ul class="list-unstyled">
                                <p>Country: <?php echo $row['country']; ?></p>
                                <p>REF: <b><?php echo !empty($usermail)?$usermail:''; ?></b></p>  
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="images/<?php echo $row['icon'] ?>" alt=" Icon" class="img-rounded profile-user-img img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <p class="ratings">
                                <a>Area: </a>
                                <strong><a href="#"><?php echo $row['areasize']; ?> <?php echo !empty($fmdistancesmb)?$fmdistancesmb:''; ?>²</a></strong> 
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <?php echo '<a href="main_farm_listing_edit.php?myfarm_id='. $row['farmID'] .'">'?><button data-toggle="tooltip" title="View | Edit <?php echo $row['farmname']; ?> details" type="button" class="btn btn-dark btn-xs">
                                <i class="fa fa-edit"> </i> </i> Edit
                              </button><?php echo '</a>'?> 
                               <a onclick="deleteFarm(<?php echo $row['farmID']; ?>);" href="javascript:;" data-toggle="tooltip" title="Delete <?php echo $row['farmname']; ?>"><button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i>
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
  function deleteFarm(Id){
    var iAnswer = confirm("Are you sure you want to delete selected farm details?"); 
  if(iAnswer){
    window.location = 'main_user_farms_display.php?id=' + Id;
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