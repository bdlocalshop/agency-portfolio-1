# Admin Panel Scope & Requirements

## Tech Engine
- **Framework:** FilamentPHP v3 (installed directly into this Laravel project).
- **Authentication:** Standard Laravel/Filament admin user authentication (`User` model with `is_admin` flag or standard Filament panel guard).

## Manageable Resources

### 1. Site Settings (Single-Page Form or Settings Table)
- **Brand Assets:** Agency Name, Site Logo (upload), Favicon (upload).
- **Hero Banner:** Main Headline, Sub-headline, Primary CTA Button text & URL, Secondary CTA text & URL.
- **Contact Details:** Official Email, Phone/WhatsApp number, Physical/Country location, Social media URLs (GitHub, LinkedIn, X).

### 2. Proof & Metrics (Dynamic Management)
- **Stats Counter:** Title/Metric (e.g., "15+", "99.9%"), Subtitle/Label (e.g., "Projects Delivered"), Display Order.
- **Client Testimonials / Reviews:** Client Name, Role/Company, Avatar (upload), Star Rating (1-5), Quote/Feedback, Display Toggle (Active/Draft).

### 3. Portfolio Management (`Projects` Resource)
- Fields: Title, Slug, Category (BelongsTo), Thumbnail image, Gallery images, Short summary, Problem/Challenge, Solution, Tech Stack tags (e.g., Laravel, React, Flutter), Live Demo URL, GitHub URL, Featured toggle, Sort order.
- Action: Full CRUD (Create, Read, Update, Delete) + reordering.

### 4. Categories Management (`Categories` Resource)
- Fields: Name, Slug, Description, Is Active toggle.

### 5. Inquiries / Contact Leads (`Inquiries` Resource)
- Fields: Name, Email, Project Type, Message, Budget Bracket, Submitted At, Status (`New`, `Contacted`, `Archived`).
- Action: Read-only view + Status update + Export or Delete. No public creation from admin.