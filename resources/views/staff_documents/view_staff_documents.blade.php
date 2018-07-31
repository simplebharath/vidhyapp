@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Staff</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
         @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
                <li><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
                <li class="active"><a href="{{url ('view-staff')}}">Staff</a></li>     
                <li><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        @endif
        <section  class="">
            <div class="row">
                <div class=""style="margin-left: 15px;">
                    <ul class="nav nav-tabs pull-left">
                        <li ><a href="{{url ('view-staff-profile/'.$staffs[0]->id)}}">Profile</a></li>
                        <li><a href="{{url ('view-staff-experiences/'.$staffs[0]->id)}}">Experience</a></li>
                        <li ><a href="{{url ('view-staff-qualifications/'.$staffs[0]->id)}}">Qualifications</a></li> 
                        <li class="active" ><a href="{{url ('view-staff-documents/'.$staffs[0]->id)}}">Documents</a></li>
                       @if(Session::get('user_type_id') == 4)  <li><a href="{{url ('view-staff-timetable/'.$staffs[0]->id)}}">Timetable</a></li> @endif
                        <li><a href="{{url ('view-staff-total-attendance/'.$staffs[0]->id)}}">Attendance</a></li>
                        <li ><a href="{{url ('view-staff-salary/'.$staffs[0]->id)}}">Salary</a></li>
                    </ul>
                </div>
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @include('include.messages')
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        @include('staff_details.include_staff_profile')
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                            @if(Session::get('view') == 1)
                            <header>
                                <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                <h2> View <b> {{$staffs[0]->first_name}} {{$staffs[0]->middle_name}} {{$staffs[0]->last_name}}</b> Documents </h2>                               
                            </header>		
                            <div>

                                <div class="widget-body no-padding">
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">				
                                        <thead>
                                            <tr>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="S No" />
                                                </th>
                                                <th class="hasinput" style="width:18%">
                                                    <input type="text" class="form-control" placeholder="Enter File name" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" readonly="" class="form-control" placeholder="Click on  document" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" class="form-control" placeholder="Enter  Date" />
                                                </th>
                                                
                                            </tr>
                                            <tr>
                                                <th>S No</th>
                                                <th data-class="expand">File name</th>
                                                <th>Document</th>
                                                <th data-hide="phone">Created at</th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($staff_documents as $staff_document) {
                                                ?>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td><a target="_blank" href="{{url('uploads/staff_documents/'.$staff_document->document)}}"> {{ $staff_document->file_name }} </a></td>
                                                    <td><a target="_blank" href="{{url('uploads/staff_documents/'.$staff_document->document)}}"><img src="{{URL::asset('uploads/staff_documents/'.$staff_document->document)}}"  alt="document" title="{{$staff_document->file_name}}" class="superbox-img" style="width:100px;height: 60px;"></a></td>                                          
                                                    <td>{{$staff_document->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                                                                   
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>			
                                </div>
                            </div>

                            @else                                                                                                          
                            <h3 style="text-align: center;font-family: sans-serif;">You don't have permission to access this 'View Documents' service.Please contact administrator.</h3>
                            @endif 
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>
</div>

@include('include.footer')

