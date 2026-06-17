#!/usr/bin/env bash
#
# Start the IUVENTA site using PHP's built-in web server.
# The router serves WordPress core / static assets and routes the rest to WP.
#
#   Usage: bin/serve.sh [host:port]   (default 0.0.0.0:8080)

set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
ADDR="${1:-0.0.0.0:8080}"

if [ ! -f "$ROOT/wp/wp-load.php" ]; then
	echo "WordPress core not found. Run bin/setup.sh first." >&2
	exit 1
fi

echo "Serving IUVENTA on http://$ADDR  (Ctrl+C to stop)"
exec php -S "$ADDR" -t "$ROOT" "$ROOT/router.php"
