<?php 
$currentPath=Request::segment(1);
$staff_types=["view-staff-types", "add-staff-type", "edit-staff-type"];
$staff_departments = ["view-staff-departments", "edit-staff-department", "add-staff-department"];
$staff = ["view-staff", "add-staff", "edit-staff","add-staff-qualification","add-staff-experience","add-staff-document","edit-staff-experience","edit-staff-qualification","view-staff-profile","view-staff-experiences","view-staff-qualifications","view-staff-documents","view-staff-total-attendance","view-staff-salary"];

?>
@if(in_array($currentPath,$staff_types) ||  in_array($currentPath,$staff_departments) || in_array($currentPath,$staff))
<li  @if(in_array($currentPath,$staff_types) ) class="active" @endif><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
<li @if(in_array($currentPath,$staff) ) class="active" @endif><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
<li @if(0 ) class="active" @endif><a href="{{url ('view-staff')}}">Staff</a></li>  
<li @if(0 ) class="active" @endif><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
<li @if(0 ) class="active" @endif><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
<li @if(0 ) class="active" @endif><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>    
@endif

 