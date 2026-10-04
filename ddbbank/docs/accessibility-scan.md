# DDB Automated Accessibility Scan

## Scan scope

- **Engine:** axe-core through @axe-core/playwright
- **Rule tags:** `wcag2a`, `wcag2aa`, `wcag21a`, `wcag21aa`, `best-practice`
- **Routes scanned:** 28 (7 public and 7 authenticated portal routes at two viewport widths)
- **Desktop viewport:** 1440 × 1000
- **Mobile viewport:** 390 × 844
- **Scan timestamp:** 2026-10-04T20:48:55.086Z
- **Authentication:** Portal routes were scanned after logging in with the project’s fictional demonstration account.

## Summary

| Metric | Result |
| --- | ---: |
| Route/viewport scans | 28 |
| Automated violations | 0 |
| Affected DOM nodes | 0 |
| Rules needing review | 20 |
| Passed rule evaluations | 954 |

## Route results

| Area | Page | Route | Viewport | Status | Violations | Affected nodes | Needs review | Passed rules |
| --- | --- | --- | --- | --- | ---: | ---: | ---: | ---: |
| Public | Home | `index.php` | Desktop | Pass | 0 | 0 | 2 | 29 |
| Public | Personal Banking | `personal-banking.php` | Desktop | Pass | 0 | 0 | 0 | 31 |
| Public | Business Banking | `business.php` | Desktop | Pass | 0 | 0 | 0 | 29 |
| Public | Investments | `investments.php` | Desktop | Pass | 0 | 0 | 1 | 29 |
| Public | Investment Calculator | `calculator.php` | Desktop | Pass | 0 | 0 | 0 | 34 |
| Public | Registration | `register.php` | Desktop | Pass | 0 | 0 | 1 | 39 |
| Public | Login | `login.php` | Desktop | Pass | 0 | 0 | 0 | 35 |
| Portal | Dashboard | `dashboard.php` | Desktop | Pass | 0 | 0 | 2 | 31 |
| Portal | Accounts | `accounts.php` | Desktop | Pass | 0 | 0 | 0 | 29 |
| Portal | Transactions | `transactions.php` | Desktop | Pass | 0 | 0 | 1 | 43 |
| Portal | Statements | `statements.php` | Desktop | Pass | 0 | 0 | 1 | 29 |
| Portal | Transfer Money | `transfer.php` | Desktop | Pass | 0 | 0 | 0 | 35 |
| Portal | Investment Portfolio | `portfolio.php` | Desktop | Pass | 0 | 0 | 2 | 40 |
| Portal | Profile & Settings | `profile.php` | Desktop | Pass | 0 | 0 | 0 | 37 |
| Public | Home | `index.php` | Mobile | Pass | 0 | 0 | 2 | 31 |
| Public | Personal Banking | `personal-banking.php` | Mobile | Pass | 0 | 0 | 0 | 33 |
| Public | Business Banking | `business.php` | Mobile | Pass | 0 | 0 | 0 | 31 |
| Public | Investments | `investments.php` | Mobile | Pass | 0 | 0 | 1 | 31 |
| Public | Investment Calculator | `calculator.php` | Mobile | Pass | 0 | 0 | 0 | 34 |
| Public | Registration | `register.php` | Mobile | Pass | 0 | 0 | 1 | 39 |
| Public | Login | `login.php` | Mobile | Pass | 0 | 0 | 0 | 35 |
| Portal | Dashboard | `dashboard.php` | Mobile | Pass | 0 | 0 | 2 | 31 |
| Portal | Accounts | `accounts.php` | Mobile | Pass | 0 | 0 | 0 | 31 |
| Portal | Transactions | `transactions.php` | Mobile | Pass | 0 | 0 | 1 | 44 |
| Portal | Statements | `statements.php` | Mobile | Pass | 0 | 0 | 1 | 31 |
| Portal | Transfer Money | `transfer.php` | Mobile | Pass | 0 | 0 | 0 | 35 |
| Portal | Investment Portfolio | `portfolio.php` | Mobile | Pass | 0 | 0 | 2 | 41 |
| Portal | Profile & Settings | `profile.php` | Mobile | Pass | 0 | 0 | 0 | 37 |

## Detailed violation findings

No automated axe violations were detected within the selected WCAG 2.1 A/AA and best-practice rules.

## Rules needing review

- **aria-prohibited-attr** on Home (Desktop, `index.php`): Elements must only use permitted ARIA attributes
- **color-contrast** on Home (Desktop, `index.php`): Elements must meet minimum color contrast ratio thresholds
- **color-contrast** on Investments (Desktop, `investments.php`): Elements must meet minimum color contrast ratio thresholds
- **aria-valid-attr-value** on Registration (Desktop, `register.php`): ARIA attributes must conform to valid values
- **aria-prohibited-attr** on Dashboard (Desktop, `dashboard.php`): Elements must only use permitted ARIA attributes
- **color-contrast** on Dashboard (Desktop, `dashboard.php`): Elements must meet minimum color contrast ratio thresholds
- **color-contrast** on Transactions (Desktop, `transactions.php`): Elements must meet minimum color contrast ratio thresholds
- **color-contrast** on Statements (Desktop, `statements.php`): Elements must meet minimum color contrast ratio thresholds
- **aria-prohibited-attr** on Investment Portfolio (Desktop, `portfolio.php`): Elements must only use permitted ARIA attributes
- **color-contrast** on Investment Portfolio (Desktop, `portfolio.php`): Elements must meet minimum color contrast ratio thresholds
- **aria-prohibited-attr** on Home (Mobile, `index.php`): Elements must only use permitted ARIA attributes
- **color-contrast** on Home (Mobile, `index.php`): Elements must meet minimum color contrast ratio thresholds
- **color-contrast** on Investments (Mobile, `investments.php`): Elements must meet minimum color contrast ratio thresholds
- **aria-valid-attr-value** on Registration (Mobile, `register.php`): ARIA attributes must conform to valid values
- **aria-prohibited-attr** on Dashboard (Mobile, `dashboard.php`): Elements must only use permitted ARIA attributes
- **color-contrast** on Dashboard (Mobile, `dashboard.php`): Elements must meet minimum color contrast ratio thresholds
- **color-contrast** on Transactions (Mobile, `transactions.php`): Elements must meet minimum color contrast ratio thresholds
- **color-contrast** on Statements (Mobile, `statements.php`): Elements must meet minimum color contrast ratio thresholds
- **aria-prohibited-attr** on Investment Portfolio (Mobile, `portfolio.php`): Elements must only use permitted ARIA attributes
- **color-contrast** on Investment Portfolio (Mobile, `portfolio.php`): Elements must meet minimum color contrast ratio thresholds

## Interpretation and limitations

This is an automated scan, not a complete accessibility certification. It cannot fully judge keyboard interaction order, meaningful alternative text, quality of instructions, screen-reader announcements, visual hierarchy, all dynamic-state behaviours, or the accessibility of downloaded PDFs. Manual keyboard and screen-reader testing remains recommended before a formal accessibility claim.

The raw machine-readable results, including all node-level data, are stored beside this report in `accessibility-scan.json`.
