@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Students</li><li>Fee discount</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li ><a href="{{url ('view-students')}}">Students</a></li> 
                <li><a href="{{url ('view-students-attendance')}}">Attendance</a></li>
                <li  class="active"><a href="{{url ('view-all-student-fee-discounts')}}">Fee discounts</a></li>
            </ul>
        </div><br>       
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Student Fee Discounts</h2>
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
                                                <input type="text" class="form-control" placeholder="Student ID" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text" readonly=""  class="form-control" placeholder="Image" />
                                            </th>
                                            <th class="hasinput" style="width:23%">
                                                <input type="text" class="form-control" placeholder="Name" />
                                            </th>
                                            <th class="hasinput" style="width:18%">
                                                <input type="text" class="form-control" placeholder="Class-Roll No" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text"  class="form-control" placeholder="Fee- Discount" />
                                            </th>
                                           
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Student ID</th>
                                            <th data-sortable="true">Image</th>
                                            <th data-sortable="true">Name</th>
                                            <th data-sortable="true">Class-Roll No</th>
                                            <th data-sortable="true">Fee-Discount</th>
                                            

                                        </tr>
                                    </thead>
                                    @if(Session::get('view') == 1)
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($discounts as $discount) {
                                            ?> 
                                            <tr class="">
                                                <td class="col-md-1"> {{$i}}</td>
                                                <td><a href="{{url('view-fee-discounts/'.$discount->students->id)}}"> {{$discount->students->unique_id}}</td>
                                                <td><a href="{{url('view-fee-discounts/'.$discount->students->id)}}"><img src="{{URL::asset('uploads/students/profile_photos/'.$discount->students->photo)}}"  @if($discount->students->gender = 'Male') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @if($discount->students->gender = 'Female') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  @endif height="50" width="50"></a>  </td>
                                                <td><a href="{{url('view-fee-discounts/'.$discount->students->id)}}">{{$discount->students->first_name}} {{$discount->students->last_name}} </a></td>
                                                <td>{{$discount->students->classes->class_name}} @if($discount->students->section_id > 0) {{$discount->students->sections->section_name}} @endif- {{$discount->students->roll_number}}</td>
                                                <td>{{ $discount->fees->fee_title }}<br>{{$discount->discount}}</td>
                                                                                               
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
            </article>
        </div>
    </div>
</div>
@include('include.footer')
