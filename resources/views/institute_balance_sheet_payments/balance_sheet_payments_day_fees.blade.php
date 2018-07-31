@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Balance Sheet</li><li>Payments</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{url ('balance-sheet-payments-academic-years')}}">Payments</a></li>
                <li><a href="{{url ('balance-sheet-expenses-academic-years')}}">Expenses</a></li>
                 <li><a href="{{url ('balance-sheet-total-academic-years')}}">Total</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="col-sm-12 col-md-12 col-lg-3">
                    @include('institute_balance_sheet_payments.include_payments_year')
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-calendar-minus-o"></i> </span>
                            <h2>View Payments of @if($days !=0)<b> {{$days[0]->month_name}} - {{$days[0]->year}} : {{$each_day[0]->date}} ({{ $each_day[0]->day }})</b> @endif</h2>
                           
                            <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('balance-sheet-payments-day/'.$years[0]->ac_id.'/'.$days[0]->year.'/'.$days[0]->month_name)}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-arrow-left"></i>  BACK</a>
                        </header>
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
                                                    <input type="text" class="form-control" placeholder="S no" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Date" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Day" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Total Amount" />
                                                </th>
                                            </tr>
                                            <tr>
                                                <th data-sortable="true">S No</th>
                                                <th data-sortable="true">Date</th>
                                                <th data-sortable="true">Day</th>
                                                <th data-sortable="true">Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                     
                                            <?php $i = 1; $total=0;
                                            foreach ($each_day as $each) {
                                                 if( $each_day != '')  {  $total +=$each->total_payments; }
                                                ?>                                                                           
                                                <tr class="">      
                                                    <td>{{$i}}</td>
                                                    <td>{{$each->date}}({{$each->day}})</td>
                                                    <td><a href="{{url('balance-sheet-payment-history/'.$years[0]->ac_id.'/'.$days[0]->year.'/'.$days[0]->month_name.'/'.$each->today.'/'.$each->feeid)}}">{{$each->fee_title}}</a></td>
                                                    <td>{{$each->total_payments}}</td>
                                                </tr>
                                                <?php $i++;
                                            }
                                            ?>
                                            @if( $each_day != '')    <tr><td class="hidden">100</td><td></td><td></td><td>Total</td><td> &#8377; {{ $total }}</td></tr> @endif
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')
