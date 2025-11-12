# Ngrok Setup Guide for Dorothea Rescue Centre

## Quick Start

### Option 1: Using the Helper Script
```bash
./start-ngrok.sh
```

### Option 2: Manual Start
```bash
ngrok http 8000
```

## Prerequisites

1. **Laravel Server Running**: Make sure your Laravel application is running:
   ```bash
   php artisan serve
   ```
   Or if you want to run it in the background:
   ```bash
   php artisan serve &
   ```

2. **Ngrok Installed**: ✅ Already installed (version 3.30.0)
3. **Ngrok Configured**: ✅ Already configured

## Usage

### Basic Usage
1. Start your Laravel server (if not already running):
   ```bash
   php artisan serve
   ```

2. In a new terminal, start ngrok:
   ```bash
   ngrok http 8000
   ```
   Or use the helper script:
   ```bash
   ./start-ngrok.sh
   ```

3. Ngrok will display:
   - **Forwarding URL**: The public URL (e.g., `https://abc123.ngrok.io`)
   - **Web Interface**: Usually `http://127.0.0.1:4040` (for viewing requests)

### Accessing Your Application

Once ngrok is running, you'll see output like:
```
Forwarding   https://abc123.ngrok.io -> http://localhost:8000
```

You can now:
- Share the `https://abc123.ngrok.io` URL with others
- Access your Filament admin panel from anywhere
- Test webhooks or external integrations

### Web Interface

Ngrok provides a web interface at `http://127.0.0.1:4040` where you can:
- View all HTTP requests
- Inspect request/response details
- Replay requests
- See request statistics

## Important Notes

1. **Free Plan Limitations**:
   - URLs change each time you restart ngrok (unless you have a paid plan with static domains)
   - Connection timeout after inactivity
   - Limited bandwidth

2. **Security**:
   - Your local application will be publicly accessible
   - Make sure your application has proper authentication
   - Consider using ngrok's authentication features for additional security

3. **Laravel Configuration**:
   - If you need to allow the ngrok domain, you may need to update `config/app.php` or use:
   ```bash
   php artisan config:clear
   ```

## Stopping Ngrok

Press `Ctrl+C` in the terminal where ngrok is running.

## Troubleshooting

### Port Already in Use
If port 8000 is already in use, you can:
- Use a different port: `php artisan serve --port=8001`
- Then tunnel that port: `ngrok http 8001`

### Connection Refused
Make sure your Laravel server is running before starting ngrok.

### Need a Static Domain
For a static domain (paid feature), you can configure it in your ngrok dashboard and use:
```bash
ngrok http 8000 --domain=your-static-domain.ngrok.io
```

