<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan - {{ $month }}/{{ $year }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Laporan Penjualan<br>Bulan {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
        {{ $year }}</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Barang</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @forelse($invoices as $invoice)
                @foreach ($invoice->items as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}</td>
                        <td>{{ $invoice->customer_name }}</td>
                        <td>{{ $item->product->name ?? '-' }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">Rp {{ number_format($item->price) }}</td>
                        <td class="text-right">Rp {{ number_format($item->price * $item->quantity) }}</td>
                        @php $grandTotal += $item->price * $item->quantity; @endphp
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data penjualan.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right"><strong>Total</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($grandTotal) }}</strong></td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
