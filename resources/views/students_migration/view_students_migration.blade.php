@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Migration</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('classes-migration')}}">Migrate Classes</a></li>
                <li><a href="{{url ('students-migration')}}">Migrate Students</a></li>
                <li class="active"><a href="{{url ('view-migrated-classes')}}">Migrated Students</a></li>
                <li><a href="{{url ('migrate-timings')}}">Migrated Timings</a></li>
                <li><a href="{{url ('class-schedule-migration')}}">Class schedule</a></li>
                <li><a href="{{url ('staff-migration')}}">Migrate Staff</a></li>
                 <li><a href="{{url ('class-fee-migration')}}">Migrate Class-fee</a></li>
                 <li><a href="{{url ('transport-fee-migration')}}">Migrate Transport Fee</a></li>
            </ul>
        </div><br>     
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Promoted Students</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('students-migration')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="User type" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Module" />
                                            </th>
                                            <th class="hasinput" style="width:3%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            <th class="hasinput" style="width:3%">
                                                <input type="text" class="form-control" placeholder="Enter status" />
                                            </th>
                                            <th class="hasinput" style="width:3%">
                                                <input type="text"  class="form-control" placeholder="Enter change status" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Student</th>
                                            <th data-sortable="true">Module</th>
                                            <th >Actions</th>
                                            <th >Status</th>
                                            <th >Change status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($migrations as $migration) {
                                            ?> 
                                            <tr class="">                                                   
                                                <td>{{$migration->student->first_name}} {{$migration->student->last_name}}</td>
                                                <td> {{  date('Y', strtotime($migration->from_years->from_date))}} - {{  date('Y', strtotime($migration->from_years->to_date))}}</td>
                                                <td> {{$migration->from_classes->classes->class_name}}@if($migration->from_section_id > 0) -{{$migration->from_classes->sections->section_name}} @endif</td>
                                                <td> {{  date('Y', strtotime($migration->to_years->from_date))}} - {{  date('Y', strtotime($migration->to_years->to_date))}}</td>
                                                <td> {{$migration->to_classes->classes->class_name}}@if($migration->to_section_id > 0) -{{$migration->to_classes->sections->section_name}} @endif</td>


                                            </tr>
                                            <?php
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
