<?php

namespace App\Models;

use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_date',
        'customer_name',
        'shipping_cost',
        'box_fee',
        'notes',
        'total',
        'nomor_nota',
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
