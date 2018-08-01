@extends('layouts.master')
@section('sub-title', "")
@section("main-content")
<div class="row">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @include('include.messages')
        <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
            <header>
                
                <h2>View Subjects</h2>
                <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" @if(Session::get('add') == 1) href="{{url('add-subject')}}" @else disabled @endif style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
            </header>                    
            <div>                     
                <div class="jarviswidget-editbox">                          
                </div>                       
                <div class="widget-body no-padding">
                    <div class="table-responsive">
                        @if(Session::get('view')== 1)
                        <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th class="hasinput" style="width:10%">
                                        <input type="text" class="form-control" placeholder="S No" />
                                    </th>
                                    <th class="hasinput" style="width:10%">
                                        <input type="text" class="form-control" placeholder="Enter subject" />
                                    </th>

                                    <th class="hasinput" style="width:10%">
                                        <input type="text" class="form-control" placeholder="Actions" />
                                    </th>

                                </tr>
                                <tr>
                                    <th data-sortable="true">S.No</th>
                                    <th data-sortable="true">Subject</th>

                                    <th>Actions</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($subjects as $subject) {
                                    ?> 
                                    <tr class="">
                                        <td> {{$i}}</td>
                                        <td> {{ $subject->subject_name }} </td>
                                        <td><div class="btn-group">
                                                <a @if(session::get('edit') == 1) href="{{ url('edit-subject/'.$subject->id )}}" @endif title="Edit"><button @if(session::get('edit') == 1) class="btn btn-primary btn-xs" @else class="btn btn-primary btn-xs disabled" @endif  data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                            </div>


                                            @if (($subject->status) == 1)

                                            <a class="btn bg-color-yellow txt-color-white btn-xs"  @if(session::get('edit') == 1) href="{{url('make-inactive-subject/'.$subject->id)}}" title="Make inactive" @else disabled @endif>
                                               <i class="fa fa-times" > </i> 
                                            </a>

                                            @else 

                                            <a class="btn bg-color-blue txt-color-white btn-xs" @if(session::get('edit') == 1) href="{{url('make-active-subject/'.$subject->id)}}" title="Make active" @else disabled @endif >
                                               <i class="fa fa-check"> </i> 
                                            </a>

                                            @endif
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
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