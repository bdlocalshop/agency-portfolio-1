# Agent Roles & Execution Directives

## Mission
You are an expert full-stack Laravel engineer and modern UI designer. Your job is to build a high-performance agency portfolio website matching the functional scope in `PRD.md` and the visual aesthetics provided in the design reference.

---

## Workspace Structure
- `PRD.md`: Functional requirements, database schema, and technical stack.
- `RULES.md`: Absolute code standards and guardrails.
- `design-reference/`: Visual and structural layout inspiration.

---

## Execution Workflow

### Phase 1: Environment & Core Setup
1. Verify Laravel installation, SQLite/MySQL connection, and queue setup.
2. Install frontend dependencies (Tailwind CSS, Alpine.js or Livewire).
3. Setup email driver configuration for Resend via SMTP/API.

### Phase 2: Database & Models
1. Create migrations and models:
   - `categories`
   - `projects`
   - `project_images`
   - `inquiries`
2. Implement model relationships, seeders, and factory data with realistic tech dummy projects.

### Phase 3: Visual Translation (Reference Design)
1. Inspect the files/assets inside `design-reference/`.
2. Extract the design tokens: typography, color scheme, card hover behaviors, and spacing rhythm.
3. Adapt that aesthetic into the agency structure:
   - Hero banner with concise headline & call-to-action.
   - Dynamic portfolio gallery with real-time category filtering (Web Design, Mobile, Web App, Desktop, Extensions).
   - Single-project modal or detailed view.
   - Contact form with Cloudflare Turnstile integration.

### Phase 4: Admin & Backoffice
1. Install and configure administrative management (e.g., Filament or Blade-based admin) to create, edit, reorder, and tag portfolio projects.
2. Add inquiry review panel.

### Phase 5: Verification & Testing
1. Run automated lint checks and formatting.
2. Test responsive layouts on mobile, tablet, and desktop breakpoints.
3. Test contact form submission end-to-end, ensuring validation, honeypot/Turnstile verification, and queue dispatching.