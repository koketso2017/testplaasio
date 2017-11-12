<?php
  require_once 'main_public.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo !empty($firstname)?$firstname:''; ?> <?php echo !empty($lastname)?$lastname:''; ?> Profile</h3>
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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Status <small>Detailed information</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <?php
                           if ($pictu == '') {
                          ?>
                          <button class="btn btn-default" data-href="" data-toggle="modal" data-target="#confirm-delete">
                          <img class="img-responsive avatar-view img-rounded" src="images/user.png" alt="Avatar" title="Change the display picture">
                          </button>
                          <?php
                           }else{
                          ?>
                          <button class="btn btn-default" data-href="" data-toggle="modal" data-target="#confirm-delete">
                          <img class="img-responsive avatar-view img-rounded" src="images/<?php echo $pictu ?>" alt="Avatar" title="Change the display picture">
                          </button>
                          <?php
                          }
                        ?>
                        </div>
                      </div>
                      <?php
                        if ($firstname == '') { 
                        }else{
                      ?>
                      <h3><?php echo !empty($firstname)?$firstname:''; ?> <?php echo !empty($lastname)?$lastname:''; ?></h3>
                      <?php
                      }
                      ?>
                      <ul class="list-unstyled user_data"> 
                      <?php
                        if ($gender == '') { 
                        }else{
                      ?>
                        <li>
                          <h4><i class="fa fa-adjust user-profile-icon"></i> <?php echo !empty($gender)?$gender:''; ?></h4>
                        </li>
                        <?php
                      } 
                        if ($dateofbith == '0000-00-00') { 
                        }else{
                      ?>
                        <li>
                          <h4><i class="fa fa-calendar user-profile-icon"></i> <?php echo !empty($dateofbith)?$dateofbith:''; ?></h4>
                        </li>
                        <?php
                      } 
                        if ($country == '') { 
                        }else{
                      ?>
                        <li>
                        <h4><i class="fa fa-map-marker user-profile-icon"></i> <?php echo !empty($country)?$country:''; ?>. <?php echo !empty($citytown)?$citytown:''; ?>. <?php echo !empty($citystreet)?$citystreet:''; ?></h4>
                        </li>
                        <?php
                      } 
                        if ($residentialad == '') { 
                        }else{
                      ?> 
                        <li>
                          <h4><i class="fa fa-home user-profile-icon"></i> <?php echo !empty($residentialad)?$residentialad:''; ?></h4>
                        </li>
                        <?php
                      } 
                        if ($useraddress == '') { 
                        }else{
                      ?>
                        <li class="m-top-xs">
                          <i class="fa fa-envelope user-profile-icon"></i> <?php echo !empty($useraddress)?$useraddress:''; ?></a>
                        </li>
                        <?php
                      } 
                        if ($contact == '') { 
                        }else{
                      ?>
                        <li class="m-top-xs">
                          <h4><i class="fa fa-phone user-profile-icon"></i> <?php echo !empty($countrycode)?$countrycode:''; ?> <?php echo !empty($contact)?$contact:''; ?></h4>
                        </li>
                        <?php
                      }
                      ?>
                      <li><i class="fa fa-clock-o m-right-xs"></i> Last modified: <?php echo !empty($modlast)?$modlast:''; ?></li>
                      </ul>

                      <button class="btn btn-dark" data-href="" data-toggle="modal" data-target="#confirm-profile"><i class="fa fa-edit m-right-xs"></i> Edit Profile</button>
                      <br />
 

                    </div>
                  <?php
                    if(isset($_GET['profile_update_picture_success']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #99C68E; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Profile picture comfirmation !</strong>  Profile picture successfully updated.
                         </div>
                         ";    
                       }
               
                    if(isset($_GET['profile_sucess']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #99C68E; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Profile update !</strong>  details successfully updated.
                         </div>
                         ";    
                       }
               
                    if(isset($_GET['profile_update_success']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #99C68E; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Profile update !</strong>  details successfully updated.
                         </div>
                         ";    
                       }
               
                    if(isset($_GET['profile_update_picture_error']))
                       {  
                        $msgcx = "
                         <div class='alert col-md-9 col-sm-9 col-xs-12 form-group has-feedback' style='  color: #000C2C; background-color: #E77471; border-color: #d6e9c6; margin-left: 0%; border-radius: 4px; '> 
                          <strong> Image error !</strong> error occured while uploading profile picture.
                         </div>
                         ";    
                       }
                      ?>

                      <?php if(isset($msgcx)) echo $msgcx;  ?>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>User Activity Statistics</h2>
                        </div> 
                      </div>  

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class=""><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Recent Activity</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Rankings</a>
                          </li>
                          <li role="presentation" class="active"><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="true">Profile</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <ul class="messages">
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Profile update</h4>
                                  <h5 class="message">updated</h5>
                                  <br />
                                  <p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance </a>
                                  </p>
                                </div>
                              </li>   

                            </ul>
                            <!-- end recent activity -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Project Name</th>
                                  <th>Client Company</th>
                                  <th class="hidden-phone">Hours Spent</th>
                                  <th>Contribution</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>New Company Takeover Review</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">18</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>New Partner Contracts Consultanci</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">13</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Partners and Inverstors report</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">30</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td>New Company Takeover Review</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">28</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content3" aria-labelledby="profile-tab"> 
                    <form class="form-horizontal form-label-left input_mask" method="POST">
                      <input type="hidden" name="ucid" value="<?php echo !empty($userid)?$userid:''; ?>">
                      <input type="hidden" name="upic" value="<?php echo !empty($pictu)?$pictu:''; ?>">
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="First name" style="width: 100%;" name="ufname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First name" value="<?php echo !empty($firstname)?$firstname:''; ?>">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Last name" style="width: 100%;" name="ulname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Last name" value="<?php echo !empty($lastname)?$lastname:''; ?>">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>   
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select data-toggle="tooltip" title="User Gender" class="select2_single form-control" name="ugender" tabindex="-1">
                            <option value="<?php echo !empty($gender)?$gender:''; ?>"><?php echo !empty($gender)?$gender:''; ?></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option> 
                            <option value="other">Other</option> 
                          </select>
                        </div>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="date" data-toggle="tooltip" title="Date of birth" style="width: 100%;" name="udob" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Date of birth" value="<?php echo !empty($dateofbith)?$dateofbith:''; ?>">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="number" data-toggle="tooltip" title="Contacts: Tellphone / Cellphone" style="width: 100%;" name="ucont" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Contacts: Tellphone / Cellphone" value="<?php echo !empty($contact)?$contact:''; ?>">
                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="form-group"> 
                       <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea data-toggle="tooltip" title="Residential Address" rows="3" style="width: 100%;" name="uresy" class="resizable_textarea form-control" placeholder="Residential Address"><?php echo !empty($residentialad)?$residentialad:''; ?></textarea>
                       </div>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_countries";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Country of origin" style="width: 100%;" required="true" class="form-control" name="ucou" id="inputEmail3">
                       <option value="<?php echo !empty($country)?$country:''; ?>"><?php echo !empty($country)?$country:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['name']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="City / Village" style="width: 100%;" name="ucity" class="form-control has-feedback-left" id="inputSuccess2" placeholder="City / Village" value="<?php echo !empty($citytown)?$citytown:''; ?>">
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Street - location" style="width: 100%;" name="ustreet" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Street - location" value="<?php echo !empty($citystreet)?$citystreet:''; ?>">
                        <span class="fa fa-dot-circle-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select data-toggle="tooltip" title="Display your real names in public.?" class="select2_single form-control" name="upub" tabindex="-1">
                            <option value="<?php echo !empty($publicsts)?$publicsts:''; ?>"><?php echo !empty($dispme)?$dispme:''; ?></option>
                            <option value="Y">YES</option>
                            <option value="N">NO</option>  
                          </select>
                        </div>
                      </div>

  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <button type="submit" name="savecat" class="btn btn-primary" style="width: 32%;">Update</button> 
                        </div>
                      </div> 

                    </form>
                          </div>
                        </div>
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
  include_once 'dbConfig.php';
  if(isset($_POST['savecat']))
   { 
    $accountid=$_POST['ucid']; 
    $firstname=$_POST['ufname']; 
    $lastname=$_POST['ulname']; 
    $ugender=$_POST['ugender']; 
    $dateofbith=$_POST['udob'];  
    $ucontact=$_POST['ucont']; 
    $residentialad=$_POST['uresy']; 
    $ucountry=$_POST['ucou']; 
    $ucity=$_POST['ucity']; 
    $upictu=$_POST['upic']; 
    $ustreet=$_POST['ustreet'];  
    $upub=$_POST['upub'];  
    $lastmod = date("Y-m-d H:i:s");

    $count=mysqli_query($con,"SELECT * FROM plaas_user_details WHERE accountid = '$accountid'");
    if(mysqli_num_rows($count) < 1)
    {  
    $pdo = MyData::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "INSERT into plaas_user_details(accountid, fname, lname, gender, dob, publicstatus, contact, residential, country, city, street, picture) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";   
    $q1 = $pdo->prepare($sql1);
    $q1->execute(array($accountid,$firstname,$lastname,$ugender,$dateofbith,$upub,$ucontact,$residentialad,$ucountry,$ucity,$ustreet,$upictu));      
    echo '<meta content="2;farmer_user_profile.php?profile_sucess" http-equiv="refresh" />';// redirects user view page after 3 seconds.
    MyData::disconnect(); 
    } 
     else
      {        
       $pdo = MyData::connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql2 = "UPDATE plaas_user_details SET fname = ?, lname = ?, gender = ?, dob = ?, publicstatus = ?, contact = ?, residential = ?, country = ?, city = ?, street = ?, modified = ? WHERE accountid = ?";   
       $q2 = $pdo->prepare($sql2);
       $q2->execute(array($firstname,$lastname,$ugender,$dateofbith,$upub,$ucontact,$residentialad,$ucountry,$ucity,$ustreet,$lastmod,$accountid));    
      echo '<meta content="2;farmer_user_profile.php?profile_update_success" http-equiv="refresh" />';// redirects user view page after 3 seconds. 
    MyData::disconnect();  
      }
   }

if(isset($_POST['picupdate']))
{
     
  if (!isset($_FILES['image']['tmp_name'])) {  
    echo '<meta content="2;farmer_user_profile.php?profile_update_picture_error" http-equiv="refresh" />';// redirects user view page after 3 seconds.
  }else{
  $file=$_FILES['image']['tmp_name'];
  $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
  $image_name= addslashes($_FILES['image']['name']);
  $image_size= getimagesize($_FILES['image']['tmp_name']);

  
    if ($image_size==FALSE) {   
           echo '<meta content="2;farmer_user_profile.php?profile_update_picture_error" http-equiv="refresh" />';// redirects user view page after 3seconds.
      
    }else{
      $filename = rand(10000, 990000) . '_' . time() . '.' . $image_name;
      move_uploaded_file($file,"images/" . $filename);  
      
      $location=$filename; 
      $mod=date('Y-m-d H:i:s');  
      
 if (!empty($_POST)) { 
      $pdo = MyData::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE plaas_user_details set picture = ?, modified = ? WHERE accountid = ?";   
      $q = $pdo->prepare($sql);
      $q->execute(array($location,$mod,$userid));
      MyData::disconnect();  
      
      if($q->execute())
      {     
           echo '<meta content="2;farmer_user_profile.php?profile_update_picture_success" http-equiv="refresh" />';// redirects user view page after 3 seconds.
      }
      else
      {  
           echo '<meta content="2;farmer_user_profile.php?profile_update_picture_error" http-equiv="refresh" />';// redirects user view page after 3seconds.
      }
    } 
   }
}
}
?>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" method="POST">
            <div class="modal-header">
                Profile Picture
            </div>
            <div class="modal-body">   
             <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
              <input type="file" data-toggle="tooltip" title="Display profile picture" style="width: 100%;" name="image" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Display profile picture">
              <span class="fa fa-photo form-control-feedback left" aria-hidden="true"></span>
              </div>
              <img class="img-responsive avatar-view img-rounded" src="images/<?php echo $pictu ?>" alt="Avatar" title="Change the display picture"> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class="btn btn-dark btn-ok" name="picupdate">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" method="POST">
            <div class="modal-header">
                <h3><?php echo !empty($firstname)?$firstname:''; ?> <?php echo !empty($lastname)?$lastname:''; ?> Profile Update</h3>
            </div>
            <div class="modal-body">  
                    <form class="form-horizontal form-label-left input_mask" method="POST">
                      <input type="hidden" name="ucid" value="<?php echo !empty($userid)?$userid:''; ?>">
                      <input type="hidden" name="upic" value="<?php echo !empty($pictu)?$pictu:''; ?>">
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="First name" style="width: 100%;" name="ufname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First name" value="<?php echo !empty($firstname)?$firstname:''; ?>">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Last name" style="width: 100%;" name="ulname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Last name" value="<?php echo !empty($lastname)?$lastname:''; ?>">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>   
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select data-toggle="tooltip" title="User Gender" class="select2_single form-control" name="ugender" tabindex="-1">
                            <option value="<?php echo !empty($gender)?$gender:''; ?>"><?php echo !empty($gender)?$gender:''; ?></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option> 
                            <option value="other">Other</option> 
                          </select>
                        </div>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="date" data-toggle="tooltip" title="Date of birth" style="width: 100%;" name="udob" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Date of birth" value="<?php echo !empty($dateofbith)?$dateofbith:''; ?>">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="number" data-toggle="tooltip" title="Contacts: Tellphone / Cellphone" style="width: 100%;" name="ucont" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Contacts: Tellphone / Cellphone" value="<?php echo !empty($contact)?$contact:''; ?>">
                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="form-group"> 
                       <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea data-toggle="tooltip" title="Residential Address" rows="3" style="width: 100%;" name="uresy" class="resizable_textarea form-control" placeholder="Residential Address"><?php echo !empty($residentialad)?$residentialad:''; ?></textarea>
                       </div>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback" > 
                       <?php  
                        $query="SELECT * FROM plaas_countries";
                        $result= $con->query($query);
                       ?>    
                       <select data-toggle="tooltip" title="Country of origin" style="width: 100%;" required="true" class="form-control" name="ucou" id="inputEmail3">
                       <option value="<?php echo !empty($country)?$country:''; ?>"><?php echo !empty($country)?$country:''; ?></option>
                       <?php while ($row=$result->fetch_array(MYSQLI_ASSOC)) { ?>
                       <option value=<?php echo $row['name']?>><?php echo $row['name']?></option>
                       <?php } ?>
                       </select> 
                      </div> 
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="City / Village" style="width: 100%;" name="ucity" class="form-control has-feedback-left" id="inputSuccess2" placeholder="City / Village" value="<?php echo !empty($citytown)?$citytown:''; ?>">
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <input type="text" data-toggle="tooltip" title="Street - location" style="width: 100%;" name="ustreet" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Street - location" value="<?php echo !empty($citystreet)?$citystreet:''; ?>">
                        <span class="fa fa-dot-circle-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="form-group"> 
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select data-toggle="tooltip" title="Display your real names in public.?" class="select2_single form-control" name="upub" tabindex="-1">
                            <option value="<?php echo !empty($publicsts)?$publicsts:''; ?>"><?php echo !empty($dispme)?$dispme:''; ?></option>
                            <option value="Y">YES</option>
                            <option value="N">NO</option>  
                          </select>
                        </div>
                      </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class="btn btn-dark btn-ok" name="savecat">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>