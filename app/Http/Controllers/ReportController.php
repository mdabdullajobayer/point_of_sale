<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function ReportView(): View
    {
        return view('pages.dashboard.reports');
    }
    public function Reports(Request $request)
    {
        $user_id = $request->header('id');
        $formdate = date('y-m-d', strtotime($request->formdate));
        $todate = date('y-m-d', strtotime($request->todate));
        $total = Invoice::where('user_id', $user_id)
            ->whereDate('created_at', '>=', $formdate)
            ->whereDate('created_at', '<=', $todate)
            ->sum('total');
        $vat = Invoice::where('user_id', $user_id)
            ->whereDate('created_at', '>=', $formdate)
            ->whereDate('created_at', '<=', $todate)
            ->sum('vat');
        $payable = Invoice::where('user_id', $user_id)
            ->whereDate('created_at', '>=', $formdate)
            ->whereDate('created_at', '<=', $todate)
            ->sum('payable');
        $discount = Invoice::where('user_id', $user_id)
            ->whereDate('created_at', '>=', $formdate)
            ->whereDate('created_at', '<=', $todate)
            ->sum('discount');
        $list = Invoice::where('user_id', $user_id)
            ->whereDate('created_at', '>=', $formdate)
            ->whereDate('created_at', '<=', $todate)
            ->with('customer')
            ->get();
        $data = [
            'total' => $total,
            'vat' => $vat,
            'payable' => $payable,
            'discount' => $discount,
            'list' => $list,
            'formdate' => $formdate,
            'todate' => $todate
        ];

        $pdf = Pdf::loadview('pages.reports.reportsPdf', $data);
        return $pdf->download('invoice.pdf');
    }
}
