# Quick Reference: Edit Invoice Feature

## How to Use the Edit Feature

### For End Users

1. Go to invoice list page
2. Click "Edit" button on desired invoice
3. Modify any fields:
    - **Tanggal Nota** - Change invoice date
    - **Nama Customer** - Update customer name
    - **Items Section:**
        - Select/change product
        - Modify quantity
        - **Override price** (new feature!) - change selling price for this item
        - Subtotal auto-calculates
    - **Ongkir** - Update shipping cost
    - **Biaya Box** - Update box fee
    - **Catatan** - Add/edit notes
4. Click **"+ Tambah Barang"** to add items
5. Click **"Hapus"** to remove items
6. Click **"Simpan Nota"** to save

### Price Override Example

-   Product listed at 100,000 in pricelist
-   Override to 95,000 for this specific invoice
-   System saves 95,000 in this invoice's item
-   Original pricelist remains unchanged

## Developer Reference

### Controller Method: `update()`

Location: `app/Http/Controllers/InvoiceController.php`

```php
public function update(Request $request, string $id)
```

**Flow:**

1. Find invoice → 404 if not found
2. Validate input → 422 if invalid
3. Fetch products with prices
4. Check all products have prices
5. Calculate total
6. Update invoice
7. Delete old items
8. Create new items
9. Redirect to index with success message

**Error Handling:**

-   Validation errors: Return to form with error messages
-   Product missing: Custom error "Harga terbaru tidak ditemukan..."
-   Success: "Nota berhasil diperbarui"

### View: `edit.blade.php`

Location: `resources/views/invoice/edit.blade.php`

**Key Components:**

-   Form action: `route('invoices.update', $invoice->id)` with `@method('PUT')`
-   Items loop: `@foreach ($invoice->items as $index => $item)`
-   Price field: `name="items[{{ $index }}][price]"` - **EDITABLE**
-   JavaScript: Auto-calculates subtotals, manages item additions/removals

### Validation Rules

```php
'invoice_date'       => 'required|date',
'customer_name'      => 'required|string|max:255',
'items'              => 'required|array|min:1',
'items.*.product_id' => 'required|exists:products,id',
'items.*.quantity'   => 'required|integer|min:1',
'items.*.price'      => 'required|numeric|min:0',
'items.*.subtotal'   => 'required|numeric|min:0',
'shipping_cost'      => 'nullable|numeric|min:0',
'box_fee'            => 'nullable|numeric|min:0',
'notes'              => 'nullable|string',
```

## Key Differences from Create Feature

### Create (`store()`)

-   Price is set from pricelist automatically
-   Price field is readonly
-   Generates new nomor_nota

### Edit (`update()`)

-   Price can be manually overridden
-   Price field is **editable**
-   nomor_nota never changes (immutable)
-   Can add/remove items
-   Total recalculated

## Database Behavior

### What Changes

-   `invoices` record: date, customer, shipping, box, notes, total
-   `invoice_items`: ALL deleted, then recreated from form data

### What Doesn't Change

-   `invoices.nomor_nota` - IMMUTABLE
-   `invoices.id` - PRIMARY KEY
-   Created/updated timestamps follow Laravel defaults

### Price Storage

-   **Override price**: Stored in `invoice_items.price`
-   **Cost price**: Always from `ProductPrice::latest` (not user-editable)

## Troubleshooting

### Prices don't show

-   Check product has a `ProductPrice` entry
-   Ensure `Product::latestPrice` relationship is correct
-   View source: Look for `data-price` attributes in options

### Items not calculating subtotal

-   Check browser console for JavaScript errors
-   Verify `calculateSubtotal()` function exists
-   Ensure form fields have correct `name` attributes

### Form won't submit

-   Check validation errors displayed in red
-   Ensure at least one item exists
-   Verify all required fields have values

### nomor_nota changed (shouldn't happen)

-   Check code wasn't modified to update it
-   nomor_nota is explicitly excluded from update: only these fields update:
    -   invoice_date, customer_name, shipping_cost, box_fee, notes, total

## File Manifest

```
plan_edit_invoice.md           → High-level plan
IMPLEMENTATION_SUMMARY.md      → Complete implementation details
TEST_EDIT_INVOICE.md          → 11 test scenarios with validation
app/Http/Controllers/InvoiceController.php  → update() method (120+ lines)
resources/views/invoice/edit.blade.php      → Form with item editing
routes/web.php                 → Already configured (no changes needed)
```

## Testing Commands

```bash
# Validate PHP syntax
php -l app/Http/Controllers/InvoiceController.php

# Check Laravel config
php artisan config:cache

# Run tests (if created)
php artisan test

# Check routes
php artisan route:list | grep invoice
```

## Common Tasks

### Add a validation rule

Edit `update()` method in InvoiceController, add to `$request->validate([...])`

### Change total calculation formula

Look for: `$total = $subtotal + $shipping + $box;` in `update()`

### Change price field behavior

Edit `resources/views/invoice/edit.blade.php` line with `name="items[...]price"`

### Add custom error message

Look for: `->withErrors(['items_invalid' => '...'])`

### Change redirect destination on success

Edit: `return redirect()->route('invoices.index')->with(...)`

## Performance Notes

-   Items are deleted and recreated (not individual updates)
-   Uses `with('latestPrice')` eager loading (no N+1)
-   Single database transaction per update
-   Suitable for invoices with 50+ items

## Security Considerations

-   Route uses `findOrFail()` - 404 if invoice doesn't exist
-   `exists:products,id` validation - only existing products allowed
-   Middleware `auth` on route - only authenticated users
-   No mass assignment vulnerabilities (uses explicit `$fillable`)
-   Cost price cannot be overridden (security: maintains audit trail)
