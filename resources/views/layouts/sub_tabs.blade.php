@if( (Request::segment(1)=="add-class") || (Request::segment(1)=="edit-class") || (Request::segment(1)=="view-classes") )

    <li @if( (Request::segment(1)=="add-class") || (Request::segment(1)=="edit-class") || (Request::segment(1)=="view-classes") ) class="active" @endif>
        <a href="{{url ('view-classes')}}">Classes</a>
    </li>
    <li><a href="{{url ('view-sections')}}">Sections</a></li>
    <li ><a href="{{url ('view-subjects')}}">Subjects</a></li>
    <li ><a href="{{ url('view-class-sections')}}">Class-Sections</a></li>
    <li ><a href="{{ url('view-class-subjects')}}">Class-Subjects</a></li> 
    <li ><a href="{{ url('view-class-schedule')}}">Class-Schedule</a></li> 
    <li ><a href="{{ url('view-class-teachers')}}">Class-Teacher</a></li>
    
@endif