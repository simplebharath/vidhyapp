
                        
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr><h2 style="color:white; color:black; text-align: center; font-family: sans-serif;font-size: 20px;">{{ $institutions[0]->institution_name }}</h2></tr>
                                       
                                        <tr><h2><?php if($class_id == 0){ ?> View Students  <?php  }else{ foreach($classes as $class) {  ?> {{ $class->classes->class_name }}  @if(($class->section_id) > 0)  -  {{ $class->sections->section_name}} @endif , <?php }} ?>  @if($class_id != 0) Students @endif</h2>
                   </tr>
                                         <tr>
                                            <th data-sortable="true">Image</th>
                                            <th data-sortable="true">Student id</th>
                                            <th data-sortable="true">Student</th>
                                            <th data-sortable="true">Class-Roll No</th>
                                            <th data-sortable="true">Credentials </th>
                                            <th data-sortable="true">Parent</th>         

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($students as $student) {
                                            ?> 
                                            <tr class="">
                                                <td class="col-md-1"><a href="{{url('view-student-profile/'.$student->id)}}"></a>  </td>
                                                <td><a href="{{url('view-student-profile/'.$student->id)}}">{{$student->unique_id}}</a></td>
                                                <td>{{ $student->student_types->title }} <br><a href="{{url('view-student-profile/'.$student->id)}}">{{$student->first_name}}  {{$student->last_name}}</a> </td>    
                                                <td>{{$student->classes->class_name}} @if($student->section_id >0) - {{$student->sections->section_name}} @endif -{{ $student->roll_number}}</td>
                                                <td>User name: {{$student->user_logins->user_name}} <br> Password : {{$student->user_logins->password}}</td>
                                                <td style="word-wrap: break-word;">Father : {{$student->father_name}} <br> Mobile : {{$student->father_number}}</td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                           
