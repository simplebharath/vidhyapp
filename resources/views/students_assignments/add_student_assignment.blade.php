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
                <li class="active"><a href="{{url ('get-students-assignments')}}">Add Assignment</a></li>
                <li><a href="{{url ('view-class-assignments')}}">View Assignments</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">               
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>Assignment For class {{$class_name[0]->classes->class_name}} @if($class_name[0]->section_id > 0) {{$class_name[0]->sections->section_name}} @endif </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('get-students-assignments')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus"></i> Add</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-class-assignments')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>                    
                    <div>                                                                 
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <form class="form-horizontal" action="{{url('do-add-assignment-class')}}" enctype="multipart/form-data" method="POST" >
                                    {{ csrf_field() }}                                                           
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                        <div class="dt-toolbar pull-right" style="float:right;">
                                            <div class="col-sm-10">
                                                <label> </label>
                                            </div>

                                            <div class="col-sm-2 pull-right">
                                                <button type="submit" class="width-10 btn btn-md btn-info">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save Assignment</span>
                                                </button>
                                            </div>
                                        </div>
                                        <thead>
                                            <tr>
                                                <th class="hasinput" style="width:3%">
                                                    <input type="text" class="form-control" placeholder="S No" />
                                                </th>
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
                                                <th data-sortable="true">S No</th>
                                                <th data-sortable="true">Class</th>
                                                <th data-sortable="true">Assignment</th>                                                
                                                <th data-sortable="true">Assignment sheet</th>  
                                                <th data-sortable="true">Submission date </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($class_name as $class) {
                                                ?> 
                                                <tr class="">       
                                            <input type="text" name="subject_id" hidden="" value="{{$subject[0]->id}}">
                                            <td>{{$i}}</td>
                                            <td> {{$class->classes->class_name}} @if($class->section_id > 0) - {{ $class->sections->section_name}} @endif <br> {{$subject[0]->subject_name}} </td>
                                            <td><input type="text" required="" placeholder="Title" name="assignment_title[<?php echo $class->id; ?>]" value="{{old('assignment_title')}}" class="col-xs-10 col-sm-5 col-md-11 col-lg-11"><br><br>
                                                <textarea type="text" required="" rows="5"  maxlength="1000" cols="47" placeholder="text here..." name="assignment_description[<?php echo $class->id; ?>]">{{old('assignment_description')}}</textarea> 
                                                <p class="help-block" style="color: red;">
                                                    {{ $errors->first('assignment_title' ) }}
                                                </p>
                                                <p class="help-block" style="color: red;">
                                                    {{ $errors->first('assignment_description' ) }}
                                                </p>
                                            </td>
                                            <td> Assignment sheet  : <br><br> <input type="file" name="assignment_file[<?php echo $class->id; ?>]" value="{{old('assignment_file')}}"></td>
                                            <td>Submission Date : <br><br> <input type="text" required="" name="last_date[<?php echo $class->id; ?>]" value="{{old('last_date')}}" data-provide="datepicker"></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
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