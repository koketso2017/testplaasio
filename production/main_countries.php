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
    $sql = "DELETE FROM `plaas_countries` WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pid));   
    echo '<meta content="1;main_countries.php?cou_sucess_delete" http-equiv="refresh" />';
    MyData::disconnect(); 
} 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Countries <small>International index</small></h3>
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
                    <h2>International <small>countries | population | currency</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_country_add.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-plus"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content"> 
                    
   <?php
        if(isset($_GET['cou_sucess']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='  color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Country !</strong>  successfully registered.
         </div>
         ";  
    }


        if(isset($_GET['country_idupd_error']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #E77471;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Country Error!</strong>  uknown error occured during update.
         </div>
         ";  
    }


        if(isset($_GET['cou_error']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #E77471;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Country Error!</strong>  uknown error occured during registration.
         </div>
         ";  
    }

        if(isset($_GET['country_id_error']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #E77471;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px;
  width: 100%;'> 
         <strong> Country Error!</strong>  country selection error.
         </div>
         ";  
    }
 
        if(isset($_GET['cou_sucess_delete']))
    {  
      $msgcx = "
         <div class='alert alert-success' style='color: #000C2C;
  background-color: #99C68E;
  border-color: #d6e9c6;
  margin-left: 0%;
  border-radius: 4px; '> 
         <strong> Delete Comfimation !</strong>  country successfully removed from list.
         </div>
         ";    
    }
    ?>
             <?php if(isset($msgcx)) echo $msgcx;  ?> 
            <?php    
             $pdo = MyData::connect(); 
             $sql = "SELECT * FROM plaas_countries order by modified DESC";
             foreach ($pdo->query($sql) as $row) { 
                $cont = $row['continent']; 
             
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query_ams_settings = "SELECT * FROM plaas_continents WHERE id = '$cont'";
                $q = $pdo->prepare($query_ams_settings);
                $q->execute(array());
                $data = $q->fetch(PDO::FETCH_ASSOC); 
                $contname = $data['name'];
             ?> 

                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i><strong><?php echo $row['name']; ?></strong></i></h4>
                            <div class="left col-xs-7">
                              <p><strong>Population: <?php echo $row['population']; ?></strong></p>
                              <p><strong>Area: <?php echo $row['area']; ?> <?php echo !empty($distancesymbol)?$distancesymbol:''; ?>²</strong> </p>
                              <ul class="list-unstyled">
                                <p>Language: <?php echo $row['language']; ?></p>
                                <p>Currency: <strong><?php echo $row['currency']; ?></strong></p> 
                                <u><i><b><?php echo '<a style="color: #5C5858;" href="main_countries_view_by_continent.php?continent_id='. $cont .'&user_key='. $userhashid .'">'?><p>Continent: <?php echo !empty($contname)?$contname:''; ?></p> <?php echo '</a>'?></u></b></i>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="images/<?php echo $row['flag'] ?>" class="img profile-user-img img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <p class="ratings">
                                <a>Call-Code: </a>
                                <strong><a href="#"><?php echo $row['callcode']; ?></a></strong> 
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <?php echo '<a href="main_country_edit.php?country_id='. $row['id'] .'">'?><button data-toggle="tooltip" title="View | Edit <?php echo $row['name']; ?> details" type="button" class="btn btn-dark btn-xs">
                                <i class="fa fa-edit"> </i> </i> Edit
                              </button><?php echo '</a>'?> 
                               <a onclick="deleteCountry(<?php echo $row['id']; ?>);" href="javascript:;" data-toggle="tooltip" title="Delete <?php echo $row['name']; ?>"><button type="button" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i>
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
  function deleteCountry(Id){
    var iAnswer = confirm("Are you sure you want to delete this country?"); 
  if(iAnswer){
    window.location = 'main_countries.php?id=' + Id;
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