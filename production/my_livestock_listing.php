<?php
  require_once 'main_public.php';

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
              <?php
               require_once 'search.php';
              ?>
            </div> 

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Farming <small>space | size | production</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="add_new_livestock.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
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
                            <th class="column-title">Product</th>
                            <th class="column-title">TagID</th>  
                            <th class="column-title">Maturity </th> 
                            <th class="column-title">Farm </th>
                            <th class="column-title">Total </th> 
                            <th class="column-title">Added </th>
                            <th class="column-title">Modified </th> 
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th> 
                          </tr>
                        </thead>

                        <tbody> 
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM products WHERE userid = '$userid' order by modified DESC";
             foreach ($pdo->query($sql) as $row) {   
              $picdisp = $row['image'];   
              $procategory = $row['categoryid'];
              $prosex = $row['sex'];
              $profarm = $row['farmID'];
              $prolstidC = $row['lastbreedid'];
              $prolstidB = $row['secondbreed'];
              $prolstidA = $row['firstbreed'];

              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql1 = "SELECT * FROM `categories` WHERE id = '$procategory'";
              $q1 = $pdo->prepare($sql1);
              $q1->execute(array());
              $data = $q1->fetch(PDO::FETCH_ASSOC);
              $proimage= $data['icon'];
              $prodspname= $data['name'];

              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql2 = "SELECT * FROM `plaas_animal_sex` WHERE id = '$prosex'";
              $q2 = $pdo->prepare($sql2);
              $q2->execute(array());
              $data = $q2->fetch(PDO::FETCH_ASSOC);
              $prosexname= $data['sex'];

              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql3= "SELECT * FROM `plaas_data_farm` WHERE farmID = '$profarm'";
              $q3 = $pdo->prepare($sql3);
              $q3->execute(array());
              $data = $q3->fetch(PDO::FETCH_ASSOC);
              $profarmname= $data['farmname'];

              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql4= "SELECT * FROM `plaas_breeds` WHERE id = '$prolstidA'";
              $q4 = $pdo->prepare($sql4);
              $q4->execute(array());
              $data = $q4->fetch(PDO::FETCH_ASSOC);
              $profirstbrmname= $data['name'];

              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql5= "SELECT * FROM `plaas_cross_breeds` WHERE id = '$prolstidB'";
              $q5 = $pdo->prepare($sql5);
              $q5->execute(array());
              $data = $q5->fetch(PDO::FETCH_ASSOC);
              $prosecondbrmname= $data['name'];

              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql6= "SELECT * FROM `plaas_hy_breeds` WHERE id = '$prolstidC'";
              $q6 = $pdo->prepare($sql6);
              $q6->execute(array());
              $data = $q6->fetch(PDO::FETCH_ASSOC);
              $prothirdbrmname= $data['name'];
             ?>
                <tr>
                    <?php
                    if ($picdisp == '') {
                      ?>
                        <td><img src="images/<?php echo !empty($proimage)?$proimage:''; ?>" class="img-rounded profile-user-img img-responsive"></td> 
                      <?php
                    }else {
                      ?>
                        <td><img src="images/<?php echo !empty($picdisp)?$picdisp:''; ?>" class="img-rounded profile-user-img img-responsive"></td> 
                      <?php
                    }
                    ?>  
                    <td><?php echo !empty($prodspname)?$prodspname:''; ?></td>
                    <td><?php echo $row['tagid']; ?></td> 
                    <td><?php echo !empty($prosexname)?$prosexname:''; ?></td> 
                    <td><?php echo !empty($profarmname)?$profarmname:''; ?></td> 
                    <td><?php echo $row['total']; ?></td> 
                    <td><?php echo $row['created']; ?></td>
                    <td><?php echo $row['modified']; ?></td>
                    <td>
                    <?php echo '<a href="myfarm_edit.php?myfarm_id='. $row['id'] .'">'?><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button><?php echo '</a>'?>  
                    <a class="btn btn-danger" onclick="deleteFarm(<?php echo $row['id']; ?>);" href="javascript:;" data-original-title="Delete Farm"><i class="fa fa-trash-o"></i></a>
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
    window.location = 'myfarms.php?id=' + Id;
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