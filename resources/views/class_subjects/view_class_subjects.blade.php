@extends('layouts.master')
@section('sub-title', "")
@section("main-content")     
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                       
                        <h2>View Class-Subjects</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" @if(Session::get('add') == 1) href="{{url('add-class-subject')}}" @else disabled @endif style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                @if(Session::get('view')==1)
                                 <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Day" />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text"  class="form-control" placeholder="Class" />
                                            </th>
                                           
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Period" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control"  placeholder="Subject" />
                                            </th>
                                            <th class="hasinput" style="width:9%">
                                                <input type="text"  class="form-control"  placeholder="From" />
                                            </th>
                                            <th class="hasinput" style="width:9%">
                                                <input type="text"  class="form-control"  placeholder="To" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control"  placeholder="Duration" />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                          
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Day</th>
                                            <th data-sortable="true">Class</th> 
                                           
                                            <th data-sortable="true">Period</th>                                                                                                                                                                         
                                            <th data-sortable="true">Subject</th>
                                            <th data-sortable="true">From</th>
                                            <th data-sortable="true">To</th>
                                            <th data-sortable="true">Duration</th>
                                            <th>Actions</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($class_subjects as $class_subject) {
                                            ?> 
                                            <tr class="">      
                                                <td>{{$class_subject->days->day_title}}</td>                                                                  
                                                <td>{{$class_subject->classes->class_name}} @if ($class_subject->section_id !=0 ) - {{$class_subject->sections->section_name}}  @endif  </td>
                                                <td>{{ $class_subject->timings->title }}</td>
                                                <td>{{$class_subject->subjects->subject_name}}</td>
                                                <td>{{ $class_subject->timings->class_start }} </td>
                                                <td> {{ $class_subject->timings->class_end }} </td>
                                                <td>{{ $class_subject->timings->duration }}</td>
                                                <td><div class="btn-group">
                                                        <a  @if(Session::get('edit')==1) href="{{ url('edit-class-subject/'.$class_subject->id )}}" @endif title="Edit"><button class="btn btn-primary btn-xs" @if(Session::get('edit') !=1) disabled @endif data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                    </div>
                                            
                                                @if (($class_subject->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" @if(Session::get('edit') ==1) href="{{url('make-inactive-class-subject/'.$class_subject->id)}}" @else disabled @endif>
                                                       <i class="fa fa-times" > </i> 
                                                    </a>
                                              
                                                @else 
                                               
                                                <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" @if(Session::get('edit') ==1) href="{{url('make-active-class-subject/'.$class_subject->id)}}" @else disabled @endif>
                                                       <i class="fa fa-check"> </i>
                                                    </a>
                                               
                                                @endif
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                @else                                                                                                          
                                <h3 style="text-align: center;font-family: sans-serif;">You don't have permission to access this service.Please contact administrator.</h3>
                                @endif 
                            </div>
                        </div>
                    </div>
                </div>               
            </article>
        </div>
@endsection
