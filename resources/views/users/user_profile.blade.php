@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>User Profile</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div><br>
    <div class="container">
      <div class="row">
           <?php
                                        foreach ($users as $user) {
                                            ?> 
      <div class="col-md-4  toppad  pull-right col-md-offset-1">
          
       <br>
       <?php date_default_timezone_set('Asia/Kolkata');
$date = date('m/d/Y h:i:s a', time());?>
<p class=" text-info"><?php echo $date;?> </p>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad" >
          <div class="panel panel-info" >
            <div class="panel-heading" style="background-color:#346597">
                <h3 class="panel-title" style="color:white;"><?php echo $user->first_name." ".$user->last_name;?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                  <div  align="right " style="padding-right: 1cm;"> <a href="{{ url('edit_user')}}/<?php echo $user->user_id; ?>">Edit Profile</a></div>
                  <div  align="center " style="padding-left: 10cm;"> <img src='{{ asset('uploads/'.$user->photo) }}'  height="50" width="50" class="img-rounded img-responsive"> </div>
               <br>
                  <div class=" col-md-6 col-lg-6 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>First Name:</td>
                        <td><?php echo $user->first_name; ?></td>
                      </tr>
                      <tr>
                        <td>Last Name:</td>
                        <td><?php echo $user->last_name; ?></td>
                      </tr>
                      <tr>
                        <td>Hire date:</td>
                        <td><?php echo $user->created_at;?></td>
                      </tr>
                      <tr>
                             <tr>
                        <td>Gender</td>
                        <td>Male</td>
                      </tr>
                        <tr>
                        <td>Home Address</td>
                        <td><?php echo $user->address;?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="#"><?php echo $user->email_id;?></a></td>
                      </tr>
                        <td>Phone Number</td>
                        <td><?php echo $user->contact_number;?><br><br>555-4567-890(Mobile)
                        </td>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                                        <?php } ?>
                  
                </div>
                <div class=" col-md-6 col-lg-6 "> 
                   <?php  foreach ($institution_details as $institution_detail){ ?>   
                    <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Institution Name:</td>
                        <td><?php echo $institution_detail->institution_name; ?></td>
                      </tr>
                      <tr>
                          <td>Tagline:</td>
                          <td><?php echo $institution_detail->cp1_name;?></td>
                      </tr>
                      <tr>
                          <td>Established In:</td>
                          <td> <?php echo $institution_detail->cp1_phone1;?></td>
                      </tr>
                      <tr>
                          <td>Affiliated By:</td>
                          <td> <?php echo $institution_detail->cp1_phone2;?></td>
                      </tr>
                      <tr>
                        <td>Institution Email:</td>
                        <td><?php echo $institution_detail->institution_email; ?></td>
                      </tr>
                      <tr>
                        <td>Office Contact:</td>
                        <td><?php echo $institution_detail->office_contact_number1;?><br>
                            <?php echo $institution_detail->office_contact_number2;?>
                        </td>
                      </tr>
                      
                      <tr>
                        <td>Contact Admission:</td>
                        <td><?php echo $institution_detail->cp2_name;?><br>
                            <?php echo $institution_detail->cp2_email;?><br>
                            <?php echo $institution_detail->cp2_phone1;?><br>
                            <?php echo $institution_detail->cp2_phone2;?>
                        </td>
                      </tr>
                        <tr>
                        <td> Address</td>
                        <td><?php echo $institution_detail->address;?></td>
                      </tr>
                      <tr>
                        <td> School videos Channel Id</td>
                        <td><?php echo $institution_detail->cp1_email;?></td>
                      </tr>
                      
                        
                     
                    </tbody>
                  </table>
                                        <?php } ?>
                  
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        
                    </div>
            
          </div>
        </div>
      </div>
    </div>
   
        
   
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
@include('include.footer')
