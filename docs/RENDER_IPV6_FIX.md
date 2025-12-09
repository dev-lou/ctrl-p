# Fix: Render cannot reach IPv6-only DB hosts (Supabase IPv6-only endpoint)

Problem
-------

Supabase database hosts sometimes only expose an IPv6 address (AAAA) and no IPv4 address (A). Many cloud runtimes (like Render.com) operate with IPv4-only egress, meaning they cannot reach IPv6-only database endpoints. When this occurs, the Laravel app will show errors like:

```
SQLSTATE[08006] [7] connection to server at "db.YOUR_PROJECT_REF.supabase.co" (...) port 5432 failed: Network is unreachable
```

Short-term options
-----------------

A) Configure an IPv4 proxy

- Create a small VM (DigitalOcean, AWS, Linode, etc.) with public IPv4 address.
- Install `socat` and forward IPv4 port to the Supabase IPv6 host:

```sh
# install socat
sudo apt update && sudo apt install -y socat

# forward local IPv4 port 5432 to Supabase IPv6 host
sudo socat TCP-LISTEN:5432,reuseaddr,fork TCP6:db.YOUR_PROJECT_REF.supabase.co:5432
```

- Harden the server firewall and only allow requests from your Render service IPs.
- On Render, set `DB_HOST` (or `DB_HOST_IPV4`) to the proxy IPv4 address and keep `DB_PORT=5432` and `DB_SSLMODE=require`.

Pros: Quick; you keep using Supabase.
Cons: You need to manage the proxy & firewall; single point of failure.

B) Ask Supabase for IPv4 endpoint / A record

- Contact Supabase support and request a public IPv4 accessible endpoint.
- If they provide one, update `DB_HOST` in Render environment and redeploy.

Pros: Cleaner & supported.
Cons: Might not always be available or quick.

C) Move to an IPv4-enabled DB provider

- Use another DB hosting provider that provides IPv4 A record, then update `DB_HOST` and reconfigure credentials.

Pros: Long term and stable.
Cons: More work to migrate the DB.

Code-side protections (already implemented)
-------------------------------------------

- The app will attempt to resolve the DB hostname to IPv4 (when possible) and reconfigure the runtime connection.
- If DB remains unreachable, the app falls back to file sessions / cache to avoid a total site crash.
- We also added a `healthz` endpoint to let Render (or other platforms) get consistent health checks.

How to configure Render
-----------------------

1. If you set up the IPv4 proxy, set these Render environment variables:

- `DB_HOST` = IPv4 proxy IP (or `DB_HOST_IPV4` if you prefer not to overwrite DB_HOST)
- `DB_PORT` = 5432
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` as usual
- `DB_SSLMODE` = require

2. Redeploy your service and confirm the `healthz` endpoint returns HTTP 200.

Troubleshooting checklist
------------------------

- Ensure your Render instance can resolve the configured `DB_HOST`.
- If using proxy, ensure the proxy server accepts connections from Render's network.
- Verify firewall settings allow ingress only from Render.
- Confirm `DB_HOST_IPV4` value is set in Render dashboard if used.

Notes
-----

- We updated the app to allow `DB_HOST_IPV4` as an override; setting this env var is effective immediately after redeploy.
- The best long-term solution is to get the database host to expose an IPv4 address (A record) or move to a provider with IPv4 support.
 
D) Use Supabase REST API fallback (server-side)
--------------------------------------------

If you cannot expose an IPv4 address for the PostgreSQL endpoint, you can still read data via Supabase's REST API using a server-side key. This repository includes a `SupabaseFallback` service that will fetch `products` and `announcements` via the Supabase REST API when Postgres isn't reachable. To enable this fallback:

1. Add the `SUPABASE_SERVICE_ROLE_KEY` (Supabase service role key) to your Render environment variables.
2. Optionally set `SUPABASE_ANON_KEY` for client-side usage.
3. Redeploy your app.

The fallback is limited to read-only operations and is intended to show cached/archive content when Postgres is unreachable.

If you'd like, I can help with:
- Creating a hardened socat or stunnel proxy (with systemd service and firewall rules) and a small script to monitor/auto-restart.
- Or provisioning a small DigitalOcean droplet (or other provider) and a step-by-step guide to bind the proxy.
- Or migrating to a different DB host/provider.
