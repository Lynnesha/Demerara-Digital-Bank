-- Rebuild the local academic database and its fictional demonstration records.
CREATE DATABASE IF NOT EXISTS ddb_bank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ddb_bank;

DROP TABLE IF EXISTS investments;
DROP TABLE IF EXISTS transactions;
DROP TABLE IF EXISTS accounts;
DROP TABLE IF EXISTS users;

-- Customer credentials are stored separately from account and transaction data.
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(60) NOT NULL,
    last_name VARCHAR(60) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    phone VARCHAR(30) NOT NULL,
    date_of_birth DATE NOT NULL,
    username VARCHAR(40) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Each account belongs to one user; deleting the user removes dependent fictional accounts.
CREATE TABLE accounts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    account_number VARCHAR(24) NOT NULL UNIQUE,
    account_type VARCHAR(40) NOT NULL,
    balance DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    status VARCHAR(20) NOT NULL DEFAULT 'Active',
    CONSTRAINT fk_accounts_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Signed transaction amounts preserve the distinction between money in and money out.
CREATE TABLE transactions (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    account_id INT UNSIGNED NOT NULL,
    transaction_type VARCHAR(30) NOT NULL,
    description VARCHAR(180) NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    transaction_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_transactions_account FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE CASCADE,
    INDEX idx_transactions_account_date (account_id, transaction_date)
) ENGINE=InnoDB;

-- Portfolio holdings belong to the authenticated user.
CREATE TABLE investments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    investment_name VARCHAR(100) NOT NULL,
    investment_type VARCHAR(50) NOT NULL,
    value DECIMAL(12,2) NOT NULL,
    performance DECIMAL(7,2) NOT NULL,
    CONSTRAINT fk_investments_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Seed one fictional customer so the complete portal journey can be demonstrated immediately.
INSERT INTO users (first_name, last_name, email, phone, date_of_birth, username, password) VALUES
('Amara', 'Persaud', 'amara.persaud@example.test', '+592 600 4832', '1993-05-18', 'amara.doe', '$2y$10$H.rAd5.HYus2PvR9KB2Y4eGa11zkWT25dfac6qY4mmZacUNn6x4g.');

INSERT INTO accounts (user_id, account_number, account_type, balance, status) VALUES
(1, '4048000012324832', 'Chequing', 8420.75, 'Active'),
(1, '4048000012321904', 'Savings', 15350.40, 'Active'),
(1, '4048000012327750', 'Investment', 12680.20, 'Active');

INSERT INTO transactions (account_id, transaction_type, description, amount, transaction_date) VALUES
(1, 'income', 'Salary credit — Demerara Design Co.', 4200.00, '2026-09-30 09:15:00'),
(1, 'payment', 'Harvest Market', -185.30, '2026-09-29 15:42:00'),
(1, 'transfer', 'Transfer to Savings', -500.00, '2026-09-28 10:02:00'),
(1, 'payment', 'DDB Utilities Bill Pay', -92.65, '2026-09-26 08:30:00'),
(2, 'transfer', 'Transfer from Chequing', 500.00, '2026-09-28 10:02:00'),
(2, 'income', 'Savings dividend', 15.40, '2026-09-25 00:00:00'),
(3, 'income', 'Investment contribution', 300.00, '2026-09-20 12:00:00');

INSERT INTO investments (user_id, investment_name, investment_type, value, performance) VALUES
(1, 'Demerara Equity Fund', 'Investment Fund', 4960.25, 8.40),
(1, 'Caribbean Treasury Bond 2029', 'Bond', 3220.00, 4.10),
(1, 'Regional Growth Shares', 'Stocks', 4500.95, 11.70);
