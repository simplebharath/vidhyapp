@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Fees </li><li>Class Fees</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-fee-types')}}">Fee Types</a></li>
                <li ><a href="{{url ('view-fees')}}">Fees</a></li>

                <li class="active"><a href="{{url ('view-class-fees')}}">class fees</a></li>
                <li><a href="{{url ('view-transport-fees')}}">Transport fee</a></li>

            </ul>
        </div><br>       
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Class fees</h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        @if(Session::get('add') == 1) <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-class-fee')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @else
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right disabled" href="#"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @endif
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
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Feetype - Fee title" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text"  class="form-control" placeholder="Fee" />
                                            </th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" readonly="" placeholder="Actions" />
                                            </th>

                                            @endif
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Fee type - Fee title</th>
                                            <th>Class</th>
                                            <th data-sortable="true">Amount</th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th>Actions</th>              
                                          
                                            @endif
                                        </tr>
                                    </thead>
                                    @if(Session::get('view') == 1)
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($class_fees as $class_fee) {
                                            ?> 
                                            <tr class="">
                                                <td class="col-md-1"> {{$i}}</td>
                                                <td>{{ $class_fee->fee_types->fee_name }} - {{ $class_fee->fees->fee_title}} </td>                                      
                                                <td>{{$class_fee->class_sections->classes->class_name}} @if ($class_fee->section_id >0 ) {{$class_fee->class_sections->sections->section_name}} @endif  </td>
                                                <td>{{$class_fee->fee_amount}}</td>
                                                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                <td><div class="btn-group">
                                                        @if(Session::get('edit') == 1)   <a href="{{ url('edit-class-fee/'.$class_fee->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Edit"><button class="btn btn-primary btn-xs disabled" data-title="Edit" data-toggle="#" data-target="#" disabled=""><span class="glyphicon glyphicon-pencil"></span></button></a>@endif
                                                        @if(Session::get('user_type_id') ==1)
                                                        @if((Session::get('delete') == 1)&&(Session::get('edit') == 1)) <a href="{{ url('delete-class-fee/'.$class_fee->id )}}" onclick="return confirm('Are you sure to delete class fee.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Delete"><button class="btn btn-danger btn-xs disabled" data-title="Delete" data-toggle="modal" data-target="#delete" disabled=""><span class="glyphicon glyphicon-trash"></span></button></a>@endif
                                                        @endif
                                                    </div>
                                              

                                                @if (($class_fee->status) == 1)

                                                @if(Session::get('edit') == 1)
                                                    <a class="btn bg-color-yellow txt-color-white btn-xs"  title="Make inactive" href="{{url('make-inactive-class-fee/'.$class_fee->id)}}">
                                                        <i class="fa fa-times" > </i>
                                                    </a> @else
                                                    <a class="btn bg-color-yellow txt-color-white btn-xs disabled"  title="Make inactive" href="{{url('make-inactive-class-fee/'.$class_fee->id)}}">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                                    @endif
                                              
                                                @else 

                                               @if(Session::get('edit') == 1)
                                                    <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-class-fee/'.$class_fee->id)}}">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                                    @else
                                                    <a class="btn bg-color-blue txt-color-white btn-xs disabled"  title="Make active" href="{{url('make-active-class-fee/'.$class_fee->id)}}">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                                    @endif
                                                
                                                @endif
                                </td>
                                                @endif
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
