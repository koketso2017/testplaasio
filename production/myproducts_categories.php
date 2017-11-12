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
    $sql = "DELETE FROM `categories` WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="1;myproducts_categories.php?cat_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Categories <small>products index</small></h3>
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
                    <h2>Products <small>Crops | Livestock | Vegetables</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="myproducts_categories_add.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content"> 
                    
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
         <strong> DELETE Comfimation !</strong>  product successfully removed from list.
         </div>
         ";    
    }
    ?>
             <?php if(isset($msgcx)) echo $msgcx;  ?>
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings" style="background-color: #7F5217;"> 
                            <th class="column-title">Icon </th>
                            <th class="column-title">Name </th>
                            <th class="column-title">Category </th> 
                            <th class="column-title">Description </th>
                            <th class="column-title">Added Date </th>
                            <th class="column-title">Modified </th> 
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th> 
                          </tr>
                        </thead>

                        <tbody> 
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM categories order by modified DESC";
             foreach ($pdo->query($sql) as $row) { 
             ?>
                <tr>  
                    <td><img src="images/<?php echo $row['icon'] ?>" class="img-rounded profile-user-img img-responsive"></td> 
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td style="width: 35%;"><?php echo $row['description']; ?></td> 
                    <td><?php echo $row['created']; ?></td>
                    <td><?php echo $row['modified']; ?></td>
                    <td>
                    <?php echo '<a href="myproducts_categories_edit.php?product_id='. $row['id'] .'">'?><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button><?php echo '</a>'?>  
                    <a class="btn btn-danger" onclick="deleteProductCategory(<?php echo $row['id']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i class="fa fa-trash-o"></i></a>
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
  function deleteProductCategory(Id){
    var iAnswer = confirm("Are you sure you want to delete this product category?"); 
  if(iAnswer){
    window.location = 'myproducts_categories.php?id=' + Id;
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