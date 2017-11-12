<?php
  require_once 'main.php';

  if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
   $pid = null;
    if ( !empty($_GET['id'])) {
    $pid = $_REQUEST['id'];
   }
 
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM `plaas_cross_breeds` WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="1;animal_breed_cross_list.php?breed_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Cross Breeds <small>Livestock index</small></h3>
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
                    <h2>Animals <small>domestic | origin | breeds</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="animal_breed_cross_add.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content"> 
                    
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
         <strong> Comfirmation !</strong>  Cross breed successfully registered.
         </div>
         ";  
    }


        if(isset($_GET['breed_error']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #E77471;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Cross breed Error!</strong>  uknown error occured during registration.
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
             <?php if(isset($msgcx)) echo $msgcx;  ?>
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings" style="background-color: #7F5217;"> 
                            <th class="column-title">Icon</th>
                            <th class="column-title">Name</th>
                            <th class="column-title">Category</th>
                            <th class="column-title">Production</th>
                            <th class="column-title">Cross A</th>
                            <th class="column-title">Cross B</th>
                            <th class="column-title">Origin</th>    
                            <th class="column-title">Added </th>
                            <th class="column-title">Modified </th> 
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th> 
                          </tr>
                        </thead>

                        <tbody> 
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM plaas_cross_breeds order by modified DESC";
             foreach ($pdo->query($sql) as $row) { 
                $category_id = $row['categoryid'];
                $countryorigin = $row['countryoforigin'];
                $breeda = $row['cross_a'];
                $breedb = $row['cross_b'];
             
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
             
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query_ams_settingx = "SELECT * FROM plaas_breeds WHERE id = '$breeda'";
                $qx = $pdo->prepare($query_ams_settingx);
                $qx->execute(array());
                $data = $qx->fetch(PDO::FETCH_ASSOC); 
                $breadaname = $data['name']; 
             
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query_ams_settingr = "SELECT * FROM plaas_breeds WHERE id = '$breedb'";
                $qr = $pdo->prepare($query_ams_settingr);
                $qr->execute(array());
                $data = $qr->fetch(PDO::FETCH_ASSOC); 
                $breadbname = $data['name']; 
             ?>
                <tr>  
                    <td><img src="images/<?php echo $row['icon'] ?>" class="img-rounded profile-user-img img-responsive"></td> 
                    <td><b><?php echo $row['name']; ?></b></td>
                    <td><?php echo !empty($categoryname)?$categoryname:''; ?></td> 
                    <td><?php echo $row['productiontype']; ?></td> 
                    <td><?php echo !empty($breadbname)?$breadaname:''; ?></td>
                    <td><?php echo !empty($breadaname)?$breadbname:''; ?></td>
                    <td><?php echo !empty($countryname)?$countryname:''; ?></td> 
                    <td><?php echo $row['added']; ?></td>
                    <td><?php echo $row['modified']; ?></td>
                    <td>
                    <?php echo '<a href="main_animal_cross_edit.php?animal_id='. $row['id'] .'">'?><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button><?php echo '</a>'?>  
                    <a class="btn btn-danger" onclick="deleteCrossLivestock(<?php echo $row['id']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i class="fa fa-trash-o"></i></a>
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
  function deleteCrossLivestock(Id){
    var iAnswer = confirm("Are you sure you want to delete the selected breed?"); 
  if(iAnswer){
    window.location = 'animal_breed_cross_list.php?id=' + Id;
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