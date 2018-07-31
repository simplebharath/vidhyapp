@include('include.header')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
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
                <li><a href="{{url ('view-assign-books')}}"> Assign Books</a></li>
                <li   class="active"><a href="{{url ('view-return-books')}}"> Return Books</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Return Books </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-assign-books')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
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
                                                <input type="text" class="form-control" placeholder=" Date " />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder="Late by days " />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder="Fine for Day " />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder="Fine " />
                                            </th>
                                           
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Book Type</th>
                                            <th data-sortable="true">Department</th>
                                            <th data-sortable="true">Title</th>
                                            <th data-sortable="true">Class</th>
                                            <th data-sortable="true">Student</th>
                                            <th data-sortable="true">Date </th>
                                            <th data-sortable="true">Late by Days </th>
                                            <th data-sortable="true">Fine for Day </th>
                                            <th data-sortable="true">Fine </th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($return_books as $return_book) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$return_book->assign_book->staff_types->title}}</td>
                                                <td>{{$return_book->assign_book->departments->title}}</td>
                                                <td>Book : {{$return_book->assign_book->book->book_title}} <br> Author : {{$return_book->assign_book->book->book_author}}  <br> NO.of.Books : {{$return_book->assign_book->book->number_of_books}}</td>
                                                <td>{{$return_book->assign_book->class_sections->classes->class_name}}   @if(($return_book->assign_book->section_id) != '0') - {{$return_book->assign_book->class_sections->sections->section_name}}@endif -{{$return_book->assign_book->student->roll_number}}</td>
                                                <td>{{$return_book->assign_book->student->first_name}}</td>
                                                <td>From : {{$return_book->assign_book->given_date}}<br> To : {{$return_book->assign_book->return_date}}</td>
                                                <td>{{$return_book->late_by}}</td>
                                                <td>{{$return_book->fine_per_day}}</td>
                                                <td>{{$return_book->fine}}</td>

<!--                                                @if (($return_book->status) == 1)
                                                <td><a class="btn bg-color-yellow txt-color-white btn-xs" rel="tooltip" title="" data-placement="bottom" data-original-title="Book is active,click here to make inactive." href="{{url('make-inactive-return-book/'.$return_book->id)}}">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                                </td> 
                                                @else 

                                                <td><a class="btn bg-color-blue txt-color-white btn-xs" data-original-title="Book is inactive,click here to make active." href="{{url('make-active-return-book/'.$return_book->id)}}">
                                                        <i class="fa fa-check"> </i> 
                                                    </a>
                                                </td>
                                                @endif  -->

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
