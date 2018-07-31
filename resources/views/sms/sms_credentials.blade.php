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
                <li  class="active"><a href="{{url ('sms-credentials')}}">SMS Credentials</a></li>
                <li><a href="{{url ('sms-compose')}}">Class SMS </a></li>
                <li><a href="{{url ('sms-sent')}}">Sent SMS </a></li>
                <li><a href="{{url ('sms-individual-create')}}">Individual SMS </a></li>
            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Send User Credentials</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> SMS Credit: {{$institute[0]->sms_count}}</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="GET" action="{{ url('sms-send-credentials') }}">
                                            {{ csrf_field() }}       
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Select Users<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <select   name="user_type_id"   class="col-xs-10 col-sm-5 col-md-8 col-lg-8" >
                                                        <option value="">-- select user --</option>    
                                                      
                                                        <?php foreach ($users as $user) { ?>                                                        
                                                            <option value="{{$user->id}}" @if (old('user_type_id') == $user->id) selected="selected" @endif> {{ $user->title }}  {{COUNT($user->staff)}} </option>
                                                        <?php } ?>
                                                             <?php foreach ($students as $student) { ?>                                                        
                                                            <option value="{{$student->id}}" @if (old('user_type_id') == $student->id) selected="selected" @endif> {{ $student->title }}  {{COUNT($student->students)}} </option>
                                                        <?php } ?>
                                                             <?php foreach ($parents as $parent) { ?>                                                        
                                                            <option value="{{$parent->id}}" @if (old('user_type_id') == $parent->id) selected="selected" @endif> {{ $parent->title }}  {{COUNT($parent->parents)}} </option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('user_type_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Note<span class="error"> </span></label>
                                                <div class="col-sm-8">
                                                    <textarea cols="50"  rows="2" maxlength="160" disabled=""  class="col-xs-10 col-sm-5 col-md- col-lg-8" placeholder="Selected users username and password sending to registered mobile numbers." name="description" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ old('description') }}</textarea>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('description') }}
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
                                                <a href="{{ url('sms-sent')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View Sent SMS</span>
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