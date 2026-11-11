# WooCommerce Snippets

Copy-paste code snippets for WooCommerce stores — each file is standalone, documented at the top, and drops into your child theme's `functions.php` or a code-snippets plugin. No plugin to install, no settings page.

## Snippets

| File | What it does |
|---|---|
| [`snippets/01-rename-product-tabs.php`](snippets/01-rename-product-tabs.php) | Rename the product tabs (Description / Additional information / Reviews) and reorder them. |
| [`snippets/02-checkout-custom-field.php`](snippets/02-checkout-custom-field.php) | Add a "Delivery instructions" field to checkout, save it as order meta, show it in the admin order screen (HPOS-safe). |
| [`snippets/03-hide-prices-for-guests.php`](snippets/03-hide-prices-for-guests.php) | Hide prices and the add-to-cart button for logged-out visitors — "Login to see prices" instead. Good for wholesale / members-only stores. |
| [`snippets/04-change-add-to-cart-text.php`](snippets/04-change-add-to-cart-text.php) | Change the add-to-cart button text per product type (simple / variable / grouped / external), on archive pages and single products. |
| [`snippets/05-free-shipping-notice.php`](snippets/05-free-shipping-notice.php) | "Add $X more to unlock FREE shipping!" notice on the cart page — reads the threshold from your Free Shipping method, so it never goes stale. |
| [`snippets/06-related-products-count.php`](snippets/06-related-products-count.php) | Show 3 related products in 3 columns instead of 4 — with a one-line option to remove the section entirely. |

## Usage

1. Copy one snippet file's contents into your child theme's `functions.php` (or a code-snippets plugin).
2. Replace `'your-textdomain'` with your theme's text domain (or leave it — the strings still work, they just won't be translatable under your domain).
3. Adjust the labelled values at the top of each file to taste.

Snippets use anonymous functions (closures) — PHP 7.4+ and WordPress 5.0+ with WooCommerce active. Each file checks `ABSPATH` and does nothing when WooCommerce is not loaded (the hooks simply never fire).

## License

MIT — see [LICENSE](LICENSE).
