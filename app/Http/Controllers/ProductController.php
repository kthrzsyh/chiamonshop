<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('latestPrice')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $product->prices()->create([
            'selling_price' => $request->selling_price,
            'cost_price' => $request->cost_price,
        ]);

        return Redirect::route('products.index')->with('status', 'products-store');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $prices = $product->prices()->latest()->get();
        return view('product.view', compact('product', 'prices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'selling_price' => 'required|numeric',
            'cost_price' => 'required|numeric',
        ]);

        // Update data produk
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Simpan harga baru ke tabel harga
        $product->prices()->create([
            'selling_price' => $request->selling_price,
            'cost_price' => $request->cost_price,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete(); // hard delete, atau pakai softDelete jika ingin
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
