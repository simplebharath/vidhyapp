@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Fees</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-fee-types')}}">Fee Types</a></li>
                <li ><a href="{{url ('view-fees')}}">Fees</a></li>
               
                <li><a href="{{url ('view-class-fees')}}">class fees</a></li>
               <li><a href="{{url ('view-transport-fees')}}">Transport fee</a></li>
               <li><a href="{{url ('students-fee-payments')}}">Payments</a></li>
            </ul>
        </div><br>       
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Fee Fee-types</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  @if(Session::get('add') == 1) href="{{url('add-fee-feetype')}}" @else disabled @endif style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>

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
                                                <input type="text" class="form-control" placeholder="Fee type" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Fee title" />
                                            </th>
<!--                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Edit" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Enter status" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Enter change status" />
                                            </th>-->
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.no </th>
                                            <th data-sortable="true">Fee type </th>
                                            <th>Fee title</th>
<!--                                            <th>Edit</th>
                                            <th>Status</th>
                                            <th>Change status</th>-->

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($fee_feetypes as $fee_feetype) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}}</td>
                                                <td>{{$fee_feetype->fee_types->fee_name}}</td>
                                                <td>{{$fee_feetype->fees->fee_title}}</td>

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
