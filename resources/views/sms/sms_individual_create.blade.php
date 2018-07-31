@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>SMS</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('sms-credentials')}}">SMS Credentials</a></li>
                <li><a href="{{url ('sms-compose')}}">Class SMS</a></li>
                <li><a href="{{url ('sms-sent')}}">Sent SMS </a></li>
                <li class="active"><a href="{{url ('sms-individual-create')}}">Individual SMS </a></li>

            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Compose Text Message</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> SMS Credit: {{$institute[0]->sms_count}}</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('sms-individual-view')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-envelope"></i> View sent SMS</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('sms-individual-send') }}">
                                            {{ csrf_field() }}       
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Phone<span class="error">* </span></label>
                                                <div class="col-sm-8 input">
                                                    <input type="number"   name="phone" maxlength="10" minlength="10" value="{{ old('phone') }}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Message<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <textarea  style="height:100px!important;" rows="2" maxlength="160"  class="col-xs-10 col-sm-5 col-md- col-lg-8" placeholder="" name="message" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ old('message') }}</textarea>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('message') }}
                                                </div>
                                            </div>
                                            <div class="col-md-offset-5">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Send</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('sms-individual-view')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View sent SMS</span>
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