# Demerara Digital Bank Prototype Plan

## Implementation approach
A PHP 8 and MySQL academic prototype will implement the complete specified journey using only fictional data. Shared PHP includes provide navigation, accessible layout, sessions, CSRF tokens, flash notices and display helpers. MySQL persists registered users, account summaries, simulated transfers, transactions and investment data. JavaScript powers mobile navigation, registration feedback, transaction filtering, watchlist interaction and the investment growth calculator.

## Design direction
- **Design movement:** contemporary Caribbean financial editorial — composed, optimistic and precise.
- **Core principles:** clear hierarchy, calm assurance, purposeful contrast and transparent financial information.
- **Colour philosophy:** deep river green signals stability; warm gold marks progress and action; ivory space keeps dense data approachable.
- **Layout paradigm:** editorial bands and asymmetric card groupings rather than a uniform centred grid.
- **Signature elements:** a gold D monogram, curved river-line dividers and stacked balance cards.
- **Interaction philosophy:** controls respond immediately and plainly, with visible status language.
- **Animation:** short, reduced-motion-safe transitions on menus, cards and calculator results.
- **Typography system:** a system sans-serif stack with high-contrast serif display headings.
- **Brand essence:** a clear digital banking prototype for people building their financial future; grounded, capable and forward-looking.
- **Brand voice:** direct and steady. “Move money with clarity.” “Your next financial step starts here.”
- **Wordmark and logo:** a gold D carved from a deep green rounded square.
- **Signature brand colour:** River Green #0A5446.

## Project structure
| Area | Responsibility |
| --- | --- |
| Root PHP pages | Public website and authenticated portal routes |
| `config/database.php` | PDO MySQL connection and prepared-statement configuration |
| `includes/` | Shared layout, security helpers and authentication guards |
| `css/style.css` | Responsive visual system, components and accessibility states |
| `js/main.js` | Mobile menu, forms, filters, calculator and watchlist behaviour |
| `database/ddb_bank.sql` | Required schema and fictional seed data |
| `statements/` | Downloadable demonstration statement files |
| `docs/` | Sitemap and capture folder |

## Final polish approach
The existing prototype remains the primary submission because its PHP/MySQL route structure is easy to explain and maps directly to the specification. Final changes add explanatory comments only where logic is non-obvious, preserve the fictional-data scope, strengthen muted-text contrast to WCAG AA, and make horizontally scrollable mobile tables keyboard-focusable. The original accessibility scan remains preserved as evidence before a final re-scan records the remediated result.
