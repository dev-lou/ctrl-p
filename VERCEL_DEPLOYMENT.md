# 🚀 Vercel + Neon Deployment Guide

## ✅ Step 1: Set Up Vercel Environment Variables

### **Option A: Using Vercel Dashboard (Easiest)**

1. Go to [vercel.com/dashboard](https://vercel.com/dashboard)
2. Select your **ctrl-p** project
3. Navigate to **Settings** → **Environment Variables**
4. Add the following variables for **Production**:

```env
APP_NAME=Ctrl+P
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:uJZPhoPFaV5SknwBe9ww5IcGrzQl0BBcBaO5TrrDNB4=

DATABASE_URL=postgresql://neondb_owner:npg_uvVhqtA9TcO1@ep-snowy-night-a14h65st.ap-southeast-1.aws.neon.tech/neondb?sslmode=require&options=endpoint%3Dep-snowy-night-a14h65st

SESSION_DRIVER=cookie
CACHE_STORE=array
QUEUE_CONNECTION=sync

GEMINI_API_KEY=AIzaSyBcouFU0SiONOEKb5fA3Z-lg-cf_dCv7Zg
GEMINI_MODEL=gemini-2.0-flash

LOG_CHANNEL=stderr
LOG_LEVEL=error
```

5. Click **Save** for each variable

---

### **Option B: Using Vercel CLI (Faster)**

```powershell
# Add DATABASE_URL
vercel env add DATABASE_URL production
# Paste: postgresql://neondb_owner:npg_uvVhqtA9TcO1@ep-snowy-night-a14h65st.ap-southeast-1.aws.neon.tech/neondb?sslmode=require&options=endpoint%3Dep-snowy-night-a14h65st

# Add APP_KEY
vercel env add APP_KEY production
# Paste: base64:uJZPhoPFaV5SknwBe9ww5IcGrzQl0BBcBaO5TrrDNB4=

# Add GEMINI_API_KEY
vercel env add GEMINI_API_KEY production
# Paste: AIzaSyBcouFU0SiONOEKb5fA3Z-lg-cf_dCv7Zg

# Add other required variables
vercel env add APP_ENV production
# Enter: production

vercel env add APP_DEBUG production
# Enter: false

vercel env add SESSION_DRIVER production
# Enter: cookie

vercel env add CACHE_STORE production
# Enter: array
```

---

## ✅ Step 2: Export Your MySQL Data

Since you're moving from MySQL (local) to PostgreSQL (Neon), export your existing data:

### **Export from phpMyAdmin**

```powershell
# Open PowerShell and run:
mysqldump -u root -p laravel_igp > database_export.sql
```

---

## ✅ Step 3: Run Migrations on Neon

Since Neon is PostgreSQL and you have MySQL locally, run migrations on production after deployment:

```powershell
# Deploy to Vercel
vercel --prod

# After deployment succeeds, run migrations on Neon
vercel exec -- php artisan migrate --force

# (Optional) Seed demo data
vercel exec -- php artisan db:seed --force
```

---

## ✅ Step 4: Import Data to Neon (Optional)

If you have production data to migrate:

### **Method 1: Use pgLoader (MySQL → PostgreSQL)**

1. Download [pgLoader](https://github.com/dimitri/pgloader/releases)
2. Create a migration script:

```sql
-- migration.load
LOAD DATABASE
     FROM mysql://root@localhost/laravel_igp
     INTO postgresql://neondb_owner:npg_uvVhqtA9TcO1@ep-snowy-night-a14h65st.ap-southeast-1.aws.neon.tech/neondb?sslmode=require

WITH include drop, create tables, create indexes, reset sequences

SET PostgreSQL PARAMETERS
    maintenance_work_mem to '128MB',
    work_mem to '12MB'

CAST type datetime to timestamptz drop default drop not null using zero-dates-to-null,
     type date drop not null drop default using zero-dates-to-null

ALTER SCHEMA 'laravel_igp' RENAME TO 'public';
```

3. Run migration:
```powershell
pgloader migration.load
```

### **Method 2: Manual Data Export/Import**

**Export specific tables:**
```sql
-- In phpMyAdmin, for each table:
SELECT * FROM users INTO OUTFILE 'C:/xampp/tmp/users.csv'
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\n';
```

**Import to Neon using DBeaver:**
1. Download [DBeaver](https://dbeaver.io/download/)
2. Connect to Neon using your connection string
3. Right-click table → **Import Data** → Select CSV
4. Map columns and import

---

## ✅ Step 5: Deploy to Vercel

```powershell
# Commit your changes
git add .
git commit -m "Configure for Vercel + Neon deployment"
git push origin main

# Deploy to production
vercel --prod

# Monitor deployment logs
vercel logs --follow
```

---

## ✅ Step 6: Verify Deployment

After deployment:

1. **Check Deployment URL**
   - Visit your Vercel deployment URL
   - Test homepage loads correctly

2. **Test Database Connection**
   ```powershell
   # SSH into Vercel and test connection
   vercel exec -- php artisan tinker --execute="DB::connection()->getPdo();"
   ```

3. **Run Migrations**
   ```powershell
   vercel exec -- php artisan migrate:status
   ```

4. **Test Application Features**
   - ✅ Login/Register
   - ✅ Browse products
   - ✅ Add to cart
   - ✅ Checkout process
   - ✅ Admin dashboard
   - ✅ Chatbot functionality

---

## ✅ Step 7: Monitor & Troubleshoot

### **View Logs**
```powershell
# Real-time logs
vercel logs --follow

# Last 100 logs
vercel logs
```

### **Common Issues**

**Error: "SQLSTATE[08006] Connection refused"**
```powershell
# Verify DATABASE_URL is set correctly
vercel env ls

# Check if it includes the endpoint parameter
# Should have: ?options=endpoint%3Dep-snowy-night-a14h65st
```

**Error: "Table 'users' doesn't exist"**
```powershell
# Run migrations on production
vercel exec -- php artisan migrate:fresh --force
vercel exec -- php artisan db:seed --force
```

**Error: "APP_KEY not set"**
```powershell
# Generate new production key
php artisan key:generate --show

# Add to Vercel
vercel env add APP_KEY production
# Paste the generated key
```

---

## 📊 Development vs Production Setup

| Feature | Local (Dev) | Vercel (Production) |
|---------|-------------|---------------------|
| **Database** | MySQL 8.0 (XAMPP) | PostgreSQL 16 (Neon) |
| **Connection** | `DB_HOST=127.0.0.1` | `DATABASE_URL=postgresql://...` |
| **Session** | `database` | `cookie` |
| **Cache** | `database` | `array` |
| **Queue** | `database` | `sync` |
| **Debug** | `true` | `false` |
| **Log Channel** | `stack` | `stderr` |

---

## 🎯 Quick Deployment Checklist

- [x] Neon project created
- [x] DATABASE_URL copied from Neon
- [x] Vercel environment variables configured
- [ ] MySQL data exported (if needed)
- [ ] Deploy to Vercel: `vercel --prod`
- [ ] Run migrations: `vercel exec -- php artisan migrate --force`
- [ ] Test application on Vercel URL
- [ ] Import production data (if needed)
- [ ] Monitor logs for errors

---

## 🚀 Deploy Now!

```powershell
# Final deployment command
vercel --prod
```

**Your app will be live at:** `https://ctrl-p-[hash].vercel.app`

---

## 📞 Need Help?

- **Vercel Docs:** https://vercel.com/docs
- **Neon Docs:** https://neon.tech/docs
- **Laravel Deployment:** https://laravel.com/docs/deployment

✅ **You're all set for production deployment!**
