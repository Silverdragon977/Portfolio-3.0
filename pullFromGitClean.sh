#!/bin/bash

echo "🔄 Fetching latest changes..."
git fetch origin || { echo "❌ Git fetch failed"; exit 1; }

echo "🔁 Resetting to origin/main..."
git reset --hard origin/main || { echo "❌ Git reset failed"; exit 1; }

echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction || exit 1

echo "📦 Installing NPM dependencies..."
npm ci || exit 1

echo "⚙ Building frontend assets..."
npm run build || exit 1

echo "🧱 Running migrations..."
php artisan migrate --force || exit 1

echo "🧹 Clearing caches..."
php artisan optimize:clear || exit 1

echo "🚀 Rebuilding caches..."
php artisan config:cache || exit 1
php artisan view:cache || exit 1

echo "♻️ Restarting queues..."
php artisan queue:restart || true

echo "♻️ Reloading PHP..."
sudo systemctl reload apache2 || true

echo "✅ Deployment complete!"
