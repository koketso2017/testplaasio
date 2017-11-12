<?php
include_once 'dbConfig.php';

$userid=intval($_GET['userid']);

$query="SELECT farmID,farmname,location,country FROM plaas_data_farm WHERE userid='$userid'";
$result=$con->query($query);

?>
      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" >  
                       <select style="margin-left: -2%;" data-toggle="tooltip" title="Product location"  required="true" class="form-control" name="state" id="inputEmail3" onchange="getCity(<?php echo $country?>,this.value)">
<option>Select Farm locations</option>
<?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
<option value=<?php echo $row['farmID']?>><?php echo $row['farmname']?> - <?php echo $row['location']?> - <?php echo $row['country']?></option>
<?php } ?>
                       </select> 
                      </div> 
