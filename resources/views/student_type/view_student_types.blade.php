@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li  class="active"><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li ><a href="{{url ('view-students')}}">Students</a></li> 
                <li><a href="{{url ('view-students-attendance')}}">Attendance</a></li> 
                <li><a href="{{url ('view-all-student-fee-discounts')}}">Fee discounts</a></li>
            </ul>
        </div><br>       
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Student types</h2>
                        @if(Session::get('add') == 1) <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-student-type')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @else
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right disabled" href="{{url('add-student-type')}}"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @endif
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:18%">
                                                <input type="text" class="form-control" placeholder="Student type" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text"  class="form-control" placeholder="Created by" />
                                            </th>
                                            <th class="hasinput" style="width:23%">
                                                <input type="text" class="form-control" placeholder="Created on" />
                                            </th>
<!--                                            <th class="hasinput" style="width:6%">
                                                <input type="text"  class="form-control" readonly="" placeholder="Actions" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Enter status" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text"  class="form-control" placeholder="Enter change status" />
                                            </th>-->
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Student type</th>
                                            <th data-sortable="true">Created By</th>
                                            <th data-sortable="true">Created On</th>
<!--                                            <th>Actions</th>              
                                            <th>Status</th>
                                            <th>Change Status</th>-->
                                        </tr>
                                    </thead>
                                     @if(Session::get('view') == 1)
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($student_types as $student_type) {
                                            ?> 
                                            <tr class="">
                                                <td class="col-md-1"> {{$i}}</td>
                                                <td>{{ $student_type->title }}</td>
                                                <td>{{$student_type->user_logins->user_name}}</td>
                                                <td class="col-md-3">{{$student_type->created_at->format('l jS \\of F Y h:i:s A')}}</td>
<!--                                                <td><div class="btn-group">
                                                        @if(Session::get('edit') == 1)   <a href="{{ url('edit-student-type/'.$student_type->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Edit"><button class="btn btn-primary btn-xs disabled" data-title="Edit" data-toggle="#" data-target="#" disabled=""><span class="glyphicon glyphicon-pencil"></span></button></a>@endif


                                                        </div>
                                                </td>

                                                @if (($student_type->status) == 1)
                                                <td><span class="label label-success"><i class="ace-icon fa fa-check bigger-120"></i> Active </span> </td>
                                                <td>@if(Session::get('edit') == 1)
                                                    <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-student-type/'.$student_type->id)}}">
                                                        <i class="fa fa-times" > </i> Make Inactive
                                                    </a> @else
                                                    <a class="btn bg-color-yellow txt-color-white btn-xs disabled"  href="{{url('make-inactive-student-type/'.$student_type->id)}}">
                                                        <i class="fa fa-times" > </i> Make Inactive
                                                    </a>
                                                    @endif
                                                </td>
                                                @else 
                                                <td><span class="label label-danger" ><i class="fa fa-times bigger-120"></i> Inactive </span></td>
                                                <td>@if(Session::get('edit') == 1)
                                                    <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-student-type/'.$student_type->id)}}">
                                                        <i class="fa fa-check"> </i> Make Active
                                                    </a>
                                                    @else
                                                    <a class="btn bg-color-blue txt-color-white btn-xs disabled" href="{{url('make-active-student-type/'.$student_type->id)}}">
                                                        <i class="fa fa-check"> </i> Make Active
                                                    </a>
                                                    @endif
                                                </td>
                                                @endif-->

                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float: right;">
                    {{ $student_types->links() }}
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')
