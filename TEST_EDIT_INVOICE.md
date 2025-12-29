# Test Cases for Edit Invoice Feature

## Implementation Summary

The edit invoice feature has been successfully implemented with the following components:

### 1. **Controller Changes** (`app/Http/Controllers/InvoiceController.php`)

-   **update() method**: Completely implemented with full validation and business logic
    -   Validates all input fields (invoice_date, customer_name, items, shipping, box_fee, notes)
    -   Fetches products with latest prices
    -   Validates that all products exist and have latest prices
    -   Calculates total (subtotal + shipping + box)
    -   Updates invoice fields (preserving nomor_nota)
    -   Deletes all old items and recreates them (allows add/remove/modify)
    -   Supports price overrides for items outside pricelist
    -   Returns success message on redirect

### 2. **View Changes** (`resources/views/invoice/edit.blade.php`)

-   Pre-populates form with existing invoice data:
    -   `invoice_date` - formatted as Y-m-d
    -   `customer_name` - existing customer name
    -   Shipping cost and box fee with existing values
    -   Notes with existing content
-   Items section:
    -   Loops through existing items with `@foreach ($invoice->items as $index => $item)`
    -   Each item shows correct product selection
    -   Quantity populated from database
    -   **Price field is EDITABLE** (removed readonly) - allows price overrides
    -   Cost price stored as hidden field
    -   Subtotal calculated and displayed
-   Dynamic item management:
    -   Can add new items with "+ Tambah Barang" button
    -   Can remove items with "Hapus" button
    -   Item numbering starts at `count($invoice->items)` to avoid conflicts
-   JavaScript improvements:
    -   `calculateSubtotal()` uses `.toFixed(2)` for proper decimal handling
    -   `removeRow()` handles both existing items (.p-4) and new items (.p-3)
    -   Subtotals calculated on page load via DOMContentLoaded event
    -   Price field accepts manual override via keyboard
    -   `step="0.01"` allows precise decimal entry
-   Error display:
    -   `<x-input-error>` components for validation feedback

### 3. **Routes** (Already configured in `routes/web.php`)

-   `Route::resource('invoices', InvoiceController::class)` creates automatic PUT route
-   Form action: `{{ route('invoices.update', $invoice->id) }}` with @method('PUT')

---

## Test Scenarios

### Scenario 1: Basic Update (No Changes)

**Steps:**

1. Navigate to edit page for existing invoice
2. Click "Simpan Nota" without making changes
3. **Expected:** Invoice updated successfully, redirects to index with "Nota berhasil diperbarui" message

**Validation Points:**

-   ✓ Data loads correctly
-   ✓ nomor_nota unchanged
-   ✓ All fields maintain current values

---

### Scenario 2: Update Customer Name and Date

**Steps:**

1. Edit existing invoice
2. Change customer name to "PT New Customer"
3. Change invoice date to tomorrow's date
4. Click "Simpan Nota"
5. **Expected:** Update successful, changes reflected in index view

**Validation Points:**

-   ✓ invoice_date validation (required, date format)
-   ✓ customer_name validation (required, string, max 255)
-   ✓ Changes persisted in database

---

### Scenario 3: Price Override (Key Feature)

**Steps:**

1. Edit existing invoice with item "Product A" at price 100,000
2. Change quantity to 5
3. Change price to 95,000 (override pricelist)
4. Subtotal should auto-calculate to 475,000
5. Click "Simpan Nota"
6. **Expected:** Price override saved to invoice_items table

**Validation Points:**

-   ✓ Price field is editable (not readonly)
-   ✓ Subtotal auto-updates when price changes
-   ✓ Override price (95,000) stored in DB, not pricelist price
-   ✓ cost_price still pulled from latest ProductPrice
-   ✓ price validation (numeric, min:0)

---

### Scenario 4: Add New Item

**Steps:**

1. Edit existing invoice
2. Click "+ Tambah Barang"
3. Select a product from dropdown
4. Price auto-fills from pricelist
5. Enter quantity 3
6. Subtotal auto-calculates
7. Add another item
8. Click "Simpan Nota"
9. **Expected:** Both new items saved, invoice total recalculated

**Validation Points:**

-   ✓ New items get unique index numbers
-   ✓ Product selection loads correct default price
-   ✓ Quantity validation (integer, min:1)
-   ✓ Items array validation (min:1)
-   ✓ Multiple items processed correctly

---

### Scenario 5: Remove Item

**Steps:**

1. Edit invoice with 3 items
2. Click "Hapus" on second item
3. Click "Simpan Nota"
4. **Expected:** Item removed, only 2 items remain, total recalculated

**Validation Points:**

-   ✓ Item deleted from invoice_items table
-   ✓ Total recalculation correct
-   ✓ Remaining items preserved

---

### Scenario 6: Modify Shipping and Box Fee

**Steps:**

1. Edit invoice
2. Change shipping_cost to 50,000
3. Change box_fee to 10,000
4. Keep items unchanged
5. Click "Simpan Nota"
6. **Expected:** Fees updated, total = subtotal + 50,000 + 10,000

**Validation Points:**

-   ✓ shipping_cost validation (nullable, numeric, min:0)
-   ✓ box_fee validation (nullable, numeric, min:0)
-   ✓ Total recalculation correct
-   ✓ Can set fees to 0

---

### Scenario 7: Validation Error - Invalid Product

**Steps:**

1. Edit invoice
2. Manually modify item's product_id to non-existent ID
3. Click "Simpan Nota"
4. **Expected:** Error message, form re-renders with input preserved

**Validation Points:**

-   ✓ items.\*.product_id validation (required, exists:products,id)
-   ✓ Error message displayed
-   ✓ Form retains user input via withInput()

---

### Scenario 8: Validation Error - Negative Price

**Steps:**

1. Edit invoice
2. Change price to -5000
3. Click "Simpan Nota"
4. **Expected:** Validation fails, error displayed

**Validation Points:**

-   ✓ items.\*.price validation (numeric, min:0)
-   ✓ Error message shown
-   ✓ Form not processed

---

### Scenario 9: Validation Error - No Items

**Steps:**

1. Edit invoice
2. Remove all items
3. Click "Simpan Nota"
4. **Expected:** Validation fails, "items" validation error

**Validation Points:**

-   ✓ items validation (required, array, min:1)
-   ✓ Error message displayed

---

### Scenario 10: Product with No Latest Price (Edge Case)

**Steps:**

1. Create a product without ProductPrice
2. Edit invoice and try to add that product
3. Click "Simpan Nota"
4. **Expected:** Error: "Harga terbaru tidak ditemukan untuk produk..."

**Validation Points:**

-   ✓ Business logic validation (checks latestPrice)
-   ✓ Custom error message shown
-   ✓ Form retains input

---

### Scenario 11: Complete Edit Workflow

**Steps:**

1. Edit invoice with 2 items @ 100,000 each
2. Remove first item
3. Modify second item: qty=5, price=85,000 (override)
4. Add new item: qty=2, price=200,000
5. Update shipping to 25,000
6. Add note: "Updated: Harga turun"
7. Click "Simpan Nota"
8. **Expected:** All changes saved correctly

**Calculation:**

-   Item 2: 5 × 85,000 = 425,000
-   Item 3: 2 × 200,000 = 400,000
-   Subtotal = 825,000
-   Total = 825,000 + 25,000 + 0 = 850,000

**Validation Points:**

-   ✓ Complex edit scenario works
-   ✓ Total calculation accurate
-   ✓ All validations passed
-   ✓ Database state consistent

---

## Integration Checks

### Database

-   ✓ `invoices` table: Fields update correctly (invoice_date, customer_name, shipping_cost, box_fee, notes, total)
-   ✓ `invoices.nomor_nota`: Does NOT change (immutable)
-   ✓ `invoice_items` table: Old items deleted, new items inserted
-   ✓ Cascade delete works (edit without errors)

### Routes

-   ✓ PUT route active: `/invoices/{id}` → `update()` method
-   ✓ Form action correct: `route('invoices.update', $invoice->id)`
-   ✓ Redirects to `/invoices` (index) on success

### Blade Components

-   ✓ `<x-input-label>` - displays field labels
-   ✓ `<x-text-input>` - renders input fields with values
-   ✓ `<x-input-error>` - shows validation errors
-   ✓ `<x-primary-button>` - submit button

### Relationships

-   ✓ `Invoice::items()` - hasMany relationship works for delete/create
-   ✓ `InvoiceItem::product()` - belongsTo relationship loads prices
-   ✓ `Product::latestPrice` - latestOfMany loads correct price

---

## Browser DevTools Checks

### JavaScript Console

-   No errors when loading edit page
-   No errors when adding items
-   Subtotal calculations accurate in real-time

### Network Tab

-   PUT request to `/invoices/{id}` with correct payload
-   Response 302 (redirect) on success
-   Response 422 on validation error

### Application Storage

-   Session shows success message after redirect

---

## Performance Notes

-   Item deletion/recreation approach (delete all, create new) is simple and safe
-   Alternative (track IDs for updates) not needed unless handling thousands of items
-   Validation upfront prevents database errors
-   No N+1 queries (uses `with('latestPrice')`)

---

## Summary

✅ Edit invoice feature fully implemented with:

-   Full form population from database
-   Editable price fields for overrides
-   Complete validation (8 validation rules)
-   Item management (add/remove/modify)
-   Total recalculation
-   Error handling with validation messages
-   Immutable nomor_nota

Ready for testing and production use.
