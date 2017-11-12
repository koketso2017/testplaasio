<?php
  require_once 'main.php';

  if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
   $pid = null;
    if ( !empty($_GET['id'])) {
    $pid = $_REQUEST['id'];
   }

    $succd = 'cat_sucess_delete';
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM `plaas_data_farm` WHERE farmID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="1;myfarms.php?farm_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Farms <small>farming location index</small></h3>
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
                    <h2>Farming <small>space | size | production</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_farm_listing_add.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
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

             <?php if(isset($msgcx)) echo $msgcx;  ?>
                  <div class="x_content">  
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings" style="background-color: #7F5217;"> 
                            <th class="column-title">Icon</th> 
                            <th class="column-title">Name</th>
                            <th class="column-title">Production</th>  
                            <th class="column-title">Location </th> 
                            <th class="column-title">Village </th>
                            <th class="column-title">Country </th>
                            <th class="column-title">Area(<?php echo !empty($distancesymbol)?$distancesymbol:''; ?>²)</th>  
                            <th class="column-title">User </th>
                            <th class="column-title">Modified </th> 
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th> 
                          </tr>
                        </thead>

                        <tbody> 
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM plaas_data_farm order by modified DESC";
             foreach ($pdo->query($sql) as $row) {   
              $pictest = $row['category'];   
              $farmuserid = $row['userid'];

              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql1 = "SELECT * FROM `plaas_accounts` WHERE id = '$farmuserid'";
              $q1 = $pdo->prepare($sql1);
              $q1->execute(array());
              $data = $q1->fetch(PDO::FETCH_ASSOC);
              $usermail= $data['email_address']; 
             ?>
                <tr>
                    <?php
                    if ($pictest == 'vegetables') {
                      ?>
                        <td><img src="images/gardening-icons-collection_1324-47.jpg" class="img-rounded profile-user-img img-responsive"></td> 
                      <?php
                    }
                    if ($pictest == 'livestock') {
                      ?>
                        <td><img src="images/farm-animals-silhouettes_1051-929.jpg" class="img-rounded profile-user-img img-responsive"></td> 
                      <?php
                    }
                    if ($pictest == 'crops') {
                      ?>
                        <td><img src="images/farm-animals-silhouettes_1051-929.jpg" class="img-rounded profile-user-img img-responsive"></td> 
                      <?php
                    }
                    if ($pictest == 'crops, vegetables & livestock') {
                      ?>
                        <td><img src="images/farm-animals-silhouettes_1051-929.jpg" class="img-rounded profile-user-img img-responsive"></td> 
                      <?php
                    }
                    if ($pictest == 'other') {
                      ?>
                        <td><img src="images/farm-animals-silhouettes_1051-929.jpg" class="img-rounded profile-user-img img-responsive"></td> 
                      <?php
                    }
                    ?>  
                    <td><?php echo $row['farmname']; ?></td> 
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['location']; ?></td> 
                    <td><?php echo $row['village']; ?></td> 
                    <td><?php echo $row['country']; ?></td> 
                    <td><?php echo $row['areasize']; ?></td> 
                    <td><?php echo !empty($usermail)?$usermail:''; ?></td>
                    <td><?php echo $row['modified']; ?></td>
                    <td>
                    <?php echo '<a href="main_farm_listing_edit.php?myfarm_id='. $row['farmID'] .'">'?><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button><?php echo '</a>'?>  
                    <a class="btn btn-danger" onclick="deleteFarm(<?php echo $row['farmID']; ?>);" href="javascript:;" data-original-title="Delete Farm"><i class="fa fa-trash-o"></i></a>
                    </td>  
                </tr>
                <?php
                }
                MyData::disconnect();
                ?>   
                        </tbody>
                      </table>
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
    window.location = 'main_farm_listing_edit.php?id=' + Id;
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