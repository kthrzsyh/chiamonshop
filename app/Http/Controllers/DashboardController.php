<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();
        $year = $now->year;
        $month = $now->month;

        // Jumlah pesanan bulan ini
        $ordersThisMonth = Invoice::whereMonth('invoice_date', $month)
            ->whereYear('invoice_date', $year)
            ->count();

        // Omset bulan ini (tanpa ongkir & box)
        $omsetThisMonth = Invoice::whereMonth('invoice_date', $month)
            ->whereYear('invoice_date', $year)
            ->with('items')
            ->get()
            ->flatMap->items
            ->sum(fn($item) => $item->price * $item->quantity);

        // Keuntungan bulan ini
        $profitThisMonth = Invoice::whereMonth('invoice_date', $month)
            ->whereYear('invoice_date', $year)
            ->with('items')
            ->get()
            ->flatMap->items
            ->sum(fn($item) => ($item->price - $item->cost_price) * $item->quantity);

        // Penjualan bulanan 1 tahun terakhir
        $monthlySales = Invoice::whereYear('invoice_date', $year)
            ->with('items')
            ->get()
            ->flatMap->items
            ->groupBy(fn($item) => Carbon::parse($item->invoice->invoice_date)->format('F'))
            ->map(fn($items) => $items->sum(fn($i) => $i->price * $i->quantity));

        // Siapkan data grafik
        $months = collect(range(1, 12))->map(fn($m) => Carbon::create()->month($m)->format('F'));
        $chartLabels = $months->toArray();
        $chartData = $months->map(fn($m) => $monthlySales[$m] ?? 0)->toArray();

        // Item terlaris bulan ini
        $topProduct = InvoiceItem::select('product_id')
            ->with('product')
            ->whereHas('invoice', fn($q) =>
            $q->whereMonth('invoice_date', $month)->whereYear('invoice_date', $year))
            ->selectRaw('SUM(quantity) as total_quantity')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->first();

        return view('dashboard', compact(
            'ordersThisMonth',
            'omsetThisMonth',
            'profitThisMonth',
            'chartLabels',
            'chartData',
            'topProduct'
        ));
    }
}
