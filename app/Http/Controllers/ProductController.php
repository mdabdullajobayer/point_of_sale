<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{
    public function ProductsPage(): View
    {
        return view('pages.dashboard.products');
    }

    public function ProductsList(Request $request)
    {
        $user_id = $request->header('id');
        $products = Product::where('user_id', '=', $user_id)->latest()->get();
        return response()->json([
            'status' => 'success',
            'massage' => 'data get success',
            'data' => $products
        ]);
    }

    public function ProductCreate(Request $request)
    {
        try {
            $user_id = $request->header('id');
            $title = $request->input('title');
            $price = $request->input('price');
            $unit = $request->input('unit');
            $category_id = $request->input('category_id');

            $image = $request->file('image');
            $time = time();
            $fileName = $image->getClientOriginalName();

            $imageName = "{$user_id}-{$time}-{$fileName}";
            $imageURL = 'Uploads/' . $imageName;
            $image->move(public_path('Uploads'), $imageName);

            $date = Product::create([
                'title' => $title,
                'user_id' => $user_id,
                'category_id' => $category_id,
                'price' => $price,
                'unit' => $unit,
                'image_url' => $imageURL
            ]);
            if ($date) {
                return response()->json([
                    'status' => 'success',
                    'massage' => 'Product Created Success',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'massage' => 'Product Created Faild',
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function DeleteProduct(Request $request)
    {
        try {
            $user_id = $request->header('id');
            $product_id = $request->input('id');
            $file_path = $request->input('file_path');
            $data = Product::where('user_id', '=', $user_id)->where('id', '=', $product_id)->delete();
            File::delete($file_path);
            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'massage' => 'Product Delete Success'
                ]);
            } else {
                return response()->json([
                    'status' => 'success',
                    'massage' => 'Product Delete Faild'
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function ProductsById(Request $request)
    {
        $user_id = $request->header('id');
        $product_id = $request->input('id');
        $date = Product::where('user_id', '=', $user_id)->where('id', '=', $product_id)->first();
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

    public function ProductsUpdate(Request $request)
    {
        try {
            $user_id = $request->header('id');
            $product_id = $request->input('id');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $time = time();
                $imageName = "{$user_id}-{$time}-{$fileName}";
                $image_path = 'Uploads/' . $imageName;
                $file->move(public_path('Uploads'), $imageName);

                $oldImage = $request->input('file_path');
                File::delete($oldImage);

                $data = Product::where('user_id', $user_id)
                    ->where('id', $product_id)
                    ->update([
                        'title' => $request->input('title'),
                        'category_id' => $request->input('category_id'),
                        'image_url' => $image_path,
                        'price' => $request->input('price'),
                        'unit' => $request->input('unit')
                    ]);

                if ($data) {
                    return response()->json([
                        'status' => 'success',
                        'massage' => 'Product Updated'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'massage' => 'Product Update Failed'
                    ]);
                }
            } else {
                $data = Product::where('user_id', $user_id)
                    ->where('id', $product_id)
                    ->update([
                        'title' => $request->input('title'),
                        'category_id' => $request->input('category_id'),
                        'price' => $request->input('price'),
                        'unit' => $request->input('unit')
                    ]);

                if ($data) {
                    return response()->json([
                        'status' => 'success',
                        'massage' => 'Product Updated'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'massage' => 'Product Update Failed'
                    ]);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
