#!/usr/bin/env bash

set -Eeuo pipefail

PROJECT_DIR="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)"
cd "$PROJECT_DIR"

echo "[deploy] Building manic-home..."
npm run build

echo "[deploy] Reloading manic-home with PM2..."
pm2 startOrReload ecosystem.config.cjs --env production

echo "[deploy] Saving PM2 process list..."
pm2 save

echo "[deploy] Done."
