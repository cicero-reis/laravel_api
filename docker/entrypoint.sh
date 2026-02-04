#!/bin/sh
set -e

echo "Ajustando permissões do projeto..."

chown creis:creis /application/.rr.yaml 2>/dev/null || true
chown -R creis:creis /application/storage /application/bootstrap/cache
chmod -R 775 /application/storage /application/bootstrap/cache

exec "$@"
