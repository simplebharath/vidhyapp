@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
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
                <li class="active"><a href="{{url ('view-fees')}}">Fees</a></li>
                
                <li><a href="{{url ('view-class-fees')}}">class fees</a></li>
                <li><a href="{{url ('view-transport-fees')}}">Transport fee</a></li>
                
            </ul>
        </div><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2>Edit Fee</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-fees')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                         @if(Session::get('add') == 1)  <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-fee')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                      @else <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right disabled" href="#"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    @endif
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-edit-fee/'.$fees[0]->id) }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Fee title<span class="error">* </span></label>                                       
                                                <div class="col-sm-8">
                                                    <input type="text"  id="form-field-1"  name="fee_title" value="{{$fees[0]->fee_title}}"  class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8" required/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('fee_title') }}
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
                                                <a href="{{ url('view-fees')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">Views fees</span>
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