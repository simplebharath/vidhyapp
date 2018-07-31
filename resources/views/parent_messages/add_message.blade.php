@include('include.header')
<style> #error-message{margin-left: 300px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Parent</li><li>Message</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
            <ul class="nav nav-tabs">
                <li  class="active"><a href="{{url ('add-message')}}">Compose Message</a></li>
                <li  class=""><a href="{{url ('view-messages')}}">View Sent Messages</a></li>

            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Compose Message</h2>

                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-add-message') }}">
                                            {{ csrf_field() }}                                       
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Subject<span class="error">* </span></label>                                               
                                                    <div class="col-sm-9 input">
                                                        <input type="text"  id="example1"  name="subject" value="{{ old('subject') }}" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('subject') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Message<span class="error">* </span></label>                                               
                                                    <div class="col-sm-9 input">
                                                        <textarea  name="message" cols="5" rows="10" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8">{{ old('message') }}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('message') }}
                                                    </div>
                                                </div>
                                                <div style="margin-left:40%">
                                                    <button type="submit" class="width-10 btn btn-md btn-success">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Send</span>
                                                    </button>
                                                    <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                        <i class="ace-icon fa fa-times red2"></i>
                                                        <span class="bigger-110">Cancel</span>
                                                    </button>   
                                                    <a href="{{ url('view-messages')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                        <i class="ace-icon fa fa-undo"></i>
                                                        <span class="bigger-110"> View Messages</span>
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