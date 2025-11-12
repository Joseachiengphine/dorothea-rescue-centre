#!/bin/bash

# Start ngrok for Laravel application
# This script starts ngrok and tunnels to your local Laravel server

echo "Starting ngrok tunnel for Laravel application..."
echo "Your Laravel app should be running on http://127.0.0.1:8000"
echo ""
echo "Press Ctrl+C to stop ngrok"
echo ""

# Start ngrok on port 8000 (default Laravel port)
ngrok http 8000

