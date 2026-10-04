# DDB Automated Accessibility Scan

## Scan scope

- **Engine:** axe-core through @axe-core/playwright
- **Rule tags:** `wcag2a`, `wcag2aa`, `wcag21a`, `wcag21aa`, `best-practice`
- **Routes scanned:** 28 (7 public and 7 authenticated portal routes at two viewport widths)
- **Desktop viewport:** 1440 × 1000
- **Mobile viewport:** 390 × 844
- **Scan timestamp:** 2026-10-04T04:21:36.782Z
- **Authentication:** Portal routes were scanned after logging in with the project’s fictional demonstration account.

## Summary

| Metric | Result |
| --- | ---: |
| Route/viewport scans | 28 |
| Automated violations | 18 |
| Affected DOM nodes | 27 |
| Rules needing review | 20 |
| Passed rule evaluations | 940 |

## Route results

| Area | Page | Route | Viewport | Status | Violations | Affected nodes | Needs review | Passed rules |
| --- | --- | --- | --- | --- | ---: | ---: | ---: | ---: |
| Public | Home | `index.php` | Desktop | Pass | 0 | 0 | 2 | 29 |
| Public | Personal Banking | `personal-banking.php` | Desktop | Pass | 0 | 0 | 0 | 31 |
| Public | Business Banking | `business.php` | Desktop | Pass | 0 | 0 | 0 | 29 |
| Public | Investments | `investments.php` | Desktop | Pass | 0 | 0 | 1 | 29 |
| Public | Investment Calculator | `calculator.php` | Desktop | Violations found | 1 | 2 | 0 | 34 |
| Public | Registration | `register.php` | Desktop | Pass | 0 | 0 | 1 | 39 |
| Public | Login | `login.php` | Desktop | Pass | 0 | 0 | 0 | 35 |
| Portal | Dashboard | `dashboard.php` | Desktop | Violations found | 1 | 2 | 2 | 31 |
| Portal | Accounts | `accounts.php` | Desktop | Violations found | 1 | 1 | 0 | 29 |
| Portal | Transactions | `transactions.php` | Desktop | Violations found | 1 | 1 | 1 | 42 |
| Portal | Statements | `statements.php` | Desktop | Violations found | 1 | 4 | 1 | 29 |
| Portal | Transfer Money | `transfer.php` | Desktop | Violations found | 1 | 1 | 0 | 35 |
| Portal | Investment Portfolio | `portfolio.php` | Desktop | Violations found | 1 | 1 | 2 | 35 |
| Portal | Profile & Settings | `profile.php` | Desktop | Violations found | 1 | 2 | 0 | 37 |
| Public | Home | `index.php` | Mobile | Pass | 0 | 0 | 2 | 31 |
| Public | Personal Banking | `personal-banking.php` | Mobile | Pass | 0 | 0 | 0 | 33 |
| Public | Business Banking | `business.php` | Mobile | Pass | 0 | 0 | 0 | 31 |
| Public | Investments | `investments.php` | Mobile | Pass | 0 | 0 | 1 | 31 |
| Public | Investment Calculator | `calculator.php` | Mobile | Violations found | 1 | 2 | 0 | 34 |
| Public | Registration | `register.php` | Mobile | Pass | 0 | 0 | 1 | 39 |
| Public | Login | `login.php` | Mobile | Pass | 0 | 0 | 0 | 35 |
| Portal | Dashboard | `dashboard.php` | Mobile | Violations found | 1 | 2 | 2 | 31 |
| Portal | Accounts | `accounts.php` | Mobile | Violations found | 1 | 1 | 0 | 31 |
| Portal | Transactions | `transactions.php` | Mobile | Violations found | 2 | 2 | 1 | 42 |
| Portal | Statements | `statements.php` | Mobile | Violations found | 1 | 1 | 1 | 31 |
| Portal | Transfer Money | `transfer.php` | Mobile | Violations found | 1 | 1 | 0 | 35 |
| Portal | Investment Portfolio | `portfolio.php` | Mobile | Violations found | 2 | 2 | 2 | 35 |
| Portal | Profile & Settings | `profile.php` | Mobile | Violations found | 1 | 2 | 0 | 37 |

## Detailed violation findings

### color-contrast — serious

**Elements must meet minimum color contrast ratio thresholds**  
Ensure the contrast between foreground and background colors meets WCAG 2 AA minimum contrast ratio thresholds  
[Rule guidance](https://dequeuniversity.com/rules/axe/4.13/color-contrast?application=playwright)  
Tags: `cat.color`, `wcag2aa`, `wcag143`, `TTv5`, `TT13.c`, `EN-301-549`, `EN-9.1.4.3`, `ACT`, `RGAAv4`, `RGAA-3.2.1`

#### Investment Calculator — Desktop (`calculator.php`)
- Target: `div:nth-child(1) > span`
  - HTML: `<span>Amount contributed</span>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.43 (foreground color: #667571, background color: #f3f6f1, font size: 8.4pt (11.2px), font weight: normal). Expected contrast ratio of 4.5:1
- Target: `div:nth-child(2) > span`
  - HTML: `<span>Estimated investment growth</span>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.43 (foreground color: #667571, background color: #f3f6f1, font size: 8.4pt (11.2px), font weight: normal). Expected contrast ratio of 4.5:1

#### Dashboard — Desktop (`dashboard.php`)
- Target: `.portal-welcome > div > p:nth-child(3)`
  - HTML: `<p>Here is the fictional DDB picture at a glance.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1
- Target: `.demo-badge`
  - HTML: `<p class="demo-badge">Demo data only</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.29 (foreground color: #667571, background color: #fff1c9, font size: 9.0pt (12px), font weight: bold). Expected contrast ratio of 4.5:1

#### Accounts — Desktop (`accounts.php`)
- Target: `.portal-welcome > div > p:nth-child(3)`
  - HTML: `<p>Balances and activity are fictional demonstration data.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1

#### Transactions — Desktop (`transactions.php`)
- Target: `p:nth-child(3)`
  - HTML: `<p>Search or filter the activity shown across your DDB accounts.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1

#### Statements — Desktop (`statements.php`)
- Target: `p:nth-child(3)`
  - HTML: `<p>These downloadable sample statements are provided for the academic prototype only.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1
- Target: `.statement-header > span:nth-child(1)`
  - HTML: `<span>Statement</span>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.44 (foreground color: #667571, background color: #f4f6f2, font size: 8.4pt (11.2px), font weight: bold). Expected contrast ratio of 4.5:1
- Target: `.statement-header > span:nth-child(2)`
  - HTML: `<span>Period</span>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.44 (foreground color: #667571, background color: #f4f6f2, font size: 8.4pt (11.2px), font weight: bold). Expected contrast ratio of 4.5:1
- Target: `.statement-header > span:nth-child(3)`
  - HTML: `<span>Action</span>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.44 (foreground color: #667571, background color: #f4f6f2, font size: 8.4pt (11.2px), font weight: bold). Expected contrast ratio of 4.5:1

#### Transfer Money — Desktop (`transfer.php`)
- Target: `p:nth-child(3)`
  - HTML: `<p>Transfers in this prototype are simulated only; no real payment is sent.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1

#### Investment Portfolio — Desktop (`portfolio.php`)
- Target: `.portal-welcome > div > p:nth-child(3)`
  - HTML: `<p>All values and performance figures are fictional demonstration data.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1

#### Profile & Settings — Desktop (`profile.php`)
- Target: `div > p:nth-child(3)`
  - HTML: `<p>Manage the information attached to your DDB demonstration account.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1
- Target: `.demo-badge`
  - HTML: `<p class="demo-badge">Logged in</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.29 (foreground color: #667571, background color: #fff1c9, font size: 9.0pt (12px), font weight: bold). Expected contrast ratio of 4.5:1

#### Investment Calculator — Mobile (`calculator.php`)
- Target: `div:nth-child(1) > span`
  - HTML: `<span>Amount contributed</span>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.43 (foreground color: #667571, background color: #f3f6f1, font size: 8.4pt (11.2px), font weight: normal). Expected contrast ratio of 4.5:1
- Target: `div:nth-child(2) > span`
  - HTML: `<span>Estimated investment growth</span>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.43 (foreground color: #667571, background color: #f3f6f1, font size: 8.4pt (11.2px), font weight: normal). Expected contrast ratio of 4.5:1

#### Dashboard — Mobile (`dashboard.php`)
- Target: `.portal-welcome > div > p:nth-child(3)`
  - HTML: `<p>Here is the fictional DDB picture at a glance.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1
- Target: `.demo-badge`
  - HTML: `<p class="demo-badge">Demo data only</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.29 (foreground color: #667571, background color: #fff1c9, font size: 9.0pt (12px), font weight: bold). Expected contrast ratio of 4.5:1

#### Accounts — Mobile (`accounts.php`)
- Target: `.portal-welcome > div > p:nth-child(3)`
  - HTML: `<p>Balances and activity are fictional demonstration data.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1

#### Transactions — Mobile (`transactions.php`)
- Target: `p:nth-child(3)`
  - HTML: `<p>Search or filter the activity shown across your DDB accounts.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1

#### Statements — Mobile (`statements.php`)
- Target: `p:nth-child(3)`
  - HTML: `<p>These downloadable sample statements are provided for the academic prototype only.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1

#### Transfer Money — Mobile (`transfer.php`)
- Target: `p:nth-child(3)`
  - HTML: `<p>Transfers in this prototype are simulated only; no real payment is sent.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1

#### Investment Portfolio — Mobile (`portfolio.php`)
- Target: `.portal-welcome > div > p:nth-child(3)`
  - HTML: `<p>All values and performance figures are fictional demonstration data.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1

#### Profile & Settings — Mobile (`profile.php`)
- Target: `div > p:nth-child(3)`
  - HTML: `<p>Manage the information attached to your DDB demonstration account.</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.45 (foreground color: #667571, background color: #f5f6f3, font size: 12.0pt (16px), font weight: normal). Expected contrast ratio of 4.5:1
- Target: `.demo-badge`
  - HTML: `<p class="demo-badge">Logged in</p>`
  - Failure: Fix any of the following:
  Element has insufficient color contrast of 4.29 (foreground color: #667571, background color: #fff1c9, font size: 9.0pt (12px), font weight: bold). Expected contrast ratio of 4.5:1

### scrollable-region-focusable — serious

**Scrollable region must have keyboard access**  
Ensure elements that have scrollable content are accessible by keyboard in Safari  
[Rule guidance](https://dequeuniversity.com/rules/axe/4.13/scrollable-region-focusable?application=playwright)  
Tags: `cat.keyboard`, `wcag2a`, `wcag211`, `wcag213`, `TTv5`, `TT4.a`, `EN-301-549`, `EN-9.2.1.1`, `EN-9.2.1.3`, `RGAAv4`, `RGAA-7.3.2`

#### Transactions — Mobile (`transactions.php`)
- Target: `.table-wrap`
  - HTML: `<div class="table-wrap">`
  - Failure: Fix any of the following:
  Element should have focusable content
  Element should be focusable

#### Investment Portfolio — Mobile (`portfolio.php`)
- Target: `.table-wrap`
  - HTML: `<div class="table-wrap">`
  - Failure: Fix any of the following:
  Element should have focusable content
  Element should be focusable

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
