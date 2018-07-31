@include('include.header')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Fees</li><li>Fee types</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                
                <li class="active"><a href="{{url ('view-fee-types')}}">Fee Types</a></li>
                <li class=""><a href="{{url ('view-fees')}}">Fees</a></li>
                
                <li><a href="{{url ('view-class-fees')}}">class fees</a></li>
                <li><a href="{{url ('view-transport-fees')}}">Transport fee</a></li>
               
                          
            </ul>
        </div>
        <br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Fee Types </h2>
                         @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-fee-types')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    @endif
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
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Fee type" />
                                            </th>
                                            
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Status" />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Fee Type</th>                                       
                                             @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th>Status</th>
                                            <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($fees as $fee_type) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}}</td>
                                                <td>{{$fee_type->fee_name}}</td> 
                                                 @if (($fee_type->status) == 1)
                                                <td><span class="label label-success"><i class="ace-icon fa fa-check bigger-120"></i> Active </span> </td>
                                                @else 
                                                <td><span class="label label-danger" ><i class="fa fa-times bigger-120"></i> Inactive  </span></td>
                                                @endif
                                                 @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
<!--                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit_fee_type/'.$fee_type->id ) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        
                                                    </div></td>-->
                                                @if (($fee_type->status) == 1)
                                                <td><a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-fee-type/'.$fee_type->id)}}">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                                </td> 
                                                @else 
                                                <td><a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-fee-type/'.$fee_type->id)}}">
                                                        <i class="fa fa-check"> </i> 
                                                    </a>
                                                </td>
                                                @endif   
                                                @endif
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
