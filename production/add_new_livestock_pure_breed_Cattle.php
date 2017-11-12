<?php
  require_once 'main_public.php';

  $mypurebreedid = null;
  if ( !empty($_GET['livestock_category_id'])) {
    $mypurebreedid = $_REQUEST['livestock_category_id'];
  }

  if ( null==$mypurebreedid ) {
   echo '<meta content="2;add_new_livestock.php?selection_id_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  }
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Livestock <small> pure breeds</small> </h3>
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

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Animals <small> <a href="add_new_livestock.php">Livestock selection</a> <i class="fa fa-chevron-right"></i> <a href="#">breed selection</a></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                    <?php    
                      $pdo = MyData::connect(); 
                      $sql = "SELECT * FROM plaas_breeds WHERE categoryid = '$mypurebreedid' order by id DESC";
                              foreach ($pdo->query($sql) as $row) {   
                              $procat = $row['categoryid'];
                      ?> 
                       
                      <?php echo '<a href="add_new_livestock_selected_breed_Cattle.php?livestock_category_id='. $row['id'] .'&selected_product_category='. $procat . '">'?>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style=" display: block;" src="images/<?php echo $row['icon'] ?>" alt="icon" />
                            <div class="mask">
                              <p style="text-align: left;"><?php echo $row['description']; ?></p>
                              <div class="tools tools-bottom">
                                <a href="#"><img style="width: 25%; height: 25%;" src="images/<?php echo $row['icon'] ?>"></a> 
                              </div>
                            </div>
                          </div>
                          <div class="caption" style="margin-top: -2%;">
                            <p style="font-weight: bold;"><?php echo $row['name']; ?></p>
                            <p style=""><i class="fa fa-circle"></i> Female: 0 <br><i class="fa fa-bullseye"></i> Male: 0</p><br><br>
                          </div>
                        </div>
                      </div>
                     <?php echo '</a>'?>  
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
        <!-- /page content --> 

<?php
  require_once 'footer.php';
?>    