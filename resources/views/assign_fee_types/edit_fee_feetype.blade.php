@include('include.header')
<style> #error-message{margin-left: 250px;}</style>
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
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add Fee-Fee type</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-fee-feetypes')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{url('do-edit-fee-feetype/'.$fee_feetypes[0]->id)}}">
                                            {{ csrf_field() }}


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fees<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="fee_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                       
                                                        <option value="{{$fee_feetypes[0]->fee_id}}">{{$fee_feetypes[0]->fees->fee_title}}</option>                                                      
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('fee_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee type<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="fee_type_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">

                                                         <?php foreach ($fee_types as $fee_type) { ?>
                                                            <option value="{{$fee_type->id}}" @if($fee_feetypes[0]->fee_type_id == $fee_type->id ) selected @endif>{{$fee_type->fee_name}}</option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('fee_type_id') }}
                                                </div>
                                            </div>
                                            <div style="margin-left:35%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-fee-feetypes')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View fee-fee types</span>
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