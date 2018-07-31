<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Book;
use App\Http\Controllers\Controller;

class BooksController extends Controller {

    public function view_books() {
        $books = \App\Book::orderBy('created_at', 'desc')->get();
        return view('books/view_books', compact('books'));
    }

    public function add_book() {
        $staff_types = \App\Staff_type::where('status', '1')->get();
        return view('books/add_book', compact('staff_types'));
    }

    public function get_department(Request $request) {
        $staff_type_id = $request->input('staff_type_id');
        $staff_departments = DB::select(DB::raw("SELECT * FROM `staff_departments` where staff_type_id=$staff_type_id"));
        return ($staff_departments);
    }

    public function do_add_book(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'staff_type_id' => 'required',
            'staff_department_id' => 'required',
            'book_title' => 'required',
            'book_author' => 'required',
            'book_publisher' => 'required',
            'number_of_books' => 'required',
            'book_price' => 'required',
        ]);
        $academic_year_ids = \App\Institute_detail::where('status', '1')->get();
        $academic_year_id = Session::get('academic_year_id');
        $institute_code = $academic_year_ids[0]->institution_code;
        $books_ids = DB::select(DB::raw("SELECT max(id) as book_id FROM books"));
        if ($books_ids != ''):
            $book_id = $books_ids[0]->book_id;
        else:
            $book_id = 0;
        endif;
        $new_book_id = $book_id + 1001;
        $join = [$institute_code, 'B', $new_book_id];
        $book_unique_id = implode("-", $join);
        // dd($book_unique_id);
        $books = new Book();
        $books->staff_type_id = $request['staff_type_id'];
        $books->staff_department_id = $request['staff_department_id'];
        $books->book_title = $request['book_title'];
        $books->book_author = $request['book_author'];
        $books->book_publisher = $request['book_publisher'];
        $books->number_of_books = $request['number_of_books'];
        $books->book_price = $request['book_price'];
        $books->book_unique_id = $book_unique_id;
        $books->created_user_id = $created_user_id;
        $books->academic_year_id = $academic_year_id;
        $books->save();
        $data = array(
            'log_type' => ' Book added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-books')->with(['message-success' => 'Book added successfully.']);
    }

    public function edit_book($book_id) {
        $books = \App\Book::where('id', $book_id)->get();
        $staff_types = \App\Staff_type::where('id', $book_id)->get();
        $staff_departments = \App\Staff_department::where('staff_type_id', $book_id)->where('status', 1)->get();
        return view('books/edit_book', compact('staff_types', 'staff_departments', 'books'));
    }

    public function do_edit_book(Request $request, $book_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'staff_type_id' => 'required',
            'staff_department_id' => 'required',
            'book_title' => 'required',
            'book_author' => 'required',
            'book_publisher' => 'required',
            'number_of_books' => 'required',
            'book_price' => 'required',
        ]);
        $books = Book::find($book_id);
        $books->staff_type_id = $request['staff_type_id'];
        $books->staff_department_id = $request['staff_department_id'];
        $books->book_title = $request['book_title'];
        $books->book_author = $request['book_author'];
        $books->book_publisher = $request['book_publisher'];
        $books->number_of_books = $request['number_of_books'];
        $books->book_price = $request['book_price'];
        $books->updated_user_id = $created_user_id;
        //$books->academic_year_id = $academic_year_id;
        $old_values = Book::find($book_id);

        $data = array(
            'log_type' => 'Book updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $books->update();
        return redirect('view-books')->with(['message-success' => 'Book updated successfully.']);
    }

    public function delete_book($book_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $books = \App\Book::where('id', $book_id)->get();
        $data = array(
            'log_type' => 'Book  details deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $books,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Book::where('id', $book_id)->delete();
        return redirect('view-books')->with(['message-danger' => 'book details deleted successfully ']);
    }

    public function make_inactive_book($book_id) {

        Book::where('id', $book_id)->update(['status' => 0]);
        return redirect('view-books')->with(['message-warning' => 'Book Inactivated successfully.']);
    }

    public function make_active_book($book_id) {

        Book::where('id', $book_id)->update(['status' => 1]);
        return redirect('view-books')->with(['message-info' => 'Book  activated successfully.']);
    }

}
