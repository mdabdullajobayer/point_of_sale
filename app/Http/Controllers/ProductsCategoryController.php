<?php

namespace App\Http\Controllers;

use App\Models\ProductsCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductsCategoryController extends Controller
{
    public function index(): View
    {
        return view('pages.dashboard.category');
    }

    public function list(Request $request)
    {
        $user_id = $request->header('id');
        $category = ProductsCategory::where('user_id', '=', $user_id)->get();
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
        $date = ProductsCategory::create([
            'name' => $name,
            'user_id' => $user_id
        ]);
        if ($date) {
            return response()->json([
                'status' => 'success',
                'massage' => 'Category Created Success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'massage' => 'Category Created Faild',
            ]);
        }
    }

    public function delete(Request $request)
    {
        $user_id = $request->header('id');
        $category_id = $request->input('id');
        $date = ProductsCategory::where('user_id', '=', $user_id)->where('id', '=', $category_id)->delete();
        if ($date) {
            return response()->json([
                'status' => 'success',
                'massage' => 'Category Delete Success'
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'massage' => 'Category Delete Faild'
            ]);
        }
    }

    public function categorybyid(Request $request)
    {
        $user_id = $request->header('id');
        $category_id = $request->input('id');
        $date = ProductsCategory::where('user_id', '=', $user_id)->where('id', '=', $category_id)->first();
        if ($date) {
            return response()->json([
                'status' => 'success',
                'massage' => 'Category Delete Success',
                'data' => $date
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'massage' => 'Category Delete Faild'
            ]);
        }
    }

    public function update(Request $request)
    {
        $user_id = $request->header('id');
        $category_id = $request->input('id');
        $name = $request->input('name');
        $data = ProductsCategory::where('user_id', '=', $user_id)->where('id', '=', $category_id)->update(['name' => $name]);
        if ($data) {
            return response()->json(['status' => 'success', 'massage' => 'Category Update Success']);
        } else {
            return response()->json(['status' => 'success', 'massage' => 'Category Update Faild']);
        }
    }
}
