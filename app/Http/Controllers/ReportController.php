<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;
use PDF;

class ReportController extends Controller
{
    public function penjualan(Request $request)
    {
        $month = $request->month ?? now()->format('m');
        $year = $request->year ?? now()->format('Y');

        $invoices = Invoice::with('items.product')
            ->whereMonth('invoice_date', $month)
            ->whereYear('invoice_date', $year)
            ->latest()
            ->get();

        return view('reports.penjualan', compact('invoices', 'month', 'year'));
    }

    public function show($id)
    {
        $invoice = Invoice::with('items.product')->findOrFail($id);
        return view('reports.detail', compact('invoice'));
    }

    public function exportPdf(Request $request)
    {
        $month = $request->month ?? now()->format('m');
        $year = $request->year ?? now()->format('Y');

        $invoices = Invoice::with('items.product')
            ->whereMonth('invoice_date', $month)
            ->whereYear('invoice_date', $year)
            ->get();

        $pdf = PDF::loadView('reports.penjualan_pdf', compact('invoices', 'month', 'year'));
        return $pdf->download("Laporan_Penjualan_{$year}_{$month}.pdf");
    }

    public function exportExcel(Request $request)
    {
        $month = $request->month ?? now()->format('m');
        $year = $request->year ?? now()->format('Y');
        return Excel::download(new SalesExport($month, $year), "Laporan_Penjualan_{$year}_{$month}.xlsx");
    }
}
