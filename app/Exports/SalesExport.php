<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    protected $month, $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        $invoices = Invoice::with('items.product')
            ->whereMonth('invoice_date', $this->month)
            ->whereYear('invoice_date', $this->year)
            ->get();

        $data = [];

        foreach ($invoices as $invoice) {
            foreach ($invoice->items as $item) {
                $data[] = [
                    $invoice->invoice_date,
                    $invoice->customer_name,
                    $item->product->name ?? '-',
                    $item->quantity,
                    $item->price,
                    $item->quantity * $item->price,
                ];
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return ['Tanggal', 'Customer', 'Barang', 'Qty', 'Harga', 'Subtotal'];
    }
}
