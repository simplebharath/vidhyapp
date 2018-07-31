@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Staff</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
               
                <li class="active"><a href="{{url ('view-staff')}}">Staff</a></li>   
               
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Staff </h2>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" readonly=""class="form-control" placeholder="Image" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Name" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Email" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Staff type" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Department" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control"  placeholder="Designation" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Experience" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Image</th>
                                            <th data-sortable="true">Name</th>
                                            <th data-sortable="true">Email</th>
                                            <th data-sortable="true">Staff type</th>
                                            <th data-sortable="true">Department</th>
                                            <th data-sortable="true">Designation</th>
                                            <th data-sortable="true">Experience</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($staffs as $staff) {
                                            ?> 
                                            <tr class="">
                                                <td><img src="{{URL::asset('uploads/staff/'.$staff->photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/staff.jpg') }}'" height="50" width="50">  </td>
                                                <td>{{$staff->first_name}}  {{$staff->last_name}} </td>     
                                                <td>{{$staff->email}}</td>
                                                <td>{{$staff->staff_types->title}}</td>
                                                <td>{{$staff->staff_departments->title}}</td>
                                                <td>{{$staff->emp_designation}}</td>
                                                <td>{{$staff->experience}}</td>
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
                <div style="float: right;">
                </div>              
            </article>
        </div>
    </div>
</div>
@include('include.footer')
