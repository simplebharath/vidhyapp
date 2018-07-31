@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div><br>
    <div class="container">
        <div class="row">
            <div class="">
                <ul class="nav nav-tabs">
                    <li ><a href="{{url ('view-academic-years')}}">Academic Year</a></li>
                    <li class="active"><a href="{{url ('view-institution-details')}}">Institution details</a></li>
                    <li  ><a href="{{url ('view-institute-timings')}}">Institution timings</a></li>
                    <li ><a href="{{url ('view-institute-holidays')}}">Institution holidays</a></li>
                    <li ><a href="{{url ('view-attendance-types')}}">Attendance</a></li>
                    <li ><a href="{{url ('view-grade-types')}}">Grade</a></li>
                    <li ><a href="{{url ('view-percentages')}}">Percentage</a></li>
                    <li ><a href="{{url ('view-grade-settings')}}">Grade - Percentage</a></li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
            @include('include.messages')
            <div class="panel panel-info" >                
                <div class="panel-body">
                    <div class="row" >
                        <div  align="center "style="background:url(<?php echo 'uploads/logo/' . $institutions[0]->institution_image; ?>);  background-repeat: no-repeat; height:170px;  padding:0px; margin:0px; background-size:100%; ">
                            <div  align="center"> <img src='{{ asset('uploads/logo/'.$institutions[0]->institution_logo) }}'  height="80" width="80" style="border-radius: 50%; margin-top: 20px;" class=""> </div>
                            <div style="float:right; padding-right: 10px;"><a href="{{ url('edit-institution-details')}}/<?php echo $institutions[0]->id; ?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span> EDIT </button></p></a></div><br>
                            <p class="panel-title" style="color:white; text-align: center; font-family: sans-serif;font-size: 30px;">{{ $institutions[0]->institution_name }}</p>                            
                        </div>
                        <br>
                        <div class=" col-md-6 col-lg-6 "> 
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>Institution Code:</td>
                                        <td><?php echo $institutions[0]->institution_code; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Institution Name:</td>
                                        <td><?php echo $institutions[0]->institution_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tagline:</td>
                                        <td><?php echo $institutions[0]->tag_line; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Established In:</td>
                                        <td> <?php echo $institutions[0]->established_in; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Affiliated By:</td>
                                        <td> <?php echo $institutions[0]->affliated_by; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Institution Email:</td>
                                        <td><?php echo $institutions[0]->institution_email; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Office Contact:</td>
                                        <td><?php echo $institutions[0]->office_contact_number1; ?><br>
                                            <?php echo $institutions[0]->office_contact_number2; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Contact Admission:</td>
                                        <td><?php echo $institutions[0]->cp2_name; ?><br>
                                            <?php echo $institutions[0]->cp2_email; ?><br>
                                            <?php echo $institutions[0]->cp2_phone1; ?><br>
                                            <?php echo $institutions[0]->cp2_phone2; ?>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td></td><td></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class=" col-md-6 col-lg-6 "> 
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>State:</td>
                                        <td><?php echo $institutions[0]->states->state_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>City:</td>
                                        <td><?php echo $institutions[0]->cities->city_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Registration number:</td>
                                        <td> <?php echo $institutions[0]->registration_number; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Academic year:</td>
                                        <td> 
                                            <?php echo $institutions[0]->academic_year_id; ?><br>
                                            START :   <?php echo $institutions[0]->years->from_date; ?><br>
                                            END : <?php echo $institutions[0]->years->to_date; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Fee type</td>
                                        <td><?php echo $institutions[0]->fee_types->fee_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Attendance type</td>
                                        <td><?php echo $institutions[0]->attendance_types->title; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Youtube Channel</td>
                                        <td><?php echo $institutions[0]->youtube_channel; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Address</td>
                                        <td><?php echo $institutions[0]->address; ?></td>
                                    </tr>
                                    <tr>
                                        <td></td><td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('include.footer')
