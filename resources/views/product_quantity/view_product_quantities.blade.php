@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Inventory</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-products')}}">Products</a></li>
                <li  class="active"><a href="{{url ('view-product-quantities')}}">Product Quantities</a></li>
            </ul>
        </div>
        <br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Product Quantities </h2>
                    
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-product-quantity')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Product" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Total Quantity" />
                                            </th>
                                            <th class="hasinput" style="width:9%">
                                                <input type="text" class="form-control" placeholder="Each Quantity Price" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Total Price" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="description" />
                                            </th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                           
                                            @endif
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No </th>
                                            <th data-sortable="true">Product</th>
                                            <th data-sortable="true">Total Quantity </th>
                                            <th data-sortable="true">Each Quantity Price </th>
                                            <th data-sortable="true">Total Price</th>
                                            <th data-sortable="true">description  </th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th>Actions</th>
                                           
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($products as $product) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$product->product_quantity->title}}</td>
                                                <td>{{$product->total_quantity }}</td>
                                                <td>{{$product->each_quantity_price  }}</td>
                                                <td>{{$product->total_price}}</td>
                                                <td>{{$product->product_description }}</td>
                                                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-product-quantity/'.$product->id) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') == 1)
                                                        <a href="{{ url('delete-product-quantity/'.$product->id) }}" onclick="return confirm('Are you sure to delete product Quantity Details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                                @if (($product->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-product-quantity/'.$product->id)}}">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                               
                                                @else 
                                                
                                                <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-product-quantity/'.$product->id)}}">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                             
                                                @endif
                                                </td>
                                                @endif
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>        
            </article>
        </div>
    </div>
</div>
@include('include.footer')
