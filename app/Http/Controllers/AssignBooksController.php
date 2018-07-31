<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Assign_book;
use App\Http\Controllers\Controller;

class AssignBooksController extends Controller {

    public function view_assign_books() {
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = date("Y-m-d", strtotime($current_time));
        $assign_books = Assign_book::orderBy('returned', 'asc')->orderBy('return_date', 'asc')->get();
        return view('assign_books/view_assigned_books', compact('assign_books', 'current_date'));
    }

    public function add_assign_book($book_id) {
        $academic_year_id = Session::get('academic_year_id');
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = date("d-m-Y", strtotime($current_time));
        $book = \App\Book::where('id', $book_id)->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        return view('assign_books/add_assign_book', compact('book', 'class_sections', 'current_date'));
    }

    public function get_student(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $class_section_id = $request->input('class_section_id');
        $students = DB::select(DB::raw("SELECT id,first_name FROM `students` WHERE class_section_id=$class_section_id AND academic_year_id = $academic_year_id"));
        return($students);
    }

    public function do_add_assign_book(Request $request, $book_id) {
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = date("d-m-Y", strtotime($current_time));
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'class_section_id' => 'required',
            'student_id' => 'required',
            'return_date' => 'required|after:' . $current_date,
        ]);
        $class_sectionss = \App\Class_section::where('id', $request['class_section_id'])->get();
        $class_id = $class_sectionss[0]->class_id;
        if (($class_sectionss[0]->section_id) != 0) {
            $section_id = $class_sectionss[0]->section_id;
        } else {
            $section_id = '';
        }
        $checks = Assign_book::where('student_id', $request['student_id'])->where('book_id', $request['book_id'])->get();
        foreach ($checks as $check) {
            if ($check->returned == 0) {
                return redirect('view-assign-books')->with(['message-info' => 'This book already given to this student and not returned']);
            }
        }
        $assign_books = new Assign_book();
        $assign_books->class_section_id = $request['class_section_id'];
        $assign_books->class_id = $class_id;
        $assign_books->section_id = $section_id;
        $assign_books->student_id = $request['student_id'];
        $assign_books->given_date = $current_date;
        $assign_books->return_date = $request['return_date'];
        $assign_books->staff_type_id = $request['staff_type_id'];
        $assign_books->staff_department_id = $request['staff_department_id'];
        $assign_books->book_id = $request['book_id'];
        $assign_books->created_user_id = $created_user_id;
        $assign_books->academic_year_id = $academic_year_id;
        $assign_books->save();
        $book = \App\Book::where('id', $request['book_id'])->value('number_of_books');
        $no_books = $book - 1;
        \App\Book::where('id', $request['book_id'])->update(['number_of_books' => $no_books]);
        $data = array(
            'log_type' => ' Assign Book  added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-assign-books')->with(['message-success' => 'Assign Book added successfully.']);
    }

    public function edit_assign_book($assign_book_id) {
        $book = \App\Assign_book::where('id', $assign_book_id)->get();
        // $students = \App\Student::where('id', $assign_book_id)->get();
        return view('assign_books/edit_assigned_book', compact('book', 'students'));
    }

    public function do_edit_assign_book(Request $request, $assign_book_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = date("d-m-Y", strtotime($current_time));
        $this->validate($request, [

            'class_section_id' => 'required',
            'student_id' => 'required',
            'given_date' => 'required',
            'return_date' => 'required|after:' . $current_date,
        ]);

        $assign_books = Assign_book::find($assign_book_id);
        $assign_books->student_id = $request['student_id'];
        $assign_books->class_section_id = $request['class_section_id'];
        $assign_books->given_date = $request['given_date'];
        $assign_books->return_date = $request['return_date'];
        $assign_books->staff_type_id = $request['staff_type_id'];
        $assign_books->staff_department_id = $request['staff_department_id'];
        $assign_books->book_id = $request['book_id'];
        $assign_books->updated_user_id = $created_user_id;
        $assign_books->academic_year_id = $academic_year_id;
        $old_values = Assign_book::find($assign_book_id);

        $data = array(
            'log_type' => 'Assigned Book updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $assign_books->update();
        return redirect('view-assign-books')->with(['message-success' => 'Assign Book updated successfully.']);
    }

    public function delete_assign_book($assign_book_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = Assign_book::where('id', $assign_book_id)->get();
        $data = array(
            'log_type' => 'Assign Book deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Assign_book::where('id', $assign_book_id)->delete();
        return redirect('view-assign-books')->with(['message-danger' => 'Assign Book  deleted successfully.']);
    }

    public function make_inactive_assign_book($assign_book_id) {
        Assign_book::where('id', $assign_book_id)->update(['status' => 0]);
        return redirect('view-assign-books')->with(['message-warning' => 'Assign Book  inactivated successfully.']);
    }

    public function make_active_assign_book($assign_book_id) {
        Assign_book::where('id', $assign_book_id)->update(['status' => 1]);
        return redirect('view-assign-books')->with(['message-info' => 'Assign Book   activated successfully.']);
    }

}
