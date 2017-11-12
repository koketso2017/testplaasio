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
    $sql = "DELETE FROM `categories` WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="1;main_categories_display.php?cat_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Products Categories <small>Farmers index</small></h3>
              </div>
                    
                  <?php
        if(isset($_GET['cat_sucess']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='  color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Product Category !</strong>  successfully registered.
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
 
        if(isset($_GET['cat_sucess_delete']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> Delete Comfimation !</strong>  product successfully removed from list.
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
                    <medium><a href="index.php">Dashboard</a> <i class="fa fa-play-circle"></i> <a href="main_categories_display.php">Categories</a> <i class="fa fa-play-circle"></i> <b>Product index <?php echo !empty($alphabetid)?$alphabetid:''; ?></b></medium>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="myproducts_categories_add.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button><?php echo '</a>'?></li> 
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
                          <li><a href="main_categories_display_by_alphabet.php?alphabetid=<?php echo $row['name']?>&user_key=<?php echo $userhashid?>"><?php echo $row['name']?></a></li> 
                        </ul>
                      <?php } ?>
                      </div>   

                      <div class="clearfix"></div>
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM categories WHERE name LIKE '$alphabetid%'";
             foreach ($pdo->query($sql) as $row) {     
                $category = $row['category'];
                $categrynname= $row['name']; 
                $categrynid= $row['id']; 

if ($result60 = mysqli_query($con, "SELECT id FROM products WHERE categoryid = '$categrynid' ORDER BY id")) {

    /* determine number of rows result set */
    $row_cnt60 = mysqli_num_rows($result60);

    //printf("%d \n", $row_cnt);
    $cont60 = $row_cnt60;
    /* close result set */
    mysqli_free_result($result60);
}
             ?> 

                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                          <?php
                          if ($category == 'livestock') {
                            ?>
                            <h4 class="brief"><i><strong><a href="main_pure_breeds_display_by_category.php?categoryname=<?php echo $row['id']?>&user_key=<?php echo $userhashid?>"><?php echo $row['name']?></a></strong></i></h4>
                            <?php
                          }if ($category == 'crops'){
                          ?>
                            <h4 class="brief"><i><strong><?php echo $row['name']; ?></strong></i></h4>
                          <?php  
                          }if ($category == 'vegetables'){
                          ?>
                            <h4 class="brief"><i><strong><?php echo $row['name']; ?></strong></i></h4>
                          <?php  
                          }if ($category == 'other'){
                            ?>
                            <h4 class="brief"><i><strong><?php echo $row['name']; ?></strong></i></h4>
                            <?php
                          }
                          ?>
                            <div class="left col-xs-7">
                              <p><strong>Category: <?php echo $row['category']; ?></strong></p> 
                              <ul class="list-unstyled">
                                <p>Added: <?php echo $row['created']; ?></p>
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
                                <a>Managed : </a> 
                                <?php
                                if ($cont60 == '') {
                                  ?>
                                <strong><a href="#">0</a></strong>
                                  <?php
                                }else{
                                ?>
                                <strong><a href="#"><?php echo !empty($cont60)?$cont60:''; ?></a></strong>
                                  <?php
                                }
                                ?>
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <?php echo '<a href="myproducts_categories_edit.php?product_id='. $row['id'] .'">'?><button data-toggle="tooltip" title="View | Edit <?php echo $row['name']; ?> details" type="button" class="btn btn-dark btn-xs">
                                <i class="fa fa-edit"> </i> </i> Edit
                              </button><?php echo '</a>'?> 
                               <a onclick="deleteProductCategory(<?php echo $row['id']; ?>);" href="javascript:;" data-toggle="tooltip" title="Delete <?php echo $row['name']; ?>"><button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i>
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
  function deleteProductCategory(Id){
    var iAnswer = confirm("Are you sure you want to delete this product category?"); 
  if(iAnswer){
    window.location = 'main_categories_display.php?id=' + Id;
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