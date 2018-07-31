@include('include.header')
@include('include.navigationbar')
<!-- MAIN PANEL -->
<div id="main" role="main" >
    <!-- RIBBON -->
    <div id="ribbon" >
        <!-- breadcrumb -->
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings Management</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <!-- END RIBBON -->
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- row -->

        <!DOCTYPE html>
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{ url('password_settings')}}">Students</a></li>
                <li ><a href="{{ url('parent_credentials_list') }}">Parents</a></li>
                <li class="active"><a href="{{ url('staff_credentials_list') }}">Staff</a></li>
                <li ><a href="system_admin_credentials_list">System Admin</a></li>
               <li ><a href="{{ url('clerk_credentials_list') }}">Clerk</a></li>
            </ul>
        </div>
        <div class="row">

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                 @if(Session::has('parent_password_change'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> {{ Session::get('parent_password_change') }}
                </div>
                @endif
                {{ Session::forget('parent_password_change') }}
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>Staff List </h2>

                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!--                        <div class="form-inline text-left">
                                                    <div class="form-group" >
                                                        <form  role="form" method="GET"  action="{{ url('search_staff')}}">
                                                            {{ csrf_field() }}
                                                            <div class="form-group">
                                                                <label class="" for="form-field-1">Enter Search String:</label>
                                                                <input type="text" size="30" class="form-control" id="form-field-1" placeholder="Search Staff Details" required name="search" value="<?php
                        if (null !== (filter_input(INPUT_GET, 'submit'))) {
                            echo $value;
                        }
                        ?>" class="col-xs-5 col-sm-12" />
                                                            </div>
                                                            <button class="btn btn-info btn-sm" type="submit" name="submit">
                                                                <i class="glyphicon glyphicon-search"></i>
                        
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="form-group">
                                                        <form   method="GET"  action="{{ url('view_staff') }}">
                                                            <button class="btn btn-info btn-sm" type="submit" name="" >
                                                                <span class="glyphicon glyphicon-refresh"></span>
                        
                                                            </button>
                                                        </form>
                                                    </div>
                        
                                                </div><br>-->
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="staff" data-toggle="table" class="col-md-12" 
                                       data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" data-show-columns="false" data-search="false" >
                                    <thead>
                                        <tr>
                                            <th data-sortable="true" class="col-md-2">Profile Picture</th>
                                            <th data-sortable="true" class="col-md-1">Staff Name</th>
                                            <th data-sortable="true" class="col-md-2">Email ID</th>
                                            <th data-sortable="true" class="col-md-1">Contact Number</th>
                                            <th data-sortable="true" class="col-md-2">Department</th>
                                            <th data-sortable="true" class="col-md-1">Created By</th>
                                            <th class="col-md-1">Actions</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($staffs as $staff) {
                                            ?> 
                                            <tr class="">
                                                <td><a href="{{url('staff_details/'.$staff->staff_id)}}"><img src='{{ asset('uploads/'.$staff->profile_pic) }}' onerror="this.onerror=null;this.src='{{ asset('uploads/2016-09-23-15-04-17-icon1.jpg') }}'" class="img-rounded" height="75" width="75"/></a></td>
                                                <td><a href="{{url('staff_details/'.$staff->staff_id)}}"><?php echo $staff->first_name . " " . $staff->last_name; ?></a></td>
                                                <td><?php echo $staff->email; ?></td>
                                                <td><?php echo $staff->contact_number; ?></td>
                                                <td><?php echo $staff->emp_department; ?></td>
                                                <td><?php echo $staff->user_name; ?></td>
                                                <td><div class="btn-group">
                                                     <a href="{{ ('staff_credentials_change/'.$staff->staff_id) }} " ><button class="btn btn-default btn-primary"  ><span class="glyphicon glyphicon-retweet"></span>&nbsp;Change Credentials</button></a>
                                                    </div>
                                                 </td>


                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="text-right">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float: right;">
                    {!! $staffs->links() !!} 
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
