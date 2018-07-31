@include('include.header')
@include('include.navigationbar')
<style>
    .tabledata{
        word-wrap: break-word;
    }
</style>
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
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
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>Institution Details </h2>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="connection-table"data-toggle="table" class="table table-condensed " 
                                       data-sort-name="SNo" data-sort-name="Institute Name" data-sort-order="desc" data-row-style="rowStyle" data-show-columns="true" data-search="true">
                                    <thead>
                                        <tr>
                                            <th data-field="Institute Name" data-sortable="true" data-visible="true">Name</th>
                                            <th data-sortable="true">Email</th>
                                            <th data-sortable="true">Reg No</th>
                                            <th data-sortable="true">Contact </th>
                                            <th data-sortable="true">Logo</th>
                                            <th data-sortable="true">Person</th>
                                            <th data-sortable="true">Mobile No.</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr class="tabledata">

                                            <td>{{$institutions[0]->institution_name}} <br>{{$institutions[0]->tag_line}}</td>
                                            <td>{{$institutions[0]->institution_email}}</td>
                                            <td>{{$institutions[0]->registration_number}}</td>
                                            <td>{{$institutions[0]->office_contact_number1}}</td>
                                            <td><img src="{{URL::asset('uploads/logo/'.$institutions[0]->institution_logo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/900-without.png') }}'" width="50" height="50"></td>
                                            <td>{{$institutions[0]->cp2_name}}</td>
                                            <td>{{$institutions[0]->cp2_phone1}}</td>

                                            <td class="edit" ><a href="{{ url('edit-institution-details')}}/<?php echo $institutions[0]->id; ?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <div class="text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float: right;">

                </div>          
            </article>          
        </div>
    </div> 
</div>
@include('include.footer')
