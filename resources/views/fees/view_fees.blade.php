@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Fees</li><li>Fees</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-fee-types')}}">Fee Types</a></li>
                <li class="active"><a href="{{url ('view-fees')}}">Fees</a></li>
               
                <li><a href="{{url ('view-class-fees')}}">class fees</a></li>
                <li><a href="{{url ('view-transport-fees')}}">Transport fee</a></li>
               
            </ul>
        </div><br>     
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Fees</h2>
                         @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        @if(Session::get('add') == 1)  <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-fee')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @else <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right disabled" href="#"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @endif
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
                                                <input type="text" class="form-control" placeholder="Enter fee" />
                                            </th>
                                             @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Edit" />
                                            </th>
                                            @endif
                                           
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Fee</th>
                                             @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th>Edit</th> 
                                            @endif
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($fees as $fee) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}}</td>
                                                <td>{{$fee->fee_title}}</td>
                                                 @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                @if($fee->non_editable == 0)
                                                <td><div class="btn-group">                                                       
                                                        @if(Session::get('edit') == 1) 
                                                        <a href="{{ url('edit-fee/'.$fee->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @else <a href="#" title="Edit"><button class="btn btn-primary btn-xs disabled" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @endif

                                                    </div>
                                                </td>
                                                @else
                                                <td> - </td>
                                                @endif

                                               @endif
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
    </div>
</div>
@include('include.footer')
