@include('include.header')
<style> #error-message{margin-left: 330px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{ url('add-academic-year')}}">Academic Year</a></li>
                 <li class=""><a href="#">Institution Details</a></li>
            </ul>
        </div><br>
        <div class="row"> 
             @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2> <?php if (COUNT($years) == 0) { ?>Add Academic Year <?php }else { ?>Select Academic Year <?php }?></h2>   
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                   
                                    <div class="col-xs-12 col-md-offset-1">
                                        <?php if (COUNT($years) == 0) { ?>
                                            <form  class="form-horizontal" role="form" method="POST" action="{{ url('settings/do-add-academic-year') }}">
                                                {{ csrf_field() }}                                       
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Start<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="from_date" value="{{ old('from_date') }}" data-provide="datepicker" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('from_date') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> End <span class="error">* </span></label>

                                                    <div class="col-sm-8">
                                                        <input type="text"  id="form-field-1"  name="to_date" value="{{ old('to_date') }}" data-provide="datepicker" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('to_date') }}
                                                    </div>
                                                </div>

                                                <div style="margin-left:40%">
                                                    <button type="submit" class="width-10 btn btn-md btn-success">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Save</span>
                                                    </button>
                                                    <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                        <i class="ace-icon fa fa-times red2"></i>
                                                        <span class="bigger-110">Cancel</span>
                                                    </button>   
                                                </div><br>
                                            </form>                                       
                                        <?php } else { ?>
                                            <form  class="form-horizontal" role="form" method="POST" action="{{ url('settings/do-update-academic-year') }}">
                                                {{ csrf_field() }}                                                                                                  
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Academic Year<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <select  name="academic_year_id"   class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>                                                      
                                                            <option value="{{$years[0]->id}}">{{$years[0]->from_year}} - {{$years[0]->to_year}}</option>                                                   
                                                        </select> 
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('academic_year_id') }}
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
                                                </div><br>
                                            </form>
                                        <?php } ?>
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