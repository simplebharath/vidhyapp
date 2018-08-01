@extends('layouts.master')
@section('sub-title', "")
@section("main-content")  
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
<!--                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>-->
                        <h2>View Sections</h2>
                        @if(Session::get('add') == 1)  <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-section')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @else <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right disabled" href="#"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @endif
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                 @if(Session::get('view') == 1)
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                <thead>
                                    <tr>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Enter section" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            
                                    </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Section</th>
                                            <th>Actions</th> 
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($sections as $section) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}}</td>
                                                <td>{{$section->section_name}}</td>
                                                <td><div class="btn-group">
                                                        @if(Session::get('edit') == 1) 
                                                        <a href="{{ url('edit-section/'.$section->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @else <a href="#" title="Edit"><button class="btn btn-primary btn-xs disabled" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @endif
                                                       
                                                    </div>
                                                

                                                @if (($section->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" @if(Session::get('edit') == 1) href="{{url('make-inactive-section/'.$section->id)}}" title="Make inactive" @else href="#" disabled  @endif>
                                                       <i class="fa fa-times" > </i> 
                                                    </a>
                                               
                                                @else 
                                                
                                                <a class="btn bg-color-blue txt-color-white btn-xs" @if(Session::get('edit') == 1) href="{{url('make-active-section/'.$section->id)}}" title="Make active"  @else href="#" disabled  @endif>
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