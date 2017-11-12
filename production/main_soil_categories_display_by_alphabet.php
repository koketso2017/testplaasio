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

    $succd = 'cat_sucess_delete';
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM `plaas_soil` WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="1;main_soil_categories_display.php?soil_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Soil Categories <small>textures index</small></h3>
              </div>
                    
                  <?php
        if(isset($_GET['soil_sucess']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='  color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Comfirmation !</strong>  soil successfully registered.
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
 
        if(isset($_GET['soil_sucess_delete']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> Delete Comfimation !</strong>  soil successfully removed from list.
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
                    <medium><a href="index.php">Dashboard</a> <i class="fa fa-play-circle"></i> <a href="main_soil_categories_display.php">Soil Types</a> <i class="fa fa-play-circle"></i> Displaying <b><?php echo !empty($alphabetid)?$alphabetid:''; ?></b> index soli type</medium>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_soil_add.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button><?php echo '</a>'?></li> 
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
                          <li><a href="main_soil_categories_display_by_alphabet.php?alphabetid=<?php echo $row['name']?>&user_key=<?php echo $userhashid?>"><?php echo $row['name']?></a></li> 
                        </ul>
                      <?php }  ?> 
                      </div>   

                      <div class="clearfix"></div>
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM plaas_soil WHERE name LIKE '$alphabetid%'";
             foreach ($pdo->query($sql) as $row) {  
                $categrynname= $row['name']; 
                $categrynid= $row['id']; 

if ($result601 = mysqli_query($con, "SELECT id FROM plaas_soil ORDER BY id")) {

    /* determine number of rows result set */
    $row_cnt601 = mysqli_num_rows($result601);

    //printf("%d \n", $row_cnt);
    $cont601 = $row_cnt601;
    /* close result set */
    mysqli_free_result($result601);
}
             ?> 

                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12"> 
                            <h4 class="brief" style="font-style: italic; color: red; text-decoration: underline;"><i><strong><a href="#main_soil_display_by_category.php?categoryname=<?php echo $row['id']?>&user_key=<?php echo $userhashid?>"><?php echo $row['name']?></a></strong></i></h4>  
                            <div class="left col-xs-7"> 
                              <ul class="list-unstyled"><br>
                                <p>Added: <?php echo $row['added']; ?></p><br>
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
                                <a>Category - </a> 
                                <strong><a href="#">soil</a></strong>
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <?php echo '<a href="main_soil_edit.php?soil_id='. $row['id'] .'">'?><button data-toggle="tooltip" title="View | Edit <?php echo $row['name']; ?> details" type="button" class="btn btn-dark btn-xs">
                                <i class="fa fa-edit"> </i> </i> Edit
                              </button><?php echo '</a>'?> 
                               <a onclick="deleteSoil(<?php echo $row['id']; ?>);" href="javascript:;" data-toggle="tooltip" title="Delete <?php echo $row['name']; ?>"><button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i>
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
  function deleteSoil(Id){
    var iAnswer = confirm("Are you sure you want to delete the selected soil type?"); 
  if(iAnswer){
    window.location = 'main_soil_categories_display.php?id=' + Id;
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