@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Library</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-books')}}">Books</a></li>
                <li  class="active"><a href="{{url ('view-assign-books')}}"> Assign Books</a></li>
                <li><a href="{{url ('view-return-books')}}"> Return Books</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Assigned Books </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-books')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
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
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder="Book Type" />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder="Department" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text" class="form-control" placeholder="Book Title " />
                                            </th>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" class="form-control" placeholder="Class " />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder="Student" />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder="Given Date " />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder="Return Date " />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder="Assin " />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>

                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Book Type</th>
                                            <th data-sortable="true">Department</th>
                                            <th data-sortable="true">Title</th>
                                            <th data-sortable="true">Class</th>
                                            <th data-sortable="true">Student</th>
                                            <th data-sortable="true">Given date </th>
                                            <th data-sortable="true">Return Date </th>
                                            <th data-sortable="true">Assign </th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($assign_books as $assign_book) {
                                            $newDate = date("Y-m-d", strtotime($assign_book->return_date));
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$assign_book->staff_types->title}}</td>
                                                <td>{{$assign_book->departments->title}}</td>                                               
                                                <td>Book : {{$assign_book->book->book_title}} <br> Author : {{$assign_book->book->book_author}}  <br> NO.of.Books : {{$assign_book->book->number_of_books}}</td>
                                                <td>{{$assign_book->class_sections->classes->class_name}}   @if(($assign_book->section_id) != '0') - {{$assign_book->class_sections->sections->section_name}}@endif - {{$assign_book->student->roll_number}} </td>
                                                <td>{{$assign_book->student->first_name}}</td>
                                                <td>{{$assign_book->given_date}}</td>
                                                <td>@if($current_date >= $newDate && ($assign_book->returned) == 0)<span class="label label-danger">{{$assign_book->return_date}}</span> @else{{$assign_book->return_date}} @endif</td>
                                                @if(($assign_book->returned) == 0)
                                                <td><a  @if(Session::get('edit')==1) href="{{ ('add-return-book/'.$assign_book->id) }}" @endif><button class="btn txt-color-white btn-primary btn-xs" @if(Session::get('edit') !=1) disabled @endif>Return book</button></a></td>
                                                @else
                                                <td><span class="label label-success">Book Returned</span></td>
                                                @endif
                                                <td>
                                                    <div class="btn-group">
                                                        @if(($assign_book->returned) == 0)
                                                        <a href="{{ url('edit-assign-book/'.$assign_book->id) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @else
                                                        @if(Session::get('user_type_id') ==1)
                                                        <a href="{{ url('delete-assign-book/'.$assign_book->id) }}" onclick="return confirm('Are you sure to delete Assign book Details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                        @endif
                                                    </div>
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
