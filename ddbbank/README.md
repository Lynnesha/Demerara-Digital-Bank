# Demerara Digital Bank

A responsive **academic PHP/MySQL banking prototype** for Demerara Digital Bank (DDB). It uses fictional demonstration data only and does not process real financial transactions, real investment orders or real customer information.

## Technology

- HTML5 and CSS3
- JavaScript
- PHP 8+
- MySQL/MariaDB
- Git/GitHub

## Prototype journey

Discover DDB → Explore Products → Register → Log In → Dashboard → Accounts → Transactions/Statements → Simulated Transfer → Investments → Profile → Log Out

## Local setup

1. Install PHP with the PDO MySQL extension and MySQL/MariaDB.
2. Create the local database user and import the schema:

   ```bash
   sudo mysql -e "CREATE USER IF NOT EXISTS 'ddb_app'@'localhost' IDENTIFIED BY 'ddb_demo_2026'; GRANT ALL PRIVILEGES ON ddb_bank.* TO 'ddb_app'@'localhost'; FLUSH PRIVILEGES;"
   sudo mysql < database/ddb_bank.sql
   ```

3. Start the PHP development server:

   ```bash
   php -S 0.0.0.0:3000
   ```

4. Open `http://localhost:3000`.

The default connection settings are in `config/database.php`. They can be overridden with `DDB_DB_HOST`, `DDB_DB_PORT`, `DDB_DB_NAME`, `DDB_DB_USER` and `DDB_DB_PASSWORD` environment variables.

## Demonstration account

| Field | Value |
| --- | --- |
| Username | `amara.doe` |
| Password | `DemoPass!2026` |

You can also register a new fictional account through the interface.

## Included features

- Public home, personal banking, business banking, investments and calculator pages
- Product highlights for Savings, Chequing, Debit Card, Personal Loan and Mortgage
- Registration with browser and PHP validation, prepared statements and `password_hash()`
- Username/email login using `password_verify()` and protected PHP session pages
- Dashboard, accounts, transaction search/filtering, sample statement downloads and simulated transfers
- Investment portfolio, session-based watchlist and JavaScript investment growth calculator
- Responsive desktop/tablet/mobile interface with semantic landmarks, labels, focus states and accessible status/error messages
- `ddb_bank` schema containing `users`, `accounts`, `transactions` and `investments`

## Security demonstration

This prototype demonstrates PHP sessions, secure session cookies, session regeneration at login, CSRF form tokens, prepared SQL statements, password hashing/verification, input validation, protected routes and session destruction at logout. A production financial system needs substantially broader security, compliance, operational and audit controls.

## Scope boundaries

No real banking payments, credit/debit-card processing, stock trading, market API, identity verification, loan approval, credit scoring, ATM integration, real mobile banking or production banking infrastructure is included.

Designed & Developed by LLR Innovations.
