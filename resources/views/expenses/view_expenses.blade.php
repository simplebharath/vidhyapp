@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Expenses</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-expense-types')}}">Expense Types</a></li>
                <li class="active"><a href="{{url ('view-expenses')}}">Expenses</a></li>
            </ul>
        </div>
        <br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Expenses </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-expense')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Expense Type" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Pay To" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="amount" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Paid By" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" data-provide="datepicker" placeholder="Paid On" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="description" />
                                            </th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" class="form-control" placeholder="status" />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text"  class="form-control" placeholder="Actions" />
                                            </th>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Expense Type</th>
                                            <th data-sortable="true">Pay To</th>
                                            <th data-sortable="true">Amount</th>
                                            <th data-sortable="true">Paid By</th>
                                            <th data-sortable="true">Paid On</th>
                                            <th data-sortable="true">Description</th>
                                           @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th>Status</th>
                                            <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($expenses as $expense) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$expense->expenses->title}}</td>
                                                <td>{{$expense->pay_to }}</td>
                                                <td>{{$expense->amount  }}</td>
                                                <td>{{$expense->paid_by}}</td>
                                                <td>{{date('d-m-Y', strtotime($expense->paid_on))}}</td>
                                                <td>{{$expense->description }}</td>
                                                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
    <!--                                                <td><div class="btn-group">
                                                       <a href="{{ url('edit-expense/'.$expense->id)}}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                       <a href="{{ url('delete-expense/'.$expense->id) }}" onclick="return confirm('Are you sure to delete Expenses Details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                   </div></td>-->
                                                @if (($expense->status) == 1)
                                                <td><span class="label label-success"><i class="ace-icon fa fa-check bigger-120"></i>  Active </span> </td>
                                                <td><a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-expense/'.$expense->id)}}">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                                </td> 
                                                @else 
                                                <td><span class="label label-danger" ><i class="fa fa-times bigger-120"></i> Inactive </span></td>
                                                <td><a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-expense/'.$expense->id)}}">
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
