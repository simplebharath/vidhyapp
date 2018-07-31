@include('include.header')
<style>
    .btn-group {
        white-space: nowrap;

    }
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
@include('include.navigationbar')

<script type="text/javascript">

    $(document).ready(function () {

        $('#class').on('change', function () {
            var data1 = document.getElementById("class").value;

            console.log(data1);
            $.ajax({
                type: 'GET',
                url: '/getsection',
                data: {'data1': data1},
                dataType: 'json',
                success: function (data, status) {
                    var option = "";
                    option += "<option value=''>--Select Section--</option>";
                    for (i = 0; i < data.length; i++) {

                        option += "<option value='" + data[i].section_id + "'>" + data[i].section_name + "</option>";
                    }
                    $('#section').html(option);
                }
            });
        });

    });
</script>
<!-- MAIN PANEL -->
<div id="main" role="main" >

    <!-- RIBBON -->
    <div id="ribbon">

        <!-- breadcrumb col-md-3 -->
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings Management</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{ url('password_settings')}}">Students</a></li>
                <li ><a href="{{ url('parent_credentials_list') }}">Parents</a></li>
                <li ><a href="{{ url('staff_credentials_list') }}">Staff</a></li>
                <li ><a href="system_admin_credentials_list">System Admin</a></li>
                <li ><a href="{{ url('clerk_credentials_list') }}">Clerk</a></li>
            </ul>
        </div>      <!-- end row -->
        <div class="row">

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @if(Session::has('student_password_change'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> {{ Session::get('student_password_change') }}
                </div>
                @endif
                {{ Session::forget('student_password_change') }}

                
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>Students</h2>
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
                                <table id="connection-table"data-toggle="table" class="col-md-12 table table-condensed " 
                                       data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" data-show-columns="" data-search="" >
                                    <thead>
                                        <tr>
                                            <th data-sortable="true" class="col-md-1" >photo</th>
                                            <th data-sortable="true" class="col-md-2" >Name</th>
                                            <th data-sortable="true" class="col-md-1" >Admission.No</th>
                                            <th data-sortable="true" class="col-md-1" >R.No</th>
                                            <th data-sortable="true" class="col-md-1" >Class-Section</th>
<!--                                            <th data-sortable="true" class="col-md-1" >E.Cont.Number</th>-->
                                            <th data-sortable="true" class="col-md-1" >CreatedBy</th>
                                            <th data-sortable="true" class="col-md-1" >CreatedOn</th>
                                            <th class="col-md-1" >Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($students as $student) {
                                           $newDate = date("d-m-Y H:i:s", strtotime($student->created_at));
                                            ?> 
                                            <tr>
                                            <tr class="">
                                                <td><a href="{{url('student_details/'.$student->student_id)}}" ><img src='{{ asset('uploads/student/'.$student->profile_pic) }}' onerror="this.onerror=null;this.src='{{ asset('uploads/2016-09-23-15-04-17-icon1.jpg') }}'" class="img-rounded" height="75" width="75"/></a></td>
                                                <td><a href="{{url('student_details/'.$student->student_id)}}" ><?php echo $student->first_name . " " . $student->last_name; ?></a></td>
                                                <td><?php echo $student->admission_number; ?></td>
                                                <td><?php echo $student->roll_number; ?></td>
                                                <td><a href="{{url('class_details/'.$student->class_id)}}" ><?php echo $student->class_name . '-'; ?></a><a href="{{url('section_details'.'/'.$student->class_id.'/'.$student->section_id)}}" ><?php echo $student->section_name; ?></a></td>
                                                 <td><?php echo $student->user_name; ?></td>
                                                <td><?php echo $newDate; ?></td>
                                                <td><div class="btn-group">
    <!--                                                        <a href="{{ ('edit_student/'.$student->student_id) }} "><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>-->
                                                        <a href="{{ ('student_credentials_change/'.$student->student_id) }} " ><button class="btn btn-default btn-primary"  ><span class="glyphicon glyphicon-retweet"></span>&nbsp;Change Credentials</button></a>
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
                <div style="float: right;">
                    {!! $students->links() !!} 
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
