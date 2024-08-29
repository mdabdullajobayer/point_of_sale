<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductsCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('pages.dashboard.dashboard');
    }

    public function summary(Request $request): array
    {
        $user_id = $request->header('id');
        $product = Product::where('user_id', $user_id)->count();
        $Category = ProductsCategory::where('user_id', $user_id)->count();
        $Customer = Customer::where('user_id', $user_id)->count();
        $Invoice = Invoice::where('user_id', $user_id)->count();
        $total =  Invoice::where('user_id', $user_id)->sum('total');
        $vat = Invoice::where('user_id', $user_id)->sum('vat');
        $payable = Invoice::where('user_id', $user_id)->sum('payable');

        return [
            'product' => $product,
            'category' => $Category,
            'customer' => $Customer,
            'invoice' => $Invoice,
            'total' => round($total, 2),
            'vat' => round($vat, 2),
            'payable' => round($payable, 2)
        ];
    }
}
