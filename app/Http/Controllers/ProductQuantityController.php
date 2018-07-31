<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Product_quantity;
use App\Http\Controllers\Controller;

class ProductQuantityController extends Controller {

    public function view_products_quantities() {
        $academic_year_id = Session::get('academic_year_id');
        $products = Product_quantity::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('product_quantity/view_product_quantities', compact('products'));
    }

    public function add_product_quantity() {
        $products = \App\Product::where('status', '1')->get();
        return view('product_quantity/add_product_quantity', compact('products'));
    }

    public function do_add_product_quantity(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'total_quantity' => 'required',
            'each_quantity_price' => 'required',
            'total_quantity' => 'required',
            'total_price' => 'required',
            'product_id' => 'required',
        ]);
        $products = new Product_quantity();
        $products->total_quantity = $request['total_quantity'];
        $products->product_id = $request['product_id'];
        $products->each_quantity_price = $request['each_quantity_price'];
        $products->product_description = $request['product_description'];
        $products->each_quantity_price = $request['each_quantity_price'];
        $products->total_price = $request['total_price'];
        $products->created_user_id = $created_user_id;
        $products->academic_year_id = $academic_year_id;
        $products->save();
        $data = array(
            'log_type' => ' Product Quantity added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-product-quantities')->with(['message-success' => 'Product Quantity added successfully.']);
    }

    public function edit_product_quantity($product_quantity_id) {
        $products = Product_quantity::where('id', $product_quantity_id)->get();
        return view('product_quantity/edit_product_quantity', compact('products'));
    }

    public function do_edit_product_quantity(Request $request, $product_quantity_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'total_quantity' => 'required',
            'each_quantity_price' => 'required',
            'total_quantity' => 'required',
            'total_price' => 'required',
        ]);

        $products = Product_quantity::find($product_quantity_id);
        $products->total_quantity = $request['total_quantity'];
        $products->product_id = $request['product_id'];
        $products->each_quantity_price = $request['each_quantity_price'];
        $products->product_description = $request['product_description'];
        $products->each_quantity_price = $request['each_quantity_price'];
        $products->total_price = $request['total_price'];
        $products->updated_user_id = $created_user_id;
        //$products->academic_year_id = $academic_year_id;
        $old_values = Product_quantity::find($product_quantity_id);
        $data = array(
            'log_type' => 'Product Quantity updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $products->update();
        return redirect('view-product-quantities')->with(['message-success' => 'Product Quantity  updated successfully.']);
    }

    public function delete_product_quantity($product_quantity_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = Product_quantity::where('id', $product_quantity_id)->get();
        $data = array(
            'log_type' => 'Product Quantity deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Product_quantity::where('id', $product_quantity_id)->delete();
        return redirect('view-product-quantities')->with(['message-danger' => 'Product Quantity  deleted successfully.']);
    }

    public function make_inactive_product_quantity($product_quantity_id) {
        Product_quantity::where('id', $product_quantity_id)->update(['status' => 0]);
        return redirect('view-product-quantities')->with(['message-warning' => 'Product Quantity  inactivated successfully.']);
    }

    public function make_active_product_quantity($product_quantity_id) {
        Product_quantity::where('id', $product_quantity_id)->update(['status' => 1]);
        return redirect('view-product-quantities')->with(['message-info' => 'Product Quantity  activated successfully.']);
    }

}
