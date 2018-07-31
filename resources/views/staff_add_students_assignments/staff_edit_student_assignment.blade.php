@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Assignment</li><li>Class</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">Edit Assignment</a></li>
                <li><a href="{{url ('staff-view-class-assignments')}}">View Assignments</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">               
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>Assignment For class {{$assignments[0]->classes->class_name}} @if($assignments[0]->section_id > 0) {{$assignments[0]->sections->section_name}} @endif  @if($assignments != '') {{$assignments[0]->subjects->subject_name}} @endif</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('staff-get-students-assignments')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus"></i> Add</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('staff-view-class-assignments')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>                    
                    <div>                                                                 
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <form class="form-horizontal" action="{{url('staff-do-edit-assignment-class/'.$assignments[0]->id)}}" enctype="multipart/form-data" method="POST" >
                                    {{ csrf_field() }}                                                           
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                        <div class="dt-toolbar pull-right" style="float:right;">
                                            <div class="col-sm-10">
                                                <label> </label>
                                            </div>

                                            <div class="col-sm-2 pull-right">
                                                <button type="submit" class="width-10 btn btn-md btn-info">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update Assignment</span>
                                                </button>
                                            </div>
                                        </div>
                                        <thead>
                                            <tr>

                                                <th class="hasinput" style="width:5%">
                                                    <input type="text" readonly="" class="form-control" placeholder="Class" />
                                                </th>
                                                <th class="hasinput" style="width:15%">
                                                    <input type="text" class="form-control" placeholder="Assignment" />
                                                </th>

                                                <th class="hasinput" style="width:8%">
                                                    <input type="text" class="form-control" placeholder="Assignment sheet" />
                                                </th>

                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" readonly placeholder="Submission date" />
                                                </th>

                                            </tr>
                                            <tr>

                                                <th data-sortable="true">Class</th>
                                                <th data-sortable="true">Assignment</th>                                                
                                                <th data-sortable="true">Assignment sheet</th>  
                                                <th data-sortable="true">Submission date </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="">       

                                                <td> {{$assignments[0]->classes->class_name}} @if($assignments[0]->section_id > 0) - {{ $assignments[0]->sections->section_name}} @endif <br> {{$assignments[0]->subjects->subject_name}} </td>
                                                <td><input type="text" placeholder="Title" required="" name="assignment_title" value="{{$assignments[0]->assignment_title}}" class="col-xs-10 col-sm-5 col-md-10 col-lg-10"><br><br>
                                                    <textarea type="text" rows="5" required="" maxlength="1000" cols="47" placeholder="text here..." name="assignment_description">{{$assignments[0]->assignment_description}}</textarea> 
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('assignment_title' ) }}
                                                    </p>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('assignment_description' ) }}
                                                    </p>
                                                </td>
                                                <td> Assignment sheet  : <br><br> <input type="file" name="assignment_file" value="{{$assignments[0]->assignment_file}}"> <br>
                                                    <a @if($assignments[0]->assignment_file !='') href="{{url('uploads/assignments/'.$assignments[0]->assignment_file)}}" @endif target="_blank">@if($assignments[0]->assignment_file !='')<img src="{{URL::asset('uploads/assignments/'.$assignments[0]->assignment_file)}}"   height="50" width="50">@endif </a>
                                                </td>
                                                <td>Submission Date : <br><br> <input type="text" required="" name="last_date" value="{{$assignments[0]->last_date}}" data-provide="datepicker">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('last_date' ) }}
                                                    </p>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>     
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')