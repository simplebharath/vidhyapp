<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Return_book;
use DateTime;
use App\Http\Controllers\Controller;

class ReturnBookController extends Controller {

    public function view_return_books() {
        $academic_year_id = Session::get('academic_year_id');
        $return_books = Return_book::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('return_books/view_return_books', compact('return_books'));
    }

    public function add_return_book($assign_book_id) {
        $assign_book = \App\Assign_book::where('id', $assign_book_id)->get();
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = date("Y-m-d", strtotime($current_time));
        $year1 = date("Y-m-d", strtotime($assign_book[0]->return_date));
        $datetime1 = new DateTime($current_date);
        $datetime2 = new DateTime($year1);
        if ($current_date > $year1) {
            $difference = $datetime1->diff($datetime2)->days;
        } else {
            $difference = 0;
        }
        return view('return_books/add_return_book', compact('assign_book', 'difference'));
    }

    public function do_add_return_book(Request $request, $assign_book_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        if ($request['late_by'] != 0) {
            $this->validate($request, [
                'late_by' => 'required',
                'fine_per_day' => 'required',
                'fine' => 'required',
            ]);
        }
        $return_books = new Return_book();
        $return_books->late_by = $request['late_by'];
        $return_books->fine_per_day = $request['fine_per_day'];
        $return_books->fine = $request['fine'];
        $return_books->assign_book_id = $assign_book_id;
        $return_books->created_user_id = $created_user_id;
        $return_books->academic_year_id = $academic_year_id;
        $return_books->save();
        $book_id = \App\Assign_book::where('id', $assign_book_id)->value('book_id');
        $number_books = \App\Book::where('id', $book_id)->value('number_of_books');
        $books = $number_books + 1;
        \App\Book::where('id', $book_id)->update(['number_of_books' => $books]);
        \App\Assign_book::where('id', $assign_book_id)->update(['returned' => 1]);

        $data = array(
            'log_type' => ' Return Book  added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-return-books')->with(['message-success' => 'Return Book added successfully.']);
    }

    public function make_inactive_return_book($return_book_id) {
        Return_book::where('id', $return_book_id)->update(['status' => 0]);
        return redirect('view-return-books')->with(['message-warning' => 'Return Book  inactivated successfully.']);
    }

    public function make_active_return_book($return_book_id) {
        Return_book::where('id', $return_book_id)->update(['status' => 1]);
        return redirect('view-return-books')->with(['message-info' => 'Return Book  activated successfully.']);
    }

}
