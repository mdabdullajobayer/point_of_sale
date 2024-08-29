<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProducts;
use FFI\Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function Invioce(): View
    {
        return view('pages.dashboard.invoice');
    }
    public function SalePage(): View
    {
        return view('pages.dashboard.sale-page');
    }

    public function InvioceCreate(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id = $request->header('id');
            $total = $request->input('total');
            $discount = $request->input('discount');
            $vat = $request->input('vat');
            $payable = $request->input('payable');
            $customer_id = $request->input('customer_id');

            $invoice = Invoice::create([
                'total' => $total,
                'discount' => $discount,
                'vat' => $vat,
                'payable' => $payable,
                'customer_id' => $customer_id,
                'user_id' => $user_id
            ]);
            $invoiceID = $invoice->id;
            $products = $request->input('products');
            foreach ($products as $product) {
                InvoiceProducts::create([
                    'invoice_id' => $invoiceID,
                    'product_id' => $product['product_id'],
                    'user_id' => $user_id,
                    'qty' => $product['qty'],
                    'sale_price' => $product['sale_price']
                ]);
            }
            DB::commit();
            return 1;
        } catch (Exception $e) {
            DB::rollBack();
            return 0;
        }
    }

    public function InvoiceSelect(Request $request)
    {
        $user_id = $request->header('id');
        $invoice = Invoice::where('user_id', $user_id)->with('customer')->get();
        return response()->json([
            'status' => 'success',
            'massage' => 'success',
            'data' => $invoice
        ]);
    }

    public function InvoiceDetails(Request $request)
    {
        $user_id = $request->header('id');
        $invoice_id = $request->input('invoice_id');
        $customer_id = $request->input('customer_id');

        $customer = Customer::where('user_id', $user_id)
            ->where('id', $customer_id)
            ->first();
        $invoice = Invoice::where('user_id', $user_id)
            ->where('id', $invoice_id)
            ->first();
        $invoiceProduct = InvoiceProducts::where('user_id', $user_id)
            ->where('invoice_id', $invoice_id)
            ->with('product')
            ->get();
        return response()->json([
            'invoice' => $invoice,
            'customer' => $customer,
            'invoice_product' => $invoiceProduct
        ]);
    }

    public  function InvoiceDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id = $request->header('id');
            $invoice_id = $request->input('invoice_id');
            Invoice::where('user_id', $user_id)
                ->where('id', $invoice_id)
                ->delete();
            InvoiceProducts::where('user_id', $user_id)
                ->where('invoice_id', $invoice_id)
                ->delete();
            DB::commit();
            return 1;
        } catch (Exception $e) {
            DB::rollBack();
            return 0;
        }
    }
}
