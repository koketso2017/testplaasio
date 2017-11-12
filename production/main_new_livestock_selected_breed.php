<?php
  require_once 'main.php'; 

  $mypurebreedid = null;
  if ( !empty($_GET['animal_breed_id'])) {
    $mypurebreedid = $_REQUEST['animal_breed_id'];
  } 

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_breeds` WHERE id = '$mypurebreedid'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $categoname= $data['categoryid'];
    $bredname= $data['name'];

    $sql = "SELECT * FROM `categories` WHERE id = '$categoname'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $categonamea= $data['name'];

  if ( null==$mypurebreedid ) {
   echo '<meta content="2;add_new_livestock.php?selection_id_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
  }

    $liveuniqueidsel=md5($country). rand(9000, 20080) . 'PL' . time() . 'S';
    $livetaggaingsel=rand(1000, 200) . 'PL' . time() . 'S';
?>
<script language="javascript" type="text/javascript">
function getXMLHTTP() {
    var xmlhttp=false;  
    try{
      xmlhttp=new XMLHttpRequest();
    }
    catch(e)  {   
      try{      
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e){
        try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e1){
          xmlhttp=false;
        }
      }
    }
      
    return xmlhttp;
    }
  
  function getUser(useridId) {    
    
    var strURL="findUser.php?userid="+useridId;
    var req = getXMLHTTP();
    
    if (req) {
      
      req.onreadystatechange = function() {
        if (req.readyState == 4) {
          // only if "OK"
          if (req.status == 200) {            
            document.getElementById('statediv').innerHTML=req.responseText;         
          } else {
            alert("Problem while using XMLHTTP:\n" + req.statusText);
          }
        }       
      }     
      req.open("GET", strURL, true);
      req.send(null);
    }   
  } 
</script>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Livestock <small> pure breed registration</small> </h3>
              </div>
              <?php
               require_once 'search.php';
              ?>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo !empty($categonamea)?$categonamea:''; ?> <small> <a href="main_pure_breeds_display.php">Livestock selection</a> <i class="fa fa-chevron-right"></i> <?php echo '<a href="main_pure_breeds_display_by_category.php?categoryname='. $categoname .'&user_key=<?php echo $userhashid?>">'?> <?php echo !empty($categonamea)?$categonamea:''; ?> breeds selection <?php echo '</a>'?> <i class="fa fa-chevron-right"></i> <b><a href="#"><?php echo !empty($bredname)?$bredname:''; ?></a></b></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><?php echo '<a href="main_products_display.php">'?><button type="button" class="btn btn-dark"><i class="fa fa-list"></i></button><?php echo '</a>'?></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left input_mask" method="POST">  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Tracking chip identification number attached the product" type="text" style="width: 100%;" name="prcid" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Tracking chip identification number attached the product" value="<?php echo !empty($liveuniqueidsel)?$liveuniqueidsel:''; ?>">
                        <span class="fa fa-sliders form-control-feedback left" aria-hidden="true"></span>
                      </div>   
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea data-toggle="tooltip" title="Tag or branding identification number attached the product" rows="3" style="width: 100%;" name="prtid" class="resizable_textarea form-control" placeholder="Tag or branding identification number attached the product"><?php echo !empty($livetaggaingsel)?$livetaggaingsel:''; ?></textarea>
                       </div>
                      </div>  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Product size in <?php echo !empty($weightname)?$weightname:''; ?> | <?php echo !empty($weightsymbol)?$weightsymbol:''; ?>" type="text" style="width: 100%;" name="prsiz" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Product size in <?php echo !empty($weightname)?$weightname:''; ?> | <?php echo !empty($weightsymbol)?$weightsymbol:''; ?>" value="">
                        <span class="fa fa-anchor form-control-feedback left" aria-hidden="true"></span>
                      </div>  
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Product color" type="text" style="width: 100%;" name="prcol" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Product color" value="">
                        <span class="fa fa-spinner form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_animal_sex WHERE categoryid = '$categoname'";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Maturity selection" style="width: 100%;" class="form-control" name="prsex" id="inputEmail3">
                       <option value="">Select animal maturity</option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['id']?>><?php echo $row['sex']?></option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >  
                       <?php  
                        $query="SELECT * FROM products WHERE categoryid = '$categoname'";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Select birth chain" style="width: 100%;" class="form-control" name="prbrthch" id="inputEmail3">
                        <option value="">Select Mother / Father</option>
                        <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <option value=<?php echo $row['id']?>><?php echo $row['tagid']?> - <?php echo $row['chipid']?></option>
                        <?php } ?>
                       </select> 
                      </div>   
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >   
                       <select data-toggle="tooltip" title="selected product relationship" style="width: 100%;" class="form-control" name="prbrtrl" id="inputEmail3">
                        <option value="">Select product relationship</option> 
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option> 
                        <option value="other">other</option> 
                       </select> 
                      </div>   
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Product date of birth" type="date" style="width: 100%;" name="prdob" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Product date of birth" value="">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >  
                       <?php  
                        $query="SELECT * FROM plaas_accounts";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Select Product Owner" style="width: 100%;" class="form-control" name="userid" onChange="getUser(this.value)" id="inputEmail3">
                        <option value="">Select product owner</option>
                        <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <option value=<?php echo $row['id']?>><?php echo $row['email_address']?></option>
                        <?php } ?>
                       </select> 
                      </div> 
                      <div id="statediv" class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >  
                       <select data-toggle="tooltip" title="Product location" style="width: 100%;" class="form-control" name="state" id="inputEmail3">
                       <option value="">Select product location</option> 
                       </select> 
                      </div>    
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input data-toggle="tooltip" title="Total number of product(s)" type="number" style="width: 100%;" name="prtot" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Total number of product(s)" value="1">
                        <span class="fa fa-calculator form-control-feedback left" aria-hidden="true"></span>
                      </div> <br><br> 
  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" name="savecat" class="btn btn-dark" style="width: 32%;">save</button> 
                        </div>
                      </div> 

                    </form>
                    <hr>
                    <div class="clearfix"></div>

                    <div class="row">
                    <h2> <i class="fa fa-asterisk"></i> <b><a href="#"><?php echo !empty($bredname)?$bredname:''; ?></a></b> Cross breeds</h2>
                    <?php    
                      $pdo = MyData::connect(); 
                      $sql = "SELECT * FROM plaas_cross_breeds WHERE categoryid = '$mypurebreedid' order by id DESC";
                              foreach ($pdo->query($sql) as $row) {   
                              $pureprocat = $row['categoryid'];
                      ?> 
                       
                      <?php echo '<a href="add_new_livestock_selected_breed_cattle.php?livestock_category_id='. $row['id'] .'&selected_product_category='. $pureprocat . '">'?>
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

  include_once 'dbConfig.php';
  if(isset($_POST['savecat']))
   { 
    $liveuniqueid=md5($country). rand(50000, 30060) . 'PL' . time() . 'S'; 
    $livechip=$_POST['prcid']; 
    $livetag=$_POST['prtid']; 
    $livecolor=$_POST['prcol']; 
    $livesex=$_POST['prsex'];  
    $livedob=$_POST['prdob'];  
    $livepic = ''; 
    $liveuser=$_POST['userid'];  
    $livefarmid=$_POST['state'];   
    $livesbreed='plaas_breeds'; 
    $liveyoung=$_POST['prbrthch']; 
    $liverelation=$_POST['prbrtrl']; 
    $livetotal=$_POST['prtot']; 
    $livesign = '+';
    $productsize =$_POST['prsiz'];
             
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_ams_settings = "SELECT * FROM categories WHERE id = '$categoname'";
    $q = $pdo->prepare($query_ams_settings);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $dispcategorname = $data['name'];
    $dispcatetype = $data['category'];

    $count=mysqli_query($con,"SELECT * FROM products WHERE uniqueid = '$liveuniqueid'");
    if(mysqli_num_rows($count) < 1)
    {  
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $sql1 = "INSERT into products(uniqueid, chipid, tagid, color, sex, dob, image, categoryid, userid, farmID, breedId, selectedbreed, youngone, relationship, total, upsign, productsize) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($liveuniqueid,$livechip,$livetag,$livecolor,$livesex,$livedob,$livepic,$categoname,$liveuser,$livefarmid,$mypurebreedid,$livesbreed,$liveyoung,$liverelation,$livetotal,$livesign, $productsize));    
    echo '<meta content="2;main_new_livestock_selected_breed_redirect.php?pname='. $dispcategorname .'&pcatego='. $dispcatetype .'&ptotal='. $livetotal .'&userid='. $liveuser .'" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect();  
    } 
     else
      {        
      echo '<meta content="2;main_products_display.php?livestock_add_error" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
      }
   }
?>    