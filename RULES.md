# Agent Development Rules & Constraints

## Design & UI Rules
1. **Design Reference Priority:** Adhere strictly to the styling, spacing, typography, and color harmony found in `design-reference/`. Do not default to generic templates unless the reference lacks guidance.
2. **Responsive First:** Every section must render correctly down to `360px` screens.
3. **No Layout Shift:** Reserve image aspect ratios for portfolio thumbnails to avoid CLS (Cumulative Layout Shift).

## Architecture & Code Standards
1. **Laravel Idioms:** Follow standard Laravel conventions:
   - Form requests for request validation.
   - Mailable classes with queued jobs for outbound emails.
   - Seeders for quick local testing.
2. **Security Essentials:**
   - Always protect public forms against CSRF and automated spam bots (Cloudflare Turnstile or honeypot).
   - Sanitize all user inputs before persistence.
3. **Asset Handling:**
   - Store portfolio images in standard Laravel public storage (`storage/app/public`) with proper symlink handling (`php artisan storage:link`).
   - Use WebP formats and responsive image attributes where possible.

## Execution Discipline
1. Never leave placeholder `TODO` comments in critical business logic (e.g., form handling, database queries).
2. Verify local builds and migrations execute without errors before marking phases complete.