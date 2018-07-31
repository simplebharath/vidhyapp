@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Library</li><li>Book</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{url ('view-books')}}">Books</a></li>
                <li><a href="{{url ('view-assign-books')}}"> Assign Books</a></li>
                <li><a href="{{url ('view-return-books')}}"> Return Books</a></li>

            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Books </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-book')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
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
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Book" />
                                            </th>
                                           
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Book Title " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Unique Id" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Author " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Publisher " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Book Price " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="No.Books " />
                                            </th>
                                            
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Assign" />
                                            </th>
                                           <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Book </th>
                                           
                                            <th data-sortable="true">Title</th>
                                            <th data-sortable="true">Unique Id</th>
                                            <th data-sortable="true">Author </th>
                                            <th data-sortable="true">Publisher </th>
                                            <th data-sortable="true">Price</th>
                                            <th data-sortable="true">No.Books</th>
                                           
                                            <th>Assign</th>
                                           <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($books as $book) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$book->staff_types->title}}<br> {{$book->departments->title}}</td>
                                             
                                                <td>{{$book->book_title}}</td>
                                                <td>{{$book->book_unique_id}}</td>
                                                <td>{{$book->book_author}}</td>
                                                <td>{{$book->book_publisher}}</td>
                                                <td>{{$book->book_price}}</td>
                                                <td>{{$book->number_of_books}}</td>
                                                
                                                <td><a  @if(Session::get('edit')==1) href="{{ ('add-assign-book/'.$book->id) }}" @endif><button class="btn txt-color-white btn-primary btn-xs" @if(Session::get('edit') !=1) disabled @endif>Give Book</button></a></td>
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-book/'.$book->id) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') ==1)
                                                        <a href="{{ url('delete-book/'.$book->id) }}" onclick="return confirm('Are you sure to delete book Details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                                @if (($book->status) == 1)

                                                <a class="btn bg-color-yellow txt-color-white btn-xs" rel="tooltip" title="" data-placement="bottom" data-original-title="Book is active,click here to make inactive." href="{{url('make-inactive-book/'.$book->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                             
                                                @else 

                                               <a class="btn bg-color-blue txt-color-white btn-xs" data-original-title="Book is inactive,click here to make active." href="{{url('make-active-book/'.$book->id)}}" title="Make active">
                                                        <i class="fa fa-check"> </i> 
                                                    </a>
                                                
                                                @endif  
                                                </td>
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
