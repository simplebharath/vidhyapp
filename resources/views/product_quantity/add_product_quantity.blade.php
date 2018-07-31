@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
<script>
    function findTotal() {
        x = 0, y = 0, z = 0, a = 0;
        var x = parseInt(document.getElementById("total_quantity").value);
        var y = parseInt(document.getElementById("each_quantity_price").value);
        document.getElementById('total_price').value = (x*y);
    }
</script>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Inventory </li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
           <ul class="nav nav-tabs">
                <li><a href="{{url ('view-products')}}">Products</a></li>
                <li  class="active"><a href="{{url ('view-product-quantities')}}">Product Quantities</a></li>
            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add Product Quantity</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-product-quantities')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-add-product-quantity') }}">
                                            {{ csrf_field() }}                                       
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Product<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <select  name="product_id" id=""  class="col-xs-10 col-sm-5 col-md-8 col-lg-8">
                                                        <option value="">--- select Product---</option> 
                                                        <?php foreach ($products as $product) { ?>
                                                            <option value="<?php echo $product->id; ?>" @if(old('product_id') == $product->id ) selected @endif><?php echo $product->title; ?></option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('product_id') }}
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Total Quantity<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="number"  id="total_quantity"  name="total_quantity" onblur="findTotal()" value="{{ old('total_quantity') }}"  class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('total_quantity') }}
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Each Quantity Price<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="number"  id="each_quantity_price"  name="each_quantity_price" onblur="findTotal()" value="{{ old('each_quantity_price') }}" value="0" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('each_quantity_price') }}
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Total Price<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="number"  id="total_price" readonly="" style="background-color:lightgrey;" name="total_price" value="0"  class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('total_price') }}
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Description<span class="error"> </span></label>
                                                    <div class="col-sm-8">
                                                        <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md- col-lg-8" placeholder="" name="product_description" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ old('product_description') }}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('product_description') }}
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
                                                    <a href="{{ url('view-product-quantities')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                        <i class="ace-icon fa fa-undo"></i>
                                                        <span class="bigger-110"> View Product Quantities</span>
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
@include('include.footer')<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

