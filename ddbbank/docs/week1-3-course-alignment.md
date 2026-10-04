# Week 1–3 Course-Material Alignment

## Overall verdict

The DDB prototype **aligns with the core outcomes** taught in the Week 1, Week 2 and Week 3 materials. The three PDFs are instructional notes rather than a project-specific marking rubric, so the site is not expected to reproduce every example or exercise verbatim. It applies the relevant principles in a complete banking-prototype context.

## Week 1 — Introduction, structure, semantic markup and web development life cycle

| Course topic | Alignment | Evidence |
| --- | --- | --- |
| HTML, CSS and JavaScript roles | Complete | PHP pages render HTML structure; `css/style.css` owns presentation; `js/main.js` owns browser interactions. |
| Website structure | Complete | Shared `header`, `nav`, `main` and `footer` frame every page; content is divided into logical `section`, `article` and `aside` regions. |
| Human, browser, device and screen-reader access | Complete in implementation | Semantic landmarks, skip link, labels, headings, visible focus styles, live messages and responsive layout support varied users and devices. |
| Semantic markup | Complete | The application uses semantic HTML5 elements for page landmarks, navigation, sections, articles, form labels and data tables. |
| Website evaluation principles | Applied appropriately | DDB is clearly labelled as a fictional academic prototype, uses no real financial claims, identifies LLR Innovations in the footer and separates sample figures from real-world advice. |
| Planning, sitemap, layout, coding, testing and maintenance | Complete for the prototype | `plan.md`, `docs/sitemap.png`, `docs/wireframe.png`, final screenshots, `tests/smoke.sh`, README setup steps and Git history provide lifecycle evidence. |

### Week 1 evaluation-rubric note

The course recommends assessing authority, accuracy, objectivity, audience and currency. DDB addresses these as follows:

| Criterion | DDB treatment |
| --- | --- |
| Authority | DDB and LLR Innovations are identified; the site makes no claim to be a real regulated bank. |
| Accuracy | All balances, market figures, statements and transactions are marked as fictional demonstration data. |
| Objectivity | Investment pages state that they are educational and do not provide financial advice or trading. |
| Audience | Copy, account flows and explanations are designed for prospective digital-banking customers and academic reviewers. |
| Currency | The prototype labels its sample statement periods and date context; internal routes were checked during functional testing. |

## Week 2 — Separation of structure and presentation, colours and accessibility

| Course topic | Alignment | Evidence |
| --- | --- | --- |
| Separation of structure from presentation | Complete | Page structure is in PHP/HTML; presentation is centralised in `css/style.css`; browser behaviour is in `js/main.js`. No inline `style` attributes remain in application pages. |
| Reusable style sheets | Complete | All pages load the same external stylesheet through `includes/header.php`. |
| Coherent colour scheme | Complete | CSS variables define River Green, gold, ink, paper and muted tones for a consistent financial-services palette. |
| CSS colour techniques | Complete for practical use | The stylesheet uses hexadecimal colours, RGB/RGBA transparency and CSS variables. The HSL/HSLA examples in the course are alternative syntax demonstrations, not a required site feature. |
| Colour accessibility | Strong evidence | Primary tested pairs meet or exceed normal-text contrast guidance: ink on paper 15.77:1, white on River Green 8.86:1, River Green on paper 8.72:1, white on ink 16.03:1 and gold on River Green 5.53:1. Focus indicators and error colours are also defined. |

## Week 3 — Responsive design

| Course topic | Alignment | Evidence |
| --- | --- | --- |
| Responsive design for varied devices | Complete | The same site adapts for desktop, tablet and phone; it does not duplicate content into separate sites. |
| Viewport configuration | Complete | `includes/header.php` provides `width=device-width, initial-scale=1`. |
| Fluid layouts and responsive text | Complete | CSS uses `min()`, `max()`, percentage widths, CSS Grid, Flexbox and `clamp()` typography. |
| Media queries | Complete | `css/style.css` includes desktop-to-tablet and tablet-to-mobile breakpoints at 900px and 680px. |
| Responsive navigation and components | Complete | The menu becomes JavaScript-controlled on smaller displays; cards, forms, tables, portal views and footer columns collapse appropriately. |
| Responsive proof | Complete | `docs/screenshots/home-desktop.png` and `docs/screenshots/home-mobile.png` capture the same page at desktop and 390px mobile widths. |

## Not literal course-exercise deliverables

The site intentionally does **not** copy the course’s sample university page, colour-demo snippets, separate-device websites or a third-party CSS framework. Those are teaching examples; the implemented prototype uses its own banking design, responsive CSS and native HTML/CSS/JavaScript.

## Remaining optional evidence

For a formal course submission, a tutor might also request a manual screen-reader test and an automated accessibility scan. Those would be additional assessment evidence, not missing core implementation features.
