<?php
  require_once 'signin-signup-connect/database.php';
  require_once 'main_feeds.php';

  $continent_id = null;
  if ( !empty($_GET['continent_id'])) {
    $continent_id = $_REQUEST['continent_id'];
  }

    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `plaas_continents` WHERE id = '$continent_id'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $Continentname = $data['name'];
    $Continentpopu = $data['population'];
    $Continentcoun=$data['nofcountries'];
    $Continentarea=$data['area']; 
    $continentdesc=$data['description']; 
    $continenticon=$data['icon']; 

    if ($result660 = mysqli_query($con, "SELECT id FROM plaas_breeds ORDER BY id")) {

    /* determine number of rows result set */
    $row_cnt660 = mysqli_num_rows($result660);

    //printf("%d \n", $row_cnt);
    $cont660 = $row_cnt660;
    /* close result set */
    mysqli_free_result($result660);
}
?>
 
<div class="modal-content" style="background: url(images/bg7.jpg) !important; max-width: 100%;
    max-height: 100%; color: #000; object-fit: contain;  font-family: "Open Sans";">
  <div class="modal-header">
     <?php echo '<a href="main_continents_display.php">'?><button type="button" class="close" data-dismiss="" aria-hidden="true">&times;</button><?php echo '</a>'?>  
            <img style="width: 5%;" src="SVG/svg-loaders/audio.svg" alt=""> <img style="width: 5%;" src="SVG/svg-loaders/audio.svg" alt=""> <span style="font-size: 26px; margin-left: 15%"><?php echo !empty($Continentname)?$Continentname:''; ?>  detailed information</span> <img class="pull-right" style="width: 5%;" src="SVG/svg-loaders/rings.svg" alt="">
    </div>
<div class="modal-body"> 
 <p style="float: left;"><img style="margin-left: 25%;" src="images/<?php echo $continenticon ?>" class="img-responsive"></p>
  <table class="table-responsive" style="margin-left: 35%;">
    <tr>
      <td><h1> <?php echo !empty($Continentname)?$Continentname:''; ?> 
        </h1>
      </td>  
      </tr>
      <tr>
      <td>
       <h2><b><span class="fa fa-line-chart"></span> Population: <?php echo !empty($Continentpopu)?$Continentpopu:''; ?></b></h2>
       <h2><b><span class="fa fa-compass"></span> Area: <?php echo !empty($Continentarea)?$Continentarea:''; ?> <?php echo !empty($distancesymbol)?$distancesymbol:''; ?>²</b></h2>
       <h2><b><span class="fa fa-calculator"></span> NO Of Countries: <?php echo !empty($Continentcoun)?$Continentcoun:''; ?></b></h2>   
       <h2><b><span class="fa fa-bar-chart"></span> Plaas Rank: Loading...</b><img class="pull-right" style="width: 5%;" src="SVG/svg-loaders/circles.svg" alt=""></h2> 
      </td>
      </tr>  
  </table> 
</div>
 <div class="modal-footer" style="background: url(images/bg7.jpg) !important;">
 <?php echo '<a href="main_continents_display.php">'?><button type="button" class="btn btn-danger" data-dismiss="">Close</button><?php echo '</a>'?>
</div>
</div>

