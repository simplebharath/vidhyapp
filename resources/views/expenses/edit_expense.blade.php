@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
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
        </div><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2>Edit expenses</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-expenses')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-expense')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-edit-expense/'.$expenses[0]->id)}}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Expense Type<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="expense_type_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">                                                       
                                                        <option value="{{ $expenses[0]->expense_type_id }}">{{ $expenses[0]->expenses->title }}</option>                                                      
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('expense_type_id') }}
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pay To<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="pay_to" value="{{$expenses[0]->pay_to}}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('pay_to') }}
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Amount<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="amount" value="{{$expenses[0]->amount}}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('amount') }}
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Paid By<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="paid_by" value="{{$expenses[0]->paid_by}}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('paid_by') }}
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Paid On<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="paid_on" value="{{$expenses[0]->paid_on}}" data-provide="datepicker" class= "col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('paid_on') }}
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description<span class="error"> </span></label>
                                                    <div class="col-sm-9">
                                                        <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" placeholder="" name="description" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{$expenses[0]->description}}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('description') }}
                                                    </div>
                                                </div>
                                                
                                            <div style="margin-left:40%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-schedule-exams')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110"> View Schedule exams</span>
                                                </a>
                                            </div><br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <div class="col-xs-1 col-sm-1 col-md-6 col-lg-6"></div>
        </div>
    </div>
</div>
@include('include.footer')