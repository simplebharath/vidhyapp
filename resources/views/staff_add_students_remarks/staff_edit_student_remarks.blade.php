@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">

                <li class="active"><a href="#">Edit Remarks</a></li>
                <li ><a href="{{url ('staff-view-students-remarks')}}">View Remarks</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">               
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>Remarks For class {{$class_name[0]->classes->class_name}} @if($class_name[0]->section_id > 0) {{$class_name[0]->sections->section_name}} @endif  @if($subject != '') {{$subject[0]->subject_name}} @endif</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('staff-get-students-remarks')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus"></i> Add</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('staff-view-students-remarks')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>                    
                    <div>                                                                 
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <form class="form-horizontal" action="{{url('staff-do-edit-remark/'.$remarks[0]->id)}}" enctype="multipart/form-data" method="POST" >
                                    {{ csrf_field() }}                                                           
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">

                                        <thead>
                                            <tr>


                                                <th class="hasinput" style="width:5%">
                                                    <input type="text" class="form-control" placeholder="Roll No" />
                                                </th>

                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="Name" />
                                                </th>

                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" readonly placeholder="Title" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" readonly placeholder="Description" />
                                                </th>
                                                <th class="hasinput" style="width:5%">
                                                    <input type="text" readonly class="form-control" readonly placeholder="Update" />
                                                </th>

                                            </tr>
                                            <tr>

                                                <th data-sortable="true">Roll No</th>                                                
                                                <th data-sortable="true">Name</th>  
                                                <th data-sortable="true">Title </th>
                                                <th data-sortable="true">Description </th>
                                                <th data-sortable="true">Update </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td>{{$remarks[0]->students->roll_number}}</td>
                                                <td>{{$remarks[0]->students->first_name}} {{$remarks[0]->students->last_name}} </td>  

                                                <td><input type="text" required="" placeholder="Title" name="remark_title" value="{{$remarks[0]->remark_title}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"></td>
                                                <td> <textarea type="text" required="" rows="5" maxlength="600" cols="35" placeholder="text here..." name="remark_description">{{$remarks[0]->remark_description}}</textarea> </td>
                                                <td><button class="btn btn-xs btn-primary" type="submit">Update</button></td>
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