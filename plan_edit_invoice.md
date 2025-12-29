**Implement Edit Invoice Feature with Price Overrides**

Implement an edit invoice feature in the Laravel nota system, allowing price overrides in invoice_items for adjustments outside the pricelist, with full validation before database saves. This builds on existing store logic, enabling updates to invoice details, items (add/remove), and manual price edits while preserving data integrity and recalculating totals.

Steps

1. Update edit.blade.php to pre-populate form with $invoice data, make price fields editable, and adapt JS for existing items.
2. Implement update method in InvoiceController.php with validations mirroring store, update invoice fields, delete/recreate items, and recalculate total.
3. Add business logic in update to fetch latest cost_price from ProductPrice, allow price overrides, and ensure nomor_nota immutability.
4. Test validations for edge cases like invalid products, negative prices, and empty items, using Laravel's built-in tools.
5. Update web.php if needed (routes already exist), and verify form action points correctly to invoices.update.

Further Considerations

1. Consider creating a custom UpdateInvoiceRequest class for reusable validations to avoid code duplication in store and update.
2. Handle item additions/removals by deleting all existing items and recreating from request—recommend Option A for simplicity, or Option B: track item IDs for updates/deletes if performance is a concern.
3. Ensure UI feedback for validation errors (e.g., via Laravel's error bags) and confirm no impact on existing reports or exports.
