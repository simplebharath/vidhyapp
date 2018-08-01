<?php 
$currentPath=Request::segment(1);
$this->class = new \App\Classes();
$this->classes = $this->class->classesTabs();

$this->section = new \App\Section();
$this->sections = $this->section->sectionTabs();

$this->classSection = new \App\Class_section();
$this->classSections = $this->classSection->classSectionTabs();

$this->subject = new \App\Subject();
$this->subjects = $this->subject->subjectTabs();

$this->classSubject = new \App\Class_subject();
$this->classSubjects = $this->classSubject->classSubjectTabs();

$this->classSubject = new \App\Class_subject();
$this->classSubjects = $this->classSubject->classSubjectTabs();

$this->classTeacher = new \App\Class_teacher();
$this->classTeachers = $this->classTeacher->classTeacherTabs();

$this->classSchedule = new \App\Models\BaseModel();
$this->classSchedules = $this->classSchedule->classScheduleTabs();
?>
@if(in_array($currentPath,$this->classSchedules) || in_array($currentPath,$this->classTeachers) || in_array($currentPath,$this->classSections) || in_array($currentPath,$this->classSubjects) || in_array($currentPath,$this->subjects) || in_array($currentPath,$this->classes) || in_array($currentPath,$this->sections) )
    <li @if( in_array($currentPath,$this->classes) ) class="active" @endif><a href="{{url ('view-classes')}}">Classes</a></li>
    <li @if( in_array($currentPath,$this->sections) ) class="active" @endif><a href="{{url ('view-sections')}}">Sections</a></li>
    <li @if( in_array($currentPath,$this->subjects) ) class="active" @endif><a href="{{url ('view-subjects')}}">Subjects</a></li>
    <li @if( in_array($currentPath,$this->classSections) ) class="active" @endif><a href="{{ url('view-class-sections')}}">Class-Sections</a></li>
    <li @if( in_array($currentPath,$this->classSubjects) ) class="active" @endif><a href="{{ url('view-class-subjects')}}">Class-Subjects</a></li> 
    <li @if(in_array($currentPath,$this->classSchedules)) class="active" @endif><a href="{{ url('view-class-schedule')}}">Class-Schedule</a></li> 
    <li @if(in_array($currentPath,$this->classTeachers)) class="active" @endif><a href="{{ url('view-class-teachers')}}">Class-Teacher</a></li>
@endif