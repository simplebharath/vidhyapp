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
        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
        <div class="">
            <ul class="nav nav-tabs">
                <li  ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li class="active"><a href="{{url ('view-students')}}">Students</a></li> 
                <li ><a href="{{url ('view-students-attendance')}}">Attendance</a></li>
                <li><a href="{{url ('view-all-student-fee-discounts')}}">Fee discounts</a></li>
            </ul>
        </div><br>
        @endif
        <div class="row">
            @include('include.messages')
            <div class="col-sm-12 col-md-12 col-lg-12" >
                <ul class="nav nav-tabs pull-left">
                    <li class="active"><a href="{{url ('view-student-profile/'.$students[0]->id)}}">Profile</a></li>
                    <li><a href="{{url ('view-student-timetable/'.$students[0]->id.'/'.$students[0]->class_section_id)}}">Timetable</a></li>
                    <li><a href="{{url ('view-student-documents/'.$students[0]->id)}}">Documents</a></li>
                    <li ><a href="{{url ('view-student-attendance/'.$students[0]->id)}}">Attendance</a></li>
                    <li ><a href="{{url ('view-student-fees/'.$students[0]->id)}}">Fees</a></li>
                    <li><a href="{{url ('view-fee-discounts/'.$students[0]->id)}}">Fee Discounts</a></li>
                    <li><a href="{{url ('view-student-payment-history/'.$students[0]->id)}}">Payments</a></li>
                    <li><a href="{{url ('view-student-assignments/'.$students[0]->id)}}">Assignments</a></li>
                    <li><a href="{{url ('view-student-remarks/'.$students[0]->id)}}">Remarks</a></li>
                    <li><a href="{{url ('view-student-exams/'.$students[0]->id)}}">Marks</a></li>
                    @if($students[0]->student_type_id == 1)
                    <li><a href="{{url ('view-student-transport/'.$students[0]->route_id.'/'.$students[0]->stop_id.'/'.$students[0]->id)}}">Transport</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-sm-12">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            @include('student_profile.include_profile')
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <div>
                            <?php if (COUNT($parents) != 0) { ?>
                                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">

                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                        <h2> View <b> {{$students[0]->first_name}} {{$students[0]->middle_name}} {{$students[0]->last_name}}</b> Parents </h2>
                                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('edit-parent/'.$parents[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-edit"></i> Edit Parent</a>
                                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-parents')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View all parents</a>

                                        @endif
                                    </header>		
                                    <div>
                                        <div class="widget-body no-padding">
                                            <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                                <thead> 
                                                   
                                                    <tr>
                                                        <th data-sortable="true">Father - Mother</th>
                                                        <th data-sortable="true">Father</th>
                                                        <th data-sortable="true">Mother</th>
                                                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 7)
                                                        <th data-sortable="true">Credentials</th>
                                                        @endif

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr class="">
                                                        <td><img src="{{URL::asset('uploads/students/father/'.$parents[0]->father_photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/father.png') }}'" height="50" width="50"> <img src="{{URL::asset('uploads/students/mother/'.$parents[0]->mother_photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/mother.png') }}'" height="50" width="50">  </td>
                                                        <td>Name : {{$parents[0]->students->father_name}} <br> Mobile number :  {{$parents[0]->students->father_number}} <br> Qualification :  {{$parents[0]->father_education}} <br> Occupation :  {{$parents[0]->father_occupation}}  <br> Email :  {{$parents[0]->father_email}}</td>    
                                                        <td>Name :  {{ $parents[0]->students->mother_name }} <br> Mobile number : {{ $parents[0]->students->mother_number }} <br> Qualification :  {{$parents[0]->mother_education}} <br> Occupation :  {{$parents[0]->mother_occupation}}  <br> Email :  {{$parents[0]->mother_email}}</td>
                                                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 7)
                                                        <td>User name: <br> {{$parents[0]->user_logins->user_name}} <br> Password : <br> {{$parents[0]->user_logins->password}} <br> Annual income : {{$parents[0]->family_income}}</td>
                                                        @endif
                                                    </tr>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                            <?php } ?>
                            </div>
                            <br>
                            <div>
                            <?php if (COUNT($educations) != 0) { ?>
                                <div>
                                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">

                                        <header>
                                            <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                            <h2> View <b> {{$students[0]->first_name}} {{$students[0]->middle_name}} {{$students[0]->last_name}}</b> Previous education </h2>
                                        </header>		
                                        <div>
                                            <div class="widget-body no-padding">
                                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                                    <thead> 
                                                        <tr>
                                                            <th class="hasinput" style="width:5%">
                                                                <input type="text" readonly=""class="form-control" placeholder="S no" />
                                                            </th>
                                                            <th class="hasinput" style="width:20%">
                                                                <input type="text" class="form-control" placeholder="Institute" />
                                                            </th>
                                                            <th class="hasinput" style="width:15%">
                                                                <input type="text" class="form-control" placeholder="Class From-To" />
                                                            </th>
                                                            <th class="hasinput" style="width:15%">
                                                                <input type="text" class="form-control" placeholder="Year From-To" />
                                                            </th>                                           
                                                        </tr>
                                                        <tr>
                                                            <th data-sortable="true">S no</th>
                                                            <th data-sortable="true">Institute</th>
                                                            <th data-sortable="true">Class From-To</th>
                                                            <th data-sortable="true">Year From-To</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        foreach ($educations as $education) {
                                                            ?>
                                                            <tr class="">
                                                                <td>{{$i}}</td>
                                                                <td>{{$education->institute_name}}</td>
                                                                <td>{{$education->class_from}} - {{$education->class_to}}</td>
                                                                <td>{{$education->from_year}} - {{$education->to_year}}</td>
                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                        ?>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('include.footer')
