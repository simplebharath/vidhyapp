@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('staff-get-students-remarks')}}">Add Remarks</a></li>
                <li class="active"><a href="{{url ('staff-view-students-remarks')}}">View Remarks</a></li>

            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Students Remarks</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('staff-get-students-remarks')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:4%">
                                                <input type="text" readonly="" class="form-control" placeholder="Image" />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Student" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Remark title" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Description" />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly=""  class="form-control" placeholder="Actions" />
                                            </th>


                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Image</th>   
                                            <th data-sortable="true"> Class</th>                                         
                                            <th data-sortable="true">Student</th>                                      
                                            <th data-sortable="true">Remark title</th>         
                                            <th data-sortable="true">Remark</th>
                                            <th data-sortable="true">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($remarks as $remark) {
                                            ?> 
                                            <tr class="">
                                                <td><img src="{{URL::asset('uploads/students/profile_photos/'.$remark->students->photo)}}"  @if($remark->students->gender = 'Male') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @if($remark->students->gender = 'Female') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  @endif height="50" width="50"> </td>
                                                <td> {{$remark->students->classes->class_name}} @if($remark->students->section_id > 0) - {{ $remark->students->sections->section_name}} @endif <br> @if($remark->subject_id >0){{$remark->subjects->subject_name}} @endif </td>
                                                <td>{{$remark->students->first_name}} {{$remark->students->last_name}} <br> {{$remark->students->roll_number}} <br> {{$remark->students->unique_id}}</td>                                              
                                                <td>{{$remark->remark_title}}</td>
                                                <td>{{$remark->remark_description}}</td>
                                                <td><div class="btn-group">
                                                        <a href="{{ url('staff-edit-remark/'.$remark->id)}}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        
                                                    </div></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>              
            </article>
        </div>
    </div>
</div>
@include('include.footer')
