<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Product;
use App\Http\Controllers\Controller;

class ProductsController extends Controller {

    public function add_product() {
        return view('products/add_product');
    }

    public function do_add_product(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:products',
        ]);
        $products = new Product();
        $products->title = $request['title'];
        $products->created_user_id = $created_user_id;
        $products->academic_year_id = $academic_year_id;
        $products->save();
        $data = array(
            'log_type' => ' Product added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-products')->with(['message-success' => 'Product' . $request['title'] . ' added successfully.']);
    }

    public function view_products() {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products/view_products', compact('products'));
    }

    public function edit_product($product_id) {
        $products = Product::where('id', $product_id)->get();
        return view('products/edit_product', compact('products'));
    }

    public function do_edit_product(Request $request, $product_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:products,title,',
        ]);
        $products = Product::find($product_id);
        $products->title = $request['title'];
        $products->updated_user_id = $created_user_id;
        //$products->academic_year_id = $academic_year_id;
        $old_values = Product::find($product_id);

        $data = array(
            'log_type' => 'Product updated successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $products->update();
        return redirect('view-products')->with(['message-success' => 'Product ' . $request['title'] . ' updated successfully.']);
    }

    public function delete_product($product_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $title = Product::where('id', $product_id)->value('title');
        $old_values = Product::where('id', $product_id)->get();
       // print_r(COUNT($old_values[0]->products));exit;
       if(COUNT($old_values[0]->products) != 0){
            return redirect('view-products')->with(['message1-danger' => ' Product ' . $title . ' having records in product quantyties, You cannot delete.']);
           }
            
        $data = array(
            'log_type' => 'Product deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Product::where('id', $product_id)->delete();
        return redirect('view-products')->with(['message-danger' => ' Product ' . $title . ' deleted successfully.']);
    }

    public function make_inactive_product($product_id) {
        $title = Product::where('id', $product_id)->value('title');
        Product::where('id', $product_id)->update(['status' => 0]);
        return redirect('view-products')->with(['message-warning' => 'Product ' . $title . ' inactivated successfully.']);
    }

    public function make_active_product($product_id) {
        $title = Product::where('id', $product_id)->value('title');
        Product::where('id', $product_id)->update(['status' => 1]);
        return redirect('view-products')->with(['message-info' => 'Product ' . $title . ' activated successfully.']);
    }

}
