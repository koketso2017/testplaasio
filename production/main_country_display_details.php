<?php
  require_once 'signin-signup-connect/database.php';
  require_once 'main_feeds.php';

  $coountry_id = null;
  if ( !empty($_GET['coountry_id'])) {
    $coountry_id = $_REQUEST['coountry_id'];
  }

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_countries` WHERE id = '$coountry_id'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $countrytname = $data['name'];
    $countrycurrency = $data['currency'];
    $countrysubcurrency=$data['subcurrency'];
    $countrylanguage=$data['language']; 
    $countrycallcode=$data['callcode']; 
    $countryflag=$data['flag']; 
    $countrycontinent=$data['continent']; 
    $countryarea=$data['area']; 
    $countrypopulation=$data['population']; 
    $countrydescription=$data['description']; 
    $countrygdp=$data['gdp']; 

    $sql = "SELECT * FROM `plaas_continents` WHERE id = '$countrycontinent'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $Continentname = $data['name'];

    if ($result660 = mysqli_query($con, "SELECT id FROM plaas_user_details WHERE country = '$countrytname' ORDER BY id")) {

    /* determine number of rows result set */
    $row_cnt660 = mysqli_num_rows($result660);

    //printf("%d \n", $row_cnt);
    $cont660 = $row_cnt660;
    /* close result set */
    mysqli_free_result($result660);
} 

    if ($result661 = mysqli_query($con, "SELECT id FROM plaas_breeds ORDER BY id")) {

    /* determine number of rows result set */
    $row_cnt661 = mysqli_num_rows($result661);

    //printf("%d \n", $row_cnt);
    $cont661 = $row_cnt661;
    /* close result set */
    mysqli_free_result($result661);
}
?>

<div class="modal-content" style="background: url(images/bg7.jpg) !important; max-width: 100%;
    max-height: 100%; color: #000; object-fit: contain;">
  <div class="modal-header">
     <?php echo '<a href="main_countries_display.php">'?><button type="button" class="close" data-dismiss="" aria-hidden="true">&times;</button><?php echo '</a>'?>
       <h4 class="modal-title" id="myModalLabel"><?php echo !empty($countrytname)?$countrytname:''; ?>  Detailed Information</h4>
    </div>
<div class="modal-body"> 
 <p style="float: left;"><img style="margin-left: 25%;" src="images/<?php echo $countryflag ?>" class="img-responsive"></p>
  <table class="table-responsive" style="margin-left: 35%; color: #000;">
    <tr>
      <td><h1> <?php echo !empty($countrytname)?$countrytname:''; ?> 
        </h1>
      </td>  
      </tr>
      <tr>
      <td>
       <h2><b><span class="fa fa-line-chart"></span> Population: <?php echo !empty($countrypopulation)?$countrypopulation:''; ?></b></h2>
       <h2><b><span class="fa fa-compass"></span> Area: <?php echo !empty($countryarea)?$countryarea:''; ?> <?php echo !empty($distancesymbol)?$distancesymbol:''; ?>²</b></h2>
       <h2><b><span class="fa fa-globe"></span> Continent: <?php echo !empty($Continentname)?$Continentname:''; ?></b></h2>   
       <h2><b><span class="fa fa-bar-chart"></span> Plaas Rank: NO 5 - 39029 PLS</b></h2> 
      </td>
      </tr>  
  </table> <table class="table-responsive" style="float: right; margin-top: 4%; margin-left: 8%; color: #254117;">
      <th><h2><u><span class="fa fa-crosshairs"></span> Livestock</u></h2></th>
      <tr>
      <td>
      <?php
         $sql = "SELECT * FROM categories WHERE category = 'livestock' order by rand() ASC LIMIT 5";
            foreach ($pdo->query($sql) as $row) { 
              $cont = $row['id'];    

if ($result6060 = mysqli_query($con, "SELECT id FROM plaas_breeds WHERE categoryid = '$cont' AND countryoforigin = '$coountry_id'")) {

    /* determine number of rows result set */
    $row_cnt6060 = mysqli_num_rows($result6060);

    //printf("%d \n", $row_cnt);
    $cont6060 = $row_cnt6060;
    /* close result set */
    mysqli_free_result($result6060);
} 
if ($cont6060 == 0) {
?>
       <p><b><?php echo $row['name']; ?>: 0</b></p>
<?php
}else{
      ?>
       <p><b><?php echo $row['name']; ?>(s): <?php echo !empty($cont6060)?$cont6060:''; ?></b></p>
        <?php
         }
        }
        MyData::disconnect();
      ?>        
      </td>
      </tr>  
  </table> <table class="table-responsive" style="float: right; margin-top: 4%; margin-left: 5%; color: #254117;">
      <th><h2><u><span class="fa fa-pagelines"></span> Vegetables</u></h2></th>
      <tr>
      <td>
      <?php
         $sql = "SELECT * FROM categories WHERE category = 'vegetables' order by rand() ASC LIMIT 5";
            foreach ($pdo->query($sql) as $row) { 
              $cont = $row['id'];    

if ($result6160 = mysqli_query($con, "SELECT id FROM plaas_breeds WHERE categoryid = '$cont' AND countryoforigin = '$coountry_id'")) {

    /* determine number of rows result set */
    $row_cnt6160 = mysqli_num_rows($result6160);

    //printf("%d \n", $row_cnt);
    $cont6160 = $row_cnt6160;
    /* close result set */
    mysqli_free_result($result6160);
} 
if ($cont6160 == 0) {
?>
       <p><b><?php echo $row['name']; ?>: 0</b></p>
<?php
}else{
      ?>
       <p><b><?php echo $row['name']; ?>: <?php echo !empty($cont6160)?$cont6160:''; ?></b></p>
        <?php
         }
        }
        MyData::disconnect();
      ?>        
      </td>
      </tr>  
  </table> 
  <hr>
       <h2><b><span class="fa fa-money"></span> Currency: <?php echo !empty($countrycurrency)?$countrycurrency:''; ?></b></h2> 
       <h2><b><span class="fa fa-code"></span> Call-Code: <?php echo !empty($countrycallcode)?$countrycallcode:''; ?></b></h2> 
       <h2><b><span class="fa fa-language"></span> Language: <?php echo !empty($countrylanguage)?$countrylanguage:''; ?></b></h2> 
       <h2><span class="fa fa-pie-chart"></span> GDP: <?php echo !empty($countrygdp)?$countrygdp:''; ?></h2>
       <?php
        if ($cont660 == 0) {
       ?>
       <h2><b><span class="fa fa-user"></span> Farmers: 0</b></h2>
       <?php
       }else{
       ?>
       <h2><b><span class="fa fa-user"></span> Farmers: <?php echo !empty($cont660)?$cont660:''; ?></b></h2>
       <?php 
       }
       ?>
  
</div>
 <div class="modal-footer" style="background: url(images/bg7.jpg) !important;">
 <?php echo '<a href="main_countries_display.php">'?><button type="button" class="btn btn-danger" data-dismiss="">Close</button><?php echo '</a>'?>
</div>
</div>

