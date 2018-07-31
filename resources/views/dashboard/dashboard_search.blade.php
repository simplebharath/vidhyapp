@include('include.header')
@include('include.navigationbar')
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Dashboard</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <!-- END RIBBON -->


    <!-- MAIN CONTENT -->
    <div id="content">


        <!-- row -->
        <div class="row">
            <article class="col-sm-12">

<!--                <div class="col-md-10 ">
                    <div class="form-group">
                        <form  role="form" method="GET"  action="{{ url('dashboard_search')}}">
                            {{ csrf_field() }}
                            <div class="col-md-2"></div>
                            <div class="form-group-lg">
                                <input type="text" style="height:50px;font-size:12pt;"  id="form-field-1" placeholder="Search for Students by AdmissionNumber,RollNumber,Name,Email" name="search" value="<?php
                                if (null !== (filter_input(INPUT_GET, 'submit'))) {
                                    echo $value;
                                }
                                ?>" class="col-md-8" />
                            </div>
                            <button class="btn btn-info btn-lg"  type="submit" name="submit">
                                <i class="glyphicon glyphicon-search"></i>
                                search
                            </button>
                        </form>
                    </div> </div>-->
        </div>
        <!-- end s1 tab pane -->
        <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false">


            <header>
                <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                <h2>View Students</h2>
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
                                    <th data-sortable="true" class="col-md-1" >Name</th>
                                    <th data-sortable="true" class="col-md-1" >Admission No.</th>
                                    <th data-sortable="true" class="col-md-1" >Class</th>
                                    <th data-sortable="true" class="col-md-1" >R.No</th>
                                    <th data-sortable="true" class="col-md-1" >Parent</th>
                                    <th data-sortable="true" class="col-md-1" >Parent Pic.</th>
                                    <th data-sortable="true" class="col-md-1" >E.Number</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($students as $student) {
                                    ?> 
                                    <tr>
                                    <tr class="">
                                        <td><a href="{{url('student_details/'.$student->student_id)}}" ><img src='{{ asset('uploads/student/'.$student->profile_pic) }}' onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'" class="img-rounded" height="75" width="75"/></a></td>
                                        <td><a href="{{url('student_details/'.$student->student_id)}}" ><?php echo $student->first_name . " " . $student->last_name; ?></a></td>
                                        <td><?php echo $student->admission_number; ?></td>
                                        <td><a href="{{url('class_details/'.$student->class_id)}}" ><?php echo $student->class_name.'-'; ?></a><a href="{{url('section_details'.'/'.$student->class_id.'/'.$student->section_id)}}" ><?php echo $student->section_name; ?></a></td>
                                        <td><?php echo $student->roll_number; ?></td>
                                        <td><?php echo $student->parent_first_name . " " . $student->parent_last_name; ?></td>
                                        <td><a href="{{url('student_details/'.$student->student_id)}}"><img src="/uploads/parent/<?php echo $student->parent_pic; ?>" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/parent.png') }}'" class="img-rounded" height="75" width="75"/></a></td>
                                        <td><?php echo $student->emergency_number; ?></td>


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
    </div>
    <!-- END MAIN CONTENT -->

</div>

@include('include.footer')