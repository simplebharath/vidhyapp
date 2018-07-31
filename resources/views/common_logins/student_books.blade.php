@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Student</li><li>My books</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
               
                <li class="active"><a href="{{url ('student-books')}}">My books</a></li>   
               
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Books </h2>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Department" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Book" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Price" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Student" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Submission date" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Status" />
                                            </th>
                                           
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control"  placeholder="Remark" />
                                            </th>
                                            
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Department</th>
                                            <th data-sortable="true">Book</th>
                                            <th data-sortable="true">Price</th>
                                             <th data-sortable="true">Student</th>
                                            <th data-sortable="true">Submission date</th>
                                            <th data-sortable="true">Status</th>
                                            <th data-sortable="true">Remark</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($books as $book) {
                                            ?> 
                                            <tr class="">
                                                <td>{{$book->departments->title}}<br> {{$book->book->book_unique_id}}</td>
                                                <td>{{$book->book->book_title}}<br>Author: {{$book->book->book_author}}</td>
                                                <td>Price : {{$book->book->book_price}}<br> Books Left : {{$book->book->number_of_books}}</td>
                                                <td> {{$book->student->first_name}} {{$book->student->last_name}}<br> {{$book->classes->class_name}} @if($book->section_id > 0 ) - {{$book->sections->section_name}} @endif {{$book->student->roll_number}}</td>
                                                <td>Taken On : {{$book->given_date}} <br> Last date :<i class="label label-warning">{{$book->return_date}}</i></td>
                                                <td> @if($book->return_book !='')<i class="label label-success">Book Returned</i> @else <i class="label label-danger">Book Not Returned</i>@endif</td>
                                                <td> @if($book->return_book !='') @if($book->return_book->late_by == 0)<i class="label label-info">Good</i> @else Late by : {{ $book->return_book->late_by }} days <br>Fine : {{ $book->return_book->fine }}@endif @else <i class="label label-primary"> Please, Return book in time </i> @endif</td>
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
                <div style="float: right;">
                </div>              
            </article>
        </div>
    </div>
</div>
@include('include.footer')
