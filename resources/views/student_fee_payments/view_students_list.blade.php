@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Payments</li><li>students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
               
                <li  class="active"><a href="{{url ('students-fee-payments')}}">Payments</a></li>
               <li ><a href="{{url ('payment-history-institute')}}">Payment history</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">               
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>Students</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('students-fee-payments')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> Add</a>
                    </header>                    
                    <div>                                                                 
                        <div class="widget-body no-padding">
                            <div class="table-responsive">

                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">

                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:3%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>

                                            <th class="hasinput" style="width:5%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Admission type" />
                                            </th>

                                            <th class="hasinput" style="width:18%">
                                                <input type="text" class="form-control" placeholder="Roll number" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text"  class="form-control" placeholder="Name" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text" class="form-control" placeholder="Student Id" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text" class="form-control" placeholder="View fees" />
                                            </th>

                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S No</th>
                                            <th data-sortable="true">Class</th>
                                            <th data-sortable="true">Admission type</th>
                                            <th data-sortable="true">Roll number</th>                                              
                                            <th data-sortable="true">Name</th>                                                
                                            <th data-sortable="true">Student id</th>
                                            <th data-sortable="true">View fees</th>             

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($students as $student) {
                                            ?> 
                                        <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ $student->classes->class_name }}  @if(($student->section_id) != 0)  -  {{ $student->sections->section_name}}  @endif </td>
                                        <td>{{$student->student_types->title}}</td>
                                        <td>{{$student->roll_number}}</td>
                                        <td>{{$student->first_name}} {{$student->last_name}}</td>
                                        <td>{{$student->unique_id}}</td>
                                        <td><a class="btn btn-xs btn-info" href="{{url('view-student-fee/'.$student->id)}}">View</a></td>
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