@include('include.header')
<style>
    .btn-group {
        white-space: nowrap;

    }
</style>
@include('include.navigationbar')
<!-- MAIN PANEL -->
<div id="main" role="main" >

    <!-- RIBBON -->
    <div id="ribbon">
<ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings Management</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{ url('password_settings')}}">Students</a></li>
                <li class="active"><a href="{{ url('parent_credentials_list') }}">Parents</a></li>
                <li ><a href="#">Staff</a></li>
                <li ><a href="{{ url('system_admin_credentials_list') }}">System Admin</a></li>
                <li ><a href="{{ url('clerk_credentials_list') }}">Clerk</a></li>
            </ul>
        </div>         <!-- end row -->
        <div class="row">

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               @if(Session::has('parent_password_change'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> {{ Session::get('parent_password_change') }}
                </div>
                @endif
                {{ Session::forget('parent_password_change') }}

                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false">


                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>Parents List</h2>
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="connection-table"data-toggle="table" class="table" 
                                       data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" >
                                    <thead>
                                        <tr>
                                           <th data-sortable="true"  >profile pic</th>
                                            <th data-sortable="true"  >Name</th>
                                            <th data-sortable="true"  >Contact Number</th>
                                            <th data-sortable="true"  >Student Image</th>
                                            <th data-sortable="true"  >Student Name</th>
                                            <th data-sortable="true"  >Admission No.</th>
                                            <th data-sortable="true"  >Class-Section</th>
                                            <th data-sortable="true"  >Roll No.</th>
                                            <th class="col-md-3" >Actions</th>

                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php foreach ($parents as $parent){ ?>
                                        <tr>
                                            <td data-sortable="true"><img src="/uploads/parent/<?php echo $parent->profile_pic; ?>" onerror="this.onerror=null;this.src='{{ asset('uploads/2016-09-23-15-04-17-icon1.jpg') }}'" class="img-rounded" height="75" width="75"/></td>
                                            <td data-sortable="true">{{ $parent->first_name }}{{ $parent->last_name }}</td>
                                            <td data-sortable="true">{{ $parent->contact_number }}</td>
                                            <td><a href="{{url('student_details/'.$parent->student_id)}}" ><img src='{{ asset('uploads/student/'.$parent->student_profile_pic) }}' class="img-rounded" height="75" width="75"/></a></td>
                                                <td><a href="{{url('student_details/'.$parent->student_id)}}" ><?php echo $parent->student_first_name . " " . $parent->student_last_name; ?></a></td>
                                                <td><?php echo $parent->admission_number; ?></td>
                                                <td><a href="{{url('class_details/'.$parent->class_id)}}" ><?php echo $parent->class_name . '-'; ?></a><a href="{{url('section_details'.'/'.$parent->class_id.'/'.$parent->section_id)}}" ><?php echo $parent->section_name; ?></a></td>
                                                <td><?php echo $parent->roll_number; ?></td>
                                            <td><div class="btn-group">
                                                     <a href="{{ ('parent_credentials_change/'.$parent->parent_id) }} " ><button class="btn btn-default btn-primary"  ><span class="glyphicon glyphicon-retweet"></span>&nbsp;Change Credentials</button></a>
                                                    </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    
                                </table>

                            </div>
                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>

                <!-- end widget -->
            </article>

            <!-- WIDGET END -->
        </div>
    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
@include('include.footer')
