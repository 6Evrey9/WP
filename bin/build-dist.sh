#!/usr/bin/env bash
#
# Build a complete, hosting-ready WordPress site from this repository.
#
# The repo intentionally version-controls only the custom theme + dev scripts
# (WordPress core, wp-config and the database are generated locally and are
# git-ignored). This script assembles a STANDARD WordPress installation that
# you can upload to any normal PHP/MySQL hosting:
#
#   dist/iuventa-site/        — full WordPress (core at root + theme), MySQL config
#   dist/iuventa-site.zip     — the same, zipped for upload
#   dist/iuventa-content.xml  — content export (WXR) for optional import
#
# Note: local development uses SQLite; the built package is configured for
# MySQL, which is what shared/managed hosting expects.
#
# Run bin/setup.sh first (so ./wp exists). Then: bin/build-dist.sh

set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
WP_DIR="$ROOT/wp"
DIST="$ROOT/dist"
PKG="$DIST/iuventa-site"
WP_BIN="${WP_BIN:-wp}"

if [ ! -f "$WP_DIR/wp-load.php" ]; then
	echo "ERROR: WordPress core not found in ./wp. Run bin/setup.sh first." >&2
	exit 1
fi

echo "==> Cleaning $PKG"
rm -rf "$PKG" "$DIST/iuventa-site.zip" "$DIST/iuventa-content.xml"
mkdir -p "$PKG"

echo "==> Copying WordPress core (standard layout)..."
cp -a "$WP_DIR/." "$PKG/"

echo "==> Removing development-only files (SQLite, dev config, caches)..."
rm -f  "$PKG/wp-config.php"
rm -f  "$PKG/wp-content/db.php"
rm -rf "$PKG/wp-content/database"
rm -f  "$PKG/wp-content/debug.log"
rm -rf "$PKG/wp-content/upgrade" "$PKG/wp-content/cache"
rm -rf "$PKG/wp-content/plugins/sqlite-database-integration"

echo "==> Adding the IUVENTA theme..."
mkdir -p "$PKG/wp-content/themes"
rm -rf "$PKG/wp-content/themes/iuventa"
cp -a "$ROOT/wp-content/themes/iuventa" "$PKG/wp-content/themes/iuventa"

echo "==> Generating production wp-config.php (MySQL)..."
if ! $WP_BIN config create \
		--path="$PKG" \
		--dbname="iuventa_db" \
		--dbuser="iuventa_user" \
		--dbpass="ЗАМЕНИТЕ_ПАРОЛЬ" \
		--dbhost="localhost" \
		--dbcharset="utf8mb4" \
		--locale="ru_RU" \
		--skip-check \
		--force \
		--extra-php <<'PHP'
define( 'WP_DEBUG', false );
define( 'FS_METHOD', 'direct' );
PHP
then
	echo "   wp-cli config create failed; falling back to wp-config-sample.php"
	cp "$PKG/wp-config-sample.php" "$PKG/wp-config.php"
fi

echo "==> Exporting content (WXR) for optional import..."
TMP_EXPORT="$(mktemp -d)"
if $WP_BIN export --dir="$TMP_EXPORT" --path="$WP_DIR" --allow-root >/dev/null 2>&1; then
	XML="$(find "$TMP_EXPORT" -name '*.xml' | head -1)"
	[ -n "$XML" ] && cp "$XML" "$DIST/iuventa-content.xml"
	echo "   -> dist/iuventa-content.xml"
else
	echo "   (export skipped — you can also rely on the theme's auto-seed on activation)"
fi
rm -rf "$TMP_EXPORT"

echo "==> Zipping package..."
( cd "$DIST" && zip -qr "iuventa-site.zip" "iuventa-site" )

echo ""
echo "==> Готово. Полный сайт для хостинга:"
echo "    папка: $PKG"
echo "    архив: $DIST/iuventa-site.zip"
echo "    контент (опционально для импорта): $DIST/iuventa-content.xml"
echo ""
echo "Дальше см. DEPLOY.md (загрузка на хостинг, создание базы MySQL, установка)."
