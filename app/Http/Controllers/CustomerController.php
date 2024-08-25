<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    //

    public function index(): View
    {
        return view('pages.dashboard.Customer');
    }

    public function list(Request $request)
    {
        $user_id = $request->header('id');
        $category = Customer::where('user_id', '=', $user_id)->latest()->get();
        return response()->json([
            'status' => 'success',
            'massage' => 'data get success',
            'data' => $category
        ]);
    }

    public function create(Request $request)
    {
        $user_id = $request->header('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');

        $date = Customer::create([
            'name' => $name,
            'email' => $email,
            'number' => $mobile,
            'user_id' => $user_id
        ]);
        if ($date) {
            return response()->json([
                'status' => 'success',
                'massage' => 'Customer Created Success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'massage' => 'Customer Created Faild',
            ]);
        }
    }

    public function delete(Request $request)
    {
        $user_id = $request->header('id');
        $customer = $request->input('id');
        $date = Customer::where('user_id', '=', $user_id)->where('id', '=', $customer)->delete();
        if ($date) {
            return response()->json([
                'status' => 'success',
                'massage' => 'customer Delete Success'
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'massage' => 'customer Delete Faild'
            ]);
        }
    }

    public function customerbyid(Request $request)
    {
        $user_id = $request->header('id');
        $customerbyid = $request->input('id');
        $date = Customer::where('user_id', '=', $user_id)->where('id', '=', $customerbyid)->first();
        if ($date) {
            return response()->json([
                'status' => 'success',
                'massage' => 'Success',
                'data' => $date
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'massage' => 'Faild'
            ]);
        }
    }

    public function update(Request $request)
    {
        $user_id = $request->header('id');
        $category_id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $number = $request->input('phone');
        $data = Customer::where('user_id', '=', $user_id)->where('id', '=', $category_id)->update(['name' => $name, 'email' => $email, 'number' => $number]);
        if ($data) {
            return response()->json(['status' => 'success', 'massage' => 'Category Update Success']);
        } else {
            return response()->json(['status' => 'success', 'massage' => 'Category Update Faild']);
        }
    }
}
