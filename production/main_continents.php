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
    $sql = "DELETE FROM `plaas_continents` WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="1;main_continents.php?cont_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Continents <small>globe index</small></h3>
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
                    <h2>Globe <small>area | population | countries</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_continent_add.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content"> 
                    
   <?php
        if(isset($_GET['cont_sucess']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='  color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Continent !</strong>  successfully registered.
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
 
        if(isset($_GET['cont_sucess_delete']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> DELETE Comfimation !</strong>  Continent successfully removed from list.
         </div>
         ";    
    }
    ?>
             <?php if(isset($msgcx)) echo $msgcx;  ?> 
             <?php
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM plaas_continents order by modified DESC";
             foreach ($pdo->query($sql) as $row) { 
             ?> 

                      <div class="col-md-6 col-sm-6 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i><strong><?php echo $row['name']; ?></strong></i></h4>
                            <div class="left col-xs-7">
                              <p><strong>Populations: <?php echo $row['population']; ?></strong></p>
                              <p><strong>Number Of Countries: <?php echo $row['nofcountries']; ?> </strong></p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-clock-o"></i> Registered: <?php echo $row['added']; ?></li>
                                <li><i class="fa fa-check-circle-o"></i> Modified: <?php echo $row['modified']; ?></li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="images/<?php echo $row['icon'] ?>" alt="Continent Icon" class="img-rounded img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <p class="ratings">
                                <a>Area</a>
                                <a href="#"> <strong><?php echo $row['area']; ?> <?php echo !empty($distancesymbol)?$distancesymbol:''; ?>²</strong></a> 
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis"> 
                              <?php echo '<a href="main_continent_edit.php?continent_id='. $row['id'] .'">'?><button data-toggle="tooltip" title="View or Edit <?php echo $row['name']; ?> details" type="button" class="btn btn-dark btn-xs">
                                <i class="fa fa-edit"> </i> View <i class="fa fa-eye"> </i> Edit
                              </button><?php echo '</a>'?> 
                               <a onclick="deleteContinent(<?php echo $row['id']; ?>);" href="javascript:;" data-toggle="tooltip" title="Delete <?php echo $row['name']; ?>"><button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i>
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
        <!-- /page content -->
<script type="text/javascript">
  function deleteContinent(Id){
    var iAnswer = confirm("Are you sure to delete selected continent?"); 
  if(iAnswer){
    window.location = 'main_continents.php?id=' + Id;
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
 