# Render Environment Variables Setup Guide

## Overview

This guide contains all environment variables needed for the Ctrl+P Laravel application to work on Render.com.

**Architecture:**
- **Database:** Neon PostgreSQL (IPv4 compatible)
- **Image Storage:** Supabase Storage (S3-compatible, HTTPS)
- **Hosting:** Render.com (Docker)

---

## Step 1: Create Neon PostgreSQL Database

1. Go to [neon.tech](https://neon.tech) and sign up (free tier available)
2. Create a new project:
   - **Project name:** `ctrl-p`
   - **Region:** `US East (Ohio)` or closest to your Render region
   - **PostgreSQL version:** 16 (latest)
3. Copy the connection details from the dashboard

---

## Step 2: Export Data from Supabase (if you have existing data)

### Option A: Using Supabase Dashboard
1. Go to Supabase Dashboard → SQL Editor
2. Run this query to export each table:
```sql
-- Export users
SELECT * FROM users;

-- Export products  
SELECT * FROM products;

-- Export product_variants
SELECT * FROM product_variants;

-- Export orders
SELECT * FROM orders;

-- Export order_items
SELECT * FROM order_items;

-- Export announcements
SELECT * FROM announcements;
```
3. Copy results and save as SQL INSERT statements

### Option B: Using pg_dump (if you have psql installed)
```bash
# Remove credential examples before running or replace with placeholder values
pg_dump "postgresql://postgres:YOUR_DATABASE_PASSWORD@db.YOUR_PROJECT_REF.supabase.co:5432/postgres" > supabase_backup.sql
```

---

## Step 3: Import Data to Neon

1. Go to Neon Dashboard → SQL Editor
2. First, run Laravel migrations (or paste the SQL backup)
3. Import your data INSERT statements

---

## Step 4: Render Environment Variables

Copy these variables to your Render Dashboard → Environment section.

### 🔴 REQUIRED - Application Core

| Variable | Value | Description |
|----------|-------|-------------|
| `APP_NAME` | `Ctrl+P` | Application name |
| `APP_ENV` | `production` | Environment |
| `APP_KEY` | `base64:YOUR_APP_KEY` | Laravel encryption key |
| `APP_DEBUG` | `false` | Disable debug in production |
| `APP_URL` | `https://ctrl-p.onrender.com` | Your Render URL |

### 🔴 REQUIRED - Neon Database (REPLACE WITH YOUR NEON CREDENTIALS)

| Variable | Value | Description |
|----------|-------|-------------|
| `DB_CONNECTION` | `pgsql` | PostgreSQL driver |
| `DB_HOST` | `ep-XXXXX-XXXXX.us-east-2.aws.neon.tech` | **Your Neon host** |
| `DB_PORT` | `5432` | PostgreSQL port |
| `DB_DATABASE` | `neondb` | **Your Neon database name** |
| `DB_USERNAME` | `neondb_owner` | **Your Neon username** |
| `DB_PASSWORD` | `your-neon-password` | **Your Neon password** |
| `DB_SSLMODE` | `require` | Required for Neon |

### 🔴 REQUIRED - Supabase Storage (Keep these unchanged)

| Variable | Value | Description |
|----------|-------|-------------|
| `FILESYSTEM_DISK` | `supabase` | Use Supabase for file storage |
| `AWS_ACCESS_KEY_ID` | `YOUR_SUPABASE_PROJECT_REF` | Supabase project ref |
| `AWS_SECRET_ACCESS_KEY` | `YOUR_SUPABASE_SERVICE_ROLE_KEY` | Supabase service role key |
| `AWS_DEFAULT_REGION` | `ap-southeast-1` | Supabase region |
| `AWS_BUCKET` | `products` | Storage bucket name |
| `AWS_ENDPOINT` | `https://YOUR_SUPABASE_PROJECT_REF.supabase.co/storage/v1/s3` | Supabase S3 endpoint |
| `AWS_URL` | `https://YOUR_SUPABASE_PROJECT_REF.supabase.co/storage/v1/object/public/products` | Public URL for images |
| `AWS_USE_PATH_STYLE_ENDPOINT` | `true` | Required for Supabase S3 |

### 🔴 REQUIRED - Neon Endpoint (For SNI Routing)

| Variable | Value | Description |
|----------|-------|--------------|
| `DB_NEON_ENDPOINT` | `ep-XXXXX-XXXXX-pooler` | **Your Neon endpoint ID** (extract from host) |

> **How to find your endpoint ID:** Look at your `DB_HOST` value. The endpoint is everything before `.aws.neon.tech`. For example, if your host is `ep-noisy-mud-a1r3q36o-pooler.ap-southeast-1.aws.neon.tech`, your endpoint is `ep-noisy-mud-a1r3q36o-pooler`.

### 🔴 REQUIRED - Session & Cache

| Variable | Value | Description |
|----------|-------|--------------|
| `SESSION_DRIVER` | `cookie` | Cookie-based sessions (most reliable) |
| `SESSION_LIFETIME` | `1440` | Session lifetime in minutes (24h) |
| `SESSION_SECURE_COOKIE` | `true` | HTTPS only cookies |
| `CACHE_STORE` | `file` | File-based cache (avoids DB transactions) |
| `QUEUE_CONNECTION` | `sync` | Synchronous queue (simpler) |

### 🟡 OPTIONAL - Additional Settings

| Variable | Value | Description |
|----------|-------|-------------|
| `BCRYPT_ROUNDS` | `12` | Password hashing rounds |
| `LOG_CHANNEL` | `stack` | Logging channel |
| `LOG_LEVEL` | `warning` | Only log warnings and errors |
| `MAIL_MAILER` | `log` | Log emails (no actual sending) |
| `GEMINI_API_KEY` | `YOUR_GEMINI_API_KEY` | Gemini AI API key |
| `GEMINI_MODEL` | `gemini-2.0-flash` | Gemini model to use |

---

## Complete Environment Variables (Copy-Paste Ready)

```env
# =============================================================================
# APPLICATION
# =============================================================================
APP_NAME=Ctrl+P
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY
APP_DEBUG=false
APP_URL=https://ctrl-p.onrender.com
APP_LOCALE=en
APP_FALLBACK_LOCALE=en

# =============================================================================
# DATABASE - NEON POSTGRESQL (Replace with your credentials!)
# =============================================================================
DB_CONNECTION=pgsql
DB_HOST=ep-XXXXX-XXXXX.us-east-2.aws.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=YOUR_NEON_PASSWORD_HERE
DB_SSLMODE=require

# =============================================================================
# SUPABASE STORAGE (For image uploads - keep these!)
# =============================================================================
FILESYSTEM_DISK=supabase
AWS_ACCESS_KEY_ID=YOUR_SUPABASE_PROJECT_REF
AWS_SECRET_ACCESS_KEY=YOUR_SUPABASE_SERVICE_ROLE_KEY
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=products
AWS_ENDPOINT=https://YOUR_SUPABASE_PROJECT_REF.supabase.co/storage/v1/s3
AWS_URL=https://YOUR_SUPABASE_PROJECT_REF.supabase.co/storage/v1/object/public/products
AWS_USE_PATH_STYLE_ENDPOINT=true

# =============================================================================
# NEON ENDPOINT (REQUIRED for SNI routing - extract from DB_HOST)
# Example: If DB_HOST=ep-noisy-mud-a1r3q36o-pooler.ap-southeast-1.aws.neon.tech
#          Then DB_NEON_ENDPOINT=ep-noisy-mud-a1r3q36o-pooler
# =============================================================================
DB_NEON_ENDPOINT=ep-XXXXX-XXXXX-pooler

# =============================================================================
# SESSION, CACHE & QUEUE
# Using cookie/file to avoid DB transaction issues during high load
# =============================================================================
SESSION_DRIVER=cookie
SESSION_LIFETIME=1440
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
CACHE_STORE=file
QUEUE_CONNECTION=sync
BROADCAST_CONNECTION=log

# =============================================================================
# SECURITY
# =============================================================================
BCRYPT_ROUNDS=12

# =============================================================================
# LOGGING
# =============================================================================
LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=warning

# =============================================================================
# MAIL (Log only - no actual emails)
# =============================================================================
MAIL_MAILER=log
MAIL_FROM_ADDRESS=hello@ctrlp.com
MAIL_FROM_NAME=Ctrl+P

# =============================================================================
# EXTERNAL APIs
# =============================================================================
GEMINI_API_KEY=YOUR_GEMINI_API_KEY
GEMINI_MODEL=gemini-2.0-flash

# =============================================================================
# FRONTEND
# =============================================================================
VITE_APP_NAME=Ctrl+P
```

---

## Step 5: After Setting Environment Variables

1. **Trigger a new deploy** on Render (Manual Deploy → Deploy latest commit)
2. **Wait for build to complete** (~3-5 minutes)
3. **Run migrations** - The docker-entrypoint.sh will automatically run:
   ```bash
   php artisan migrate --force
   ```
4. **Test all pages:**
   - ✅ Homepage: `https://ctrl-p.onrender.com/`
   - ✅ Shop: `https://ctrl-p.onrender.com/shop`
   - ✅ Login: `https://ctrl-p.onrender.com/login`
   - ✅ Register: `https://ctrl-p.onrender.com/register`
   - ✅ Admin: `https://ctrl-p.onrender.com/admin/dashboard`

---

## Troubleshooting

### Issue: 503 Service Unavailable
- Check Neon database credentials are correct
- Verify DB_SSLMODE=require is set
- Check Render logs for connection errors

### Issue: Images not uploading
- Verify AWS_SECRET_ACCESS_KEY is the Supabase service role key
- Check Supabase Storage bucket permissions

### Issue: Login not working
- Verify SESSION_DRIVER=database
- Check that the `sessions` table exists in Neon
- Run `php artisan migrate --force` if needed

---

## Architecture Diagram

```
┌─────────────────────────────────────────────────────────────────────┐
│                         RENDER.COM                                  │
│                    (Docker Container)                               │
│                                                                     │
│  ┌─────────────────────────────────────────────────────────────┐   │
│  │                    LARAVEL APPLICATION                       │   │
│  │                                                              │   │
│  │  • Homepage, Shop, Product Pages                             │   │
│  │  • Login, Register, Cart, Checkout                           │   │
│  │  • Admin Dashboard, Product Management                       │   │
│  │  • Gemini AI Chat                                            │   │
│  └─────────────────────────────────────────────────────────────┘   │
│                          │                    │                     │
│              Database    │                    │   Image Storage     │
│              Connection  │                    │   (HTTPS)           │
└──────────────────────────┼────────────────────┼─────────────────────┘
                           │                    │
                           ▼                    ▼
              ┌─────────────────────┐  ┌─────────────────────┐
              │   NEON POSTGRESQL   │  │  SUPABASE STORAGE   │
              │                     │  │                     │
              │  • Users            │  │  • Product images   │
              │  • Products         │  │  • User uploads     │
              │  • Orders           │  │                     │
              │  • Sessions         │  │  Bucket: products   │
              │  • Cache            │  │                     │
              │                     │  │  Access: Public     │
              │  IPv4 ✅            │  │  HTTPS ✅           │
              └─────────────────────┘  └─────────────────────┘
```

---

## Summary

| Service | Purpose | Cost |
|---------|---------|------|
| **Render** | Hosting (Docker) | Free tier available |
| **Neon** | PostgreSQL Database | Free tier (0.5GB) |
| **Supabase** | Image Storage | Free tier (1GB) |
| **Gemini** | AI Chat | Free tier available |

**Total Cost: $0/month** (within free tier limits)
