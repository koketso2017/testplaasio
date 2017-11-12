<?php
  require_once 'main.php';
  require_once 'charts_connections.php';
?>	
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count" style="color: #7F5217;">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><img src="images/cow.png" style="width: 15%; height: 15%;"> Total Cattles</span>
              <?php
              if ($viewtotalup == 0) {
              ?>
              <div class="count">0</div>
              <?php
              }else{
              ?>
              <div class="count"><?php echo !empty($viewtotalup)?$viewtotalup:''; ?></div>
              <?php
               } 
               if ($updownsigncattle == '+') {
                ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="#008000"><i class="fa fa-sort-asc"></i><?php echo !empty($cattlepercentcount_string)?$cattlepercentcount_string:''; ?>% </i> increase<br>&ensp;&ensp;Since - <?php echo !empty($new_date_format)?$new_date_format:''; ?></font> </span>
              <?php
               }else{
              ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="red"><i class="fa fa-sort-desc"></i><?php echo !empty($cattlepercentcountdown_string)?$cattlepercentcountdown_string:''; ?>% </i> decrease<br>&ensp;&ensp;Since - <?php echo !empty($new_date_format)?$new_date_format:''; ?></font> </span>
              <?php
              }
              ?> 
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><img src="images/goat.png" style="width: 15%; height: 15%;"> Total Goats</span> 
              <?php
              if ($viewtotalupGT == 0) {
              ?>
              <div class="count">0</div>
              <?php
              }else{
              ?>
              <div class="count"><?php echo !empty($viewtotalupGT)?$viewtotalupGT:''; ?></div>
              <?php
               } 
               if ($updownsigngoat == '+') {
                ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="#008000"><i class="fa fa-sort-asc"></i><?php echo !empty($goatpercentcount_string)?$goatpercentcount_string:''; ?>% </i> increase<br>&ensp;&ensp;Since - <?php echo !empty($new_date_formatGT)?$new_date_formatGT:''; ?></font> </span>
              <?php
               }else{
              ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="red"><i class="fa fa-sort-desc"></i><?php echo !empty($goatpercentcountdown_string)?$goatpercentcountdown_string:''; ?>% </i> decrease<br>&ensp;&ensp;Since - <?php echo !empty($new_date_formatGT)?$new_date_formatGT:''; ?></font> </span>
              <?php
              }
              ?> 
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><img src="images/horse.png" style="width: 15%; height: 15%;"> Total Horses</span> 
              <?php
              if ($viewtotalupHS == 0) {
              ?>
              <div class="count">0</div>
              <?php
              }else{
              ?>
              <div class="count"><?php echo !empty($viewtotalupHS)?$viewtotalupHS:''; ?></div>
              <?php
               } 
               if ($updownsignhorse == '+') {
                ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="#008000"><i class="fa fa-sort-asc"></i><?php echo !empty($horsepercentcount_string)?$horsepercentcount_string:''; ?>% </i> increase<br>&ensp;&ensp;Since - <?php echo !empty($new_date_formatHS)?$new_date_formatHS:''; ?></font> </span>
              <?php
               }else{
              ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="red"><i class="fa fa-sort-desc"></i><?php echo !empty($horsepercentcountdown_string)?$horsepercentcountdown_string:''; ?>% </i> decrease<br>&ensp;&ensp;Since - <?php echo !empty($new_date_formatHS)?$new_date_formatHS:''; ?></font> </span>
              <?php
              }
              ?> 
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><img src="images/sheep.png" style="width: 15%; height: 15%;"> Total Sheep</span>
              <?php
              if ($viewtotalupSP == 0) {
              ?>
              <div class="count">0</div>
              <?php
              }else{
              ?>
              <div class="count"><?php echo !empty($viewtotalupSP)?$viewtotalupSP:''; ?></div>
              <?php
               } 
               if ($updownsignsheep == '+') {
                ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="#008000"><i class="fa fa-sort-asc"></i><?php echo !empty($sheeppercentcount_string)?$sheeppercentcount_string:''; ?>% </i> increase<br>&ensp;&ensp;Since - <?php echo !empty($new_date_formatSP)?$new_date_formatSP:''; ?></font> </span>
              <?php
               }else{
              ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="red"><i class="fa fa-sort-desc"></i><?php echo !empty($sheeppercentcountdown_string)?$sheeppercentcountdown_string:''; ?>% </i> decrease<br>&ensp;&ensp;Since - <?php echo !empty($new_date_formatSP)?$new_date_formatSP:''; ?></font> </span>
              <?php
              }
              ?> 
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><img src="images/pig.png" style="width: 15%; height: 15%;"> Total Pigs</span>
              <?php
              if ($viewtotalupPG == 0) {
              ?>
              <div class="count">0</div>
              <?php
              }else{
              ?>
              <div class="count"><?php echo !empty($viewtotalupPG)?$viewtotalupPG:''; ?></div>
              <?php
               } 
               if ($updownsignpig == '+') {
                ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="#008000"><i class="fa fa-sort-asc"></i><?php echo !empty($pigpercentcount_string)?$pigpercentcount_string:''; ?>% </i> increase<br>&ensp;&ensp;Since - <?php echo !empty($new_date_formatPG)?$new_date_formatPG:''; ?></font> </span>
              <?php
               }else{
              ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="red"><i class="fa fa-sort-desc"></i><?php echo !empty($pigpercentcountdown_string)?$pigpercentcountdown_string:''; ?>% </i> decrease<br>&ensp;&ensp;Since - <?php echo !empty($new_date_formatPG)?$new_date_formatPG:''; ?></font> </span>
              <?php
              }
              ?> 
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><img src="images/other.png" style="width: 15%; height: 15%;"> Others</span>
              <?php
              if ($userotherproducts == 0) {
              ?>
              <div class="count">0</div>
              <?php
              }else{
              ?>
              <div class="count"><?php echo !empty($userotherproducts)?$userotherproducts:''; ?></div>
              <?php
               } 
               ?>
              <span style="font-weight: bold;" class="count_bottom"><i class="green"><font color="black"><i class="fa fa-dot"></i><?php echo !empty($mainpercentcount_string)?$mainpercentcount_string:''; ?>% top up of total</i><br>&ensp;&ensp;Since - <?php echo !empty($new_date_formatPG)?$new_date_formatPG:''; ?></font> </span>
              <?php
              ?>
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Plaas Market Cap <small>Network Growth</small></h3>
                  </div> 
                </div>

                <div class="col-md-12 col-sm-9 col-xs-12">
                  <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                  <div style="width: 100%;">
                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                  </div>
                </div>  
                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Top 5 Livestock Statistics</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li> 
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content"> 


<!-- You need to include the following JS file to render the chart.
When you make your own charts, make sure that the path to this JS file is correct.
Else, you will get JavaScript errors. -->

<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>

<?php

    // Form the SQL query that returns the top 10 most populous countries
    $strQuery = "SELECT name, total FROM plaas_products_statistics ORDER BY total DESC LIMIT 5";

    // Execute the query, or else return the error message.
    $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    // If the query returns a valid response, prepare the JSON string
    if ($result) {
        // The `$arrData` array holds the chart attributes and data
        $arrData = array(
            "chart" => array( 
              "paletteColors" => "#0075c2",
              "bgColor" => "#ffffff",
              "borderAlpha"=> "20",
              "canvasBorderAlpha"=> "0",
              "usePlotGradientColor"=> "0",
              "plotBorderAlpha"=> "10",
              "showXAxisLine"=> "1",
              "xAxisLineColor" => "#999999",
              "showValues" => "0",
              "divlineColor" => "#999999",
              "divLineIsDashed" => "1",
              "showAlternateHGridColor" => "0"
            )
        );

        $arrData["data"] = array();

// Push the data into the array
        while($row = mysqli_fetch_array($result)) {
        array_push($arrData["data"], array(
            "label" => $row["name"],
            "value" => $row["total"]
            )
        );
        }

        /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        $jsonEncodedData = json_encode($arrData);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        $columnChart = new FusionCharts("column2D", "myFirstChart" , 320, 250, "chart-1", "json", $jsonEncodedData);

        // Render the chart
        $columnChart->render();

        // Close the database connection
        $dbhandle->close();
    }

?>
                  <div id="chart-1"><!-- Fusion Charts will render here--></div>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Goats Breed Statistics</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Breed</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p class="">Rankings</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Angora </p>
                            </td>
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Tswana </p>
                            </td>
                            <td>10%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Boer </p>
                            </td>
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Brazilian </p>
                            </td>
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Others </p>
                            </td>
                            <td>30%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Quick Settings</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                      </li>
                    </ul>

                    <div class="sidebar-widget">
                      <h4>Profile Completion</h4>
                      <canvas width="150" height="80" id="foo" class="" style="width: 160px; height: 100px;"></canvas>
                      <div class="goal-wrapper">
                        <span class="gauge-value pull-left">P</span>
                        <span id="gauge-text" class="gauge-value pull-left">3,200</span>
                        <span id="goal-text" class="goal-value pull-right">P5,000</span>
                      </div>
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