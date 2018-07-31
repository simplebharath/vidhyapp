@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
<script>
    function findTotal() {
        x = 0, y = 0;
        var x = parseInt(document.getElementById("late_by").value);
        var y = parseInt(document.getElementById("fine_per_day").value);
      
        document.getElementById('fine').value = (x * y);
    }
</script>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Library</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-books')}}">Books</a></li>
                <li ><a href="{{url ('view-assign-books')}}"> Assign Books</a></li>
                 <li  class="active"><a href="{{url ('view-return-books')}}"> Return Books</a></li>
            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add Return Book </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-return-books')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-add-return-book/'.$assign_book[0]->id) }}">
                                            {{ csrf_field() }}                                       
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Book type<span class="error">* </span></label>
                                                    <div class="col-sm-8">
                                                        <select  name="staff_type_id" id="staff_type_id"  class="col-xs-10 col-sm-5 col-md-8 col-lg-8">
                                                            <option value="{{$assign_book[0]->staff_type_id}}">{{$assign_book[0]->staff_types->title}}</option>
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
                                                            <option value="{{$assign_book[0]->staff_department_id}}">{{$assign_book[0]->departments->title}}</option>

                                                        </select> 
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('staff_department_id') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Book<span class="error">* </span></label>
                                                    <div class="col-sm-8">
                                                    <select  name="book_id" id="staff_department_id"  class="col-xs-10 col-sm-5 col-md-8 col-lg-8">
                                                            <option value="{{$assign_book[0]->id}}">{{$assign_book[0]->book->book_title}} by {{$assign_book[0]->book->book_author}} - {{$assign_book[0]->book->number_of_books}}</option>

                                                        </select>    
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('book_id') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Class<span class="error">* </span></label>
                                                    <div class="col-sm-8">
                                                    <select  name="class_section_id" id="book_section_id"  class="col-xs-10 col-sm-5 col-md-8 col-lg-8">
                                                        <option value="{{$assign_book[0]->class_section_id}}">{{$assign_book[0]->class_sections->classes->class_name}} @if(($assign_book[0]->section_id) != '0') -{{$assign_book[0]->class_sections->sections->section_name}} @endif</option>
                                                    </select> 
                                                </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('class_section_id') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Student<span class="error">* </span></label>
                                                    <div class="col-sm-8">
                                                        <select  name="student_id" id="student_id"  class="col-xs-10 col-sm-5 col-md-8 col-lg-8">
                                                            <option value="{{$assign_book[0]->student_id}}">{{$assign_book[0]->student->first_name}}</option>

                                                        </select> 
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('student_id') }}
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Given Date<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="given_date" readonly value="{{$assign_book[0]->given_date}}"  class="col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('given_date') }}
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Return Date<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="return_date" readonly value="{{$assign_book[0]->return_date}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('return_date') }}
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Late by days<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"   name="late_by" onblur="findTotal()" id="late_by" readonly value="{{ $difference }}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('late_by') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Fine per day <span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"   name="fine_per_day" onblur="findTotal()" id="fine_per_day" value="{{ old('fine_per_day') }}"  class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('fine_per_day') }}
                                                    </div>
                                                </div>
                                             
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Fine<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="fine" readonly name="fine" value="0" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('fine') }}
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
                                                    <a href="{{ url('view-return-books')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                        <i class="ace-icon fa fa-undo"></i>
                                                        <span class="bigger-110"> view Return Books</span>
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