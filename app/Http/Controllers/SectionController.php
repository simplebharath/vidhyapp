<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Section;
use App\Http\Controllers\Controller;

class SectionController extends Controller {

    public function add_section() {
        $subTitle = Section::subTitle();
        $add = Session::get('add');
        if ($add != 1) {
            return redirect('view-sections');
        } else {
            return view('section/add_section',compact('subTitle'));
        }
    }

    public function do_add_section(Request $request) {
        $this->validate($request, Section::sectionValidationAdd());
        Section::sectionSaveOrUpdate($request);
        return redirect('view-sections')->with(['message-success' => 'sections ' . $request['section_name'] . ' added successfully.']);
    }

    public function view_section() {
         $subTitle = Section::subTitle();
        $sections = Section:: orderBy('created_at', 'desc')->get();
        return view('section/view_section', compact('sections','subTitle'));
    }

    public function edit_section($section_id) {
         $subTitle = Section::subTitle();
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $sections = Section::where('id', $section_id)->get();
            return view('section/edit_section', compact('sections','subTitle'));
        } else {
            return redirect('view-sections');
        }
    }

    public function do_edit_section(Request $request, $section_id) {
        $this->validate($request, Section::sectionValidationEdit($section_id));
        Section::sectionSaveOrUpdate($request,$section_id);
        return redirect('view-sections')->with(['message-success' => 'section ' . $request['section_name'] . ' updated successfully.']);
    }

    public function make_inactive_section($section_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $section_name = Section::where('id', $section_id)->value('section_name');
            Section::where('id', $section_id)->update(['status' => 0]);
            return redirect('view-sections')->with(['message-warning' => 'Section ' . $section_name . ' inactivated successfully.']);
        } else {
            return redirect('view-sections');
        }
    }

    public function make_active_section($section_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $section_name = Section::where('id', $section_id)->value('section_name');
            Section::where('id', $section_id)->update(['status' => 1]);
            return redirect('view-sections')->with(['message-info' => 'Section ' . $section_name . ' activated successfully.']);
        } else {
            return redirect('view-sections');
        }
    }

    public function delete_section($section_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($delete == 1) && ($view == 1)) {
            $section_name = Section::where('id', $section_id)->value('section_name');
            $old_values = Section::where('id', $section_id)->get();
            $user_id = Session::get('user_login_id');
            $academic_year_id = Session::get('academic_year_id');
            $data = array(
                'log_type' => 'Section deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $old_values,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $user_id);
            DB::table('log_details')->insert($data);
            Section::where('id', $section_id)->delete();
            return redirect('view-sections')->with(['message-danger' => 'Section ' . $section_name . ' deleted successfully.']);
        } else {
            return redirect('view-sections');
        }
    }

}
