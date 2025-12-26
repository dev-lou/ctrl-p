## Technology Stack Overview

- **Frontend:** Blade templates with Vite 7 build; Tailwind CSS 4 (via `@tailwindcss/vite`); Axios 1.11 for AJAX; no heavy framework (plain JS); compiled assets in `public/build`; optional Supabase-hosted media rendered via URLs; Laravel Breeze-auth views.  
- **Backend:** PHP 8.2, Laravel 11; Breeze auth scaffolding; Eloquent ORM with custom `NeonPostgresConnector` for PostgreSQL (Neon) and SQLite for local; DomPDF (`barryvdh/laravel-dompdf`) for receipts; Spatie Activity Log for auditing; Flysystem AWS S3 v3 for Supabase storage; queue/listeners via Laravel defaults; GeminiChatService for LLM chat.  
- **Database:** Primary via Eloquent (PostgreSQL target); migrations define products, variants, orders, order_items, reviews, notifications, buy_list_items, inventory_histories, audit_logs, announcements, settings, sessions, users, cache. Fallback read paths to Supabase REST for products when DB unavailable.  
- **Libraries & Services:** Google Gemini API (chat/diagnostics); Supabase Storage (S3-compatible) for product images and receipts; DomPDF for PDF receipts; Laravel Cache for homepage data; Health checks `/healthz`; Artisan commands `PrimeCache`, `TestInventorySystem`.  
- **DevOps:** Dockerfile bases on `php:8.2-apache` with Node 20, opcache, gd, mbstring, pgsql extensions; Vite build in container; Render deployment scripts; npm `fix_manifest.js` post-build.

## System Workflows (Business Logic)

- **Authentication (Breeze + custom routes):** Guest visits `/login` or `/register` -> credentials validated -> `Auth::attempt` on login regenerates session; role check redirects admins to `/admin/dashboard`, customers to `/`; logout via POST `/logout` clears session.  
- **Homepage & Catalog Browse:** `/` and `/home` controllers fetch featured products (cached; Supabase REST fallback) -> render `home.*` views; `/shop` lists active products with pagination; fallback to Supabase REST if DB unavailable.  
- **Product Detail & Reviews:** `/shop/{product}` loads product, variants, reviews, average ratings, related products; checks prior completed orders to allow reviewing; rating breakdown computed; review CRUD guarded to owner with verified purchase check.  
- **Cart:** Authenticated users add/update/remove items stored in session (`CartController@store/update/destroy/clear`); cart page rebuilds items with current prices/variants to compute totals.  
- **Checkout & Order Placement:** `/checkout` shows summary from session cart; POST `/checkout` validates cart (optionally accepts JSON `cart_payload`), re-fetches products/variants, checks stock, calculates totals, writes `orders` and `order_items` rows (direct DB insert), clears cart, redirects to `orders.show`.  
- **Customer Orders:** `/orders/{order}` owner-only view with items; cancel allowed while `pending`; delete removes order; `/account/orders` lists paginated history; receipt PDF via `orders/{order}/pdf` (Blade + DomPDF).  
- **Notifications:** Authenticated endpoints list/paginate notifications, fetch unread (AJAX), mark single/all as read, delete; JSON responses supply counts and links to orders.  
- **Customer Dashboard:** `/account/dashboard` aggregates recent orders, counts (total/pending/completed), total spent, recent notifications, unread count.  
- **Reviews:** POST `/products/{product}/reviews` creates verified_purchase flag if user completed order containing product; update/delete guarded to owner.  
- **Chatbot:** POST `/chatbot/message` -> GeminiChatService->chat -> attaches quick links based on intent; GET `/chatbot/quick-actions` returns prebuilt actions.  
- **Admin Dashboard:** `/admin/dashboard` (auth+admin middleware) shows revenue, orders, low-stock counts, inventory stats, top products, recent orders, customer insights (new/active customers), revenue chart last 7 days.  
- **Admin Inventory (Products & Variants):** CRUD via `InventoryProductController`; supports search/filter/sort, Supabase image upload with local fallback, variant management, low-stock thresholds, cache invalidation.  
- **Admin Stock Movements:** Stock-in/out endpoints adjust variant quantities in transaction, log to `inventory_histories`, update caches; history view paginates with product/user context.  
- **Admin Orders:** Filter/search orders by status/date; view details; update status (sets `completed_at`), assign staff, delete, download customer files from `storage/app/orders/{order}`.  
- **Admin Buy List:** CRUD for to-buy items with priority and custom fields; AJAX responses return JSON payloads; mark purchased and receipt upload routes available.  
- **Admin Analytics:** JSON endpoints provide revenue, category/status breakdowns, top customers, KPIs, daily orders, peak hours, weekly comparisons, payment mix (mock default), inventory performance, monthly revenue.  
- **Admin Users & Settings:** Manage users (search/filter roles), create/update/delete with hashed passwords and roles JSON; audit logs written on changes; settings allow updating `APP_NAME` in `.env`; profile picture upload stored in `storage/app/public`.  
- **Audit Logs:** `audit-logs` list and show entries with filters by action/model/user.  
- **Health & Diagnostics:** `/healthz` pings DB else attempts Supabase fallback; optional `/ _health` for local debug; `/admin/gemini/diagnose` and `/ _debug/gemini` (token-protected) inspect Gemini API.

## Code Reference (Root PHP Files)

Project root contains no standalone `.php` files; the primary entry points adjacent to root are listed for clarity:

- **`public/index.php`** — Laravel front controller bootstrapping the framework and handling all HTTP requests.  
  - *Functions/Logic:* requires Composer autoload, boots application via `bootstrap/app.php`, handles HTTP kernel.  
  - *SQL Interactions:* None directly (delegated to routed controllers).  
- **`artisan`** — CLI entry for Artisan commands.  
  - *Functions/Logic:* boots Laravel console kernel; enables running migrations, queues, custom commands (`PrimeCache`, `TestInventorySystem`).  
  - *SQL Interactions:* None directly; commands may interact via Eloquent/DB.  
- **`routes/web.php`** — Defines all web routes (customer, admin, auth, chatbot, health).  
  - *Functions/Logic:* route closures for health/debug and Breeze-style auth handlers; binds controllers listed in System Workflows.  
  - *SQL Interactions:* Health checks use `DB::select('SELECT 1')`; auth/register uses `users` table; various controllers use products/orders/etc.  
- **`routes/api.php` / `routes/console.php`** — API placeholder (minimal) and console routes for scheduled commands.  
  - *SQL Interactions:* None by default.  
- **`bootstrap/app.php`** — Boots the Laravel application with HTTP, console, and exception kernels wired.  
  - *SQL Interactions:* None.  
- **`config/*.php`** — Configuration for database (PostgreSQL default, SQLite dev), cache/session, filesystems (Supabase S3), mail, queue, view, services (Gemini/Supabase).  
  - *SQL Interactions:* None.

> Note: Business logic and SQL access live in controllers, models, services, and migrations summarized in System Workflows. Primary tables touched per module include `products`, `product_variants`, `orders`, `order_items`, `notifications`, `reviews`, `inventory_histories`, `buy_list_items`, `audit_logs`, and `users`.

