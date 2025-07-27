<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function generateNomorNota($id): string
    {
        return 'INV-' . now()->format('Ymd') . '-' . str_pad($id, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $invoices = Invoice::all();
        return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::with('latestPrice')->get();
        return view('invoice.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // 1. VALIDASI AWAL
        $request->validate([
            'invoice_date'          => 'required|date',
            'customer_name'         => 'required|string|max:255',
            'items'                 => 'required|array|min:1',
            'items.*.product_id'    => 'required|exists:products,id',
            'items.*.quantity'      => 'required|integer|min:1',
            'items.*.price'         => 'required|numeric|min:0',
            'items.*.subtotal'      => 'required|numeric|min:0',
            'shipping_cost'         => 'nullable|numeric|min:0',
            'box_fee'               => 'nullable|numeric|min:0',
            'notes'                 => 'nullable|string',
        ]);

        // 2. Ambil semua produk dan harga terbarunya
        $productIds = collect($request->items)->pluck('product_id')->unique();
        $products = Product::with('latestPrice')
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        // 3. Validasi lanjutan: pastikan semua produk valid dan punya latestPrice
        foreach ($request->items as $item) {
            $product = $products[$item['product_id']] ?? null;
            if (!$product || !$product->latestPrice) {
                return back()->withErrors([
                    'items_invalid' => 'Harga terbaru tidak ditemukan untuk produk "' . ($product->name ?? 'Tidak diketahui') . '".'
                ])->withInput();
            }
        }

        // 4. Hitung total akhir
        $subtotal   = collect($request->items)->sum('subtotal');
        $shipping   = $request->shipping_cost ?? 0;
        $box        = $request->box_fee ?? 0;
        $total      = $subtotal + $shipping + $box;

        // 5. Buat invoice
        $invoice = Invoice::create([
            'invoice_date'   => $request->invoice_date,
            'customer_name'  => $request->customer_name,
            'shipping_cost'  => $shipping,
            'box_fee'        => $box,
            'notes'          => $request->notes,
            'total'          => $total,
        ]);

        $invoice->nomor_nota = $this->generateNomorNota($invoice->id);
        $invoice->save();

        // 6. Simpan setiap item
        foreach ($request->items as $item) {
            $product = $products[$item['product_id']];

            $invoice->items()->create([
                'product_id' => $product->id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
                'cost_price' => $product->latestPrice->cost_price,
            ]);
        }

        return redirect()->route('invoices.index')->with('success', 'Nota berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['items.product']);
        return view('invoice.view', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari invoice berdasarkan ID
        $invoice = Invoice::findOrFail($id);

        // Hapus invoice dari database
        $invoice->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('invoices.index')
            ->with('success', 'Nota berhasil dihapus.');
    }
}
