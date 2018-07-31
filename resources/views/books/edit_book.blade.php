@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
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
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2>Edit Book</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-books')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-book')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-edit-book/'.$books[0]->id) }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Book type<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <select  name="staff_type_id" id="staff_type_id"  class="col-xs-10 col-sm-5 col-md-8 col-lg-8">

                                                      
                                                            <option value="<?php echo $books[0]->staff_type_id; ?>" ><?php echo $books[0]->staff_types->title; ?></option>
                                                  
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('staff_type_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <select  name="staff_department_id" id="staff_department_id"  class="col-xs-10 col-sm-5 col-md-8 col-lg-8">

                                                     
                                                            <option value="<?php echo $books[0]->staff_department_id; ?>"><?php echo $books[0]->departments->title; ?></option>
                                                  
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('staff_department_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Book Title<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="text"  id="example1"  name="book_title" value="{{$books[0]->book_title}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('book_title') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Book ID<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="text"  id="example1"  name="book_unique_id" disabled="" value="{{$books[0]->book_unique_id}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('book_unique_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Book Author<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="text"  id="example1"  name="book_author" value="{{$books[0]->book_author}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('book_author') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Book Publisher<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="text"  id="example1"  name="book_publisher" value="{{$books[0]->book_publisher}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('book_publisher') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Book Price<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="number"  id="example1"  name="book_price" value="{{$books[0]->book_price}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('book_price') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Number Of Books<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="number"  id="example1"  name="number_of_books" value="{{$books[0]->number_of_books}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('number_of_books') }}
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
                                                <a href="{{ url('view-books')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110"> View Books</span>
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