<div class="well well-light well-sm no-margin no-padding">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-9">
                    <h2 style="padding-left: 0px;"> <span class="semi-bold">Academic year </span>
                        <br>
                        <small>{{$years[0]->start_year}} - {{$years[0]->end_year}}</small>
                    </h2>

                    <ul class="list-unstyled">
                        @if($days == '')
                        @if($each_day == '')
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$years[0]->start_date}} to {{$years[0]->end_date}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-calendar-plus-o"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$years[0]->start_month}} - {{$years[0]->start_year}} to {{$years[0]->end_month}} - {{$years[0]->end_year}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                            </p>
                        </li>
                        @endif
                        @endif
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-rupee"></i>&nbsp;&nbsp;<span class="txt-color-darken">Total Expenses <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Total Expenses for this academic year"> <b> &#8377; {{$years[0]->total}} </a></span>
                            </p>
                        </li>
                    </ul>

                </div>                                            
            </div>
            @if($days != '' )
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-9">
                     @if($each_day =='')
                    <h6 style="padding-left: 0px;"> <span class="semi-bold">Months </span>
                       
                    </h6>
                     @else 
                     <hr>
                     @endif
                    <ul class="list-unstyled">
                        <?php foreach ($months as $month) { ?> 
                            <li>
                                <p class="text-muted">
                                    <i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;<span class="txt-color-darken"><a href="{{url('balance-sheet-expenses-day/'.$years[0]->ac_id.'/'.$month->year.'/'.$month->month)}}">{{$month->month}} - {{$month->year}}</a> - &#8377; {{$month->total_amount}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                                </p>
                            </li>
                        <?php } ?>
                    </ul>

                </div>                                            
            </div>
            @endif
            @if($each_day != '' )
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-9">
                    <h6 style="padding-left: 0px;"> <span class="semi-bold">Days </span>
                        
                    </h6>
                    <ul class="list-unstyled">
                        <?php foreach ($days as $day) { ?> 
                            <li>
                                <p class="text-muted">
                                    <i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;<span class="txt-color-darken"><a href="{{url('balance-sheet-expenses-day-fees/'.$years[0]->ac_id.'/'.$day->year.'/'.$day->month_name.'/'.$day->today)}}"> {{$day->date}}</a> - &#8377; {{$day->total_expenses}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                                </p>
                            </li>
                        <?php } ?>
                            
                            @if($expenses !='')
                            <hr>
                        <?php foreach ($each_day as $each) { ?> 
                            <li>
                                <p class="text-muted">
                                    <i class="fa fa-industry"></i>&nbsp;&nbsp;<span class="txt-color-darken"><a href="{{url('balance-sheet-expense-history/'.$years[0]->ac_id.'/'.$day->year.'/'.$day->month_name.'/'.$each_day[0]->today.'/'.$each->expense_type_id)}}"> {{$each->title}}</a> - &#8377; {{$each->total_expenses}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                                </p>
                            </li>
                        <?php } ?>
                            @endif
                    </ul>

                </div>                                            
            </div>
            @endif
        </div><hr>
    </div>
</div>