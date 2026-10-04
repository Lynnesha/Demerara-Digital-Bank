#!/usr/bin/env bash
set -euo pipefail
BASE_URL="${1:-http://127.0.0.1:3000}"
# Confirm that each public route responds successfully without requiring a customer session.
for route in index.php personal-banking.php investments.php calculator.php register.php login.php; do
  status=$(curl -sS -o /dev/null -w '%{http_code}' "$BASE_URL/$route")
  test "$status" = "200"
  printf 'PASS %s (%s)\n' "$route" "$status"
done
# Confirm that protected routes redirect safely to login and still resolve to a valid response.
for route in dashboard.php accounts.php transactions.php statements.php transfer.php portfolio.php profile.php; do
  status=$(curl -sS -o /dev/null -w '%{http_code}' -L "$BASE_URL/$route")
  test "$status" = "200"
  printf 'PASS protected redirect %s (%s)\n' "$route" "$status"
done
