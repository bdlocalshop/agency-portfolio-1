# Product Requirement Document (PRD)

## Project Title
**Minimalist IT Agency Portfolio & Lead Generation Platform**

---

## 1. Executive Summary & Objective

### 1.1 Objective
To build a lean, high-performance, single-domain web application for an emerging IT agency. The platform serves as the central hub to display agency technical capabilities across Web Design, Web Development, Web Apps, Mobile Apps, Desktop Apps, and Browser Extensions, converting prospective leads into discovery calls and qualified inquiries.

### 1.2 Guiding Principle: "Bare Minimum Viable"
To avoid unnecessary operational overhead and third-party SaaS subscriptions, the project operates on the absolute minimum external infrastructure:
- Single VPS / Shared Server hosting running standard PHP 8.x + MySQL + Nginx/Apache.
- Custom domain.
- Free-tier transactional mailer (Resend / Brevo) for guaranteed email delivery.
- Free bot mitigation (Cloudflare Turnstile or invisible honeypot).
- Local file storage for project assets (no external S3/R2 required initially).

---

## 2. Target Audience & Personas

| Persona | Role / Description | Primary Motivation | Core Site Expectation |
| :--- | :--- | :--- | :--- |
| **Founder / Startup Lead** | Looking to build an MVP (Web/Mobile/Extension). | Fast delivery, proven execution, clear pricing/timeline estimates. | Needs to see real, functioning app screenshots and clear tech stack tags. |
| **Small-to-Medium Business Owner** | Modernizing outdated business tools or building an online presence. | Reliability, direct human communication, no corporate jargon. | Needs a dead-simple contact flow and clear service categories. |
| **Technical Partner / Agency Lead** | Seeking white-label developers or specialized subcontracting. | Code cleanliness, engineering competence. | Evaluates code discipline, tech badges, and responsive UI polish. |

---

## 3. Scope of Services & Category Taxonomies

The portfolio and service sections must accommodate the following default taxonomies:
1. **Web Design & UI/UX** (Figma, responsive layouts, design systems)
2. **Web Development & Websites** (Corporate sites, landing pages, CMS)
3. **Web Applications (SaaS / Portals)** (Custom dashboards, full-stack systems)
4. **Mobile Applications** (iOS, Android, cross-platform)
5. **Desktop Applications** (Windows, macOS, native utilities)
6. **Browser Extensions** (Chrome, Firefox, Edge utility plugins)

---

## 4. Information Architecture & Page Structure

The V1 platform will operate primarily as an optimized **Single-Page Application (SPA) feel with anchor navigation**, backed by a dedicated minimal Admin Panel:

```
[ Visitor Facing ]
├── Navigation Bar (Sticky / Clean)
├── Hero / Value Proposition Section
├── Quick Proof / Metric Strip
├── Interactive Portfolio Grid (Filtered by Service Category)
│   └── Project Detail Modal (or Lightweight Drawer)
├── "How We Work" / Capabilities Strip
└── Contact & Lead Capture Form (with Spam Protection)

[ Admin / Management (Protected) ]
├── Authentication (/admin/login)
├── Portfolio Item Management (CRUD)
├── Category Management
└── Lead Submissions Inbox
```

---

## 5. Functional Requirements

### 5.1 Front-End / Public Area

#### FR-1.1: Hero Section
- **Headline & Subtitle:** Clear statement of capability (e.g., *"We architect and build production-grade web, mobile, and desktop software"*).
- **Primary Call to Action (CTA):** Smooth scroll to `#contact` or `#portfolio`.
- **Secondary CTA:** View Featured Work.

#### FR-1.2: Portfolio Showcase & Filtering
- **Category Filter Tabs:**
  - `All`, `Websites & UI`, `Web Apps`, `Mobile`, `Desktop`, `Extensions`.
- **Dynamic Filtering:** Instant transition (using Alpine.js or Livewire) without full-page reloads.
- **Project Card Structure:**
  - Cover screenshot / mock thumbnail (WebP format with fallback).
  - Project Title.
  - Category Badge.
  - Tech Stack Badges (e.g., `Laravel`, `Vue.js`, `Flutter`, `Electron`).
  - Action Trigger: "View Details" opens a modal overlay.

#### FR-1.3: Project Detail Modal / View
- High-resolution preview image.
- **Problem & Solution statement** (2–3 sentences explaining what was built and why).
- Direct external link button to live deployment or store listing (if public).

#### FR-1.4: Contact & Lead Ingestion Form
- **Form Fields:**
  - Full Name (`text`, required, max: 100)
  - Work Email (`email`, required)
  - Project Scope / Category (`select dropdown`: Web, Mobile, Desktop, Extension, General)
  - Approximate Budget / Timeline (`select dropdown`, optional)
  - Project Details / Message (`textarea`, required, max: 2000)
- **Spam Mitigation:**
  - Integrated Cloudflare Turnstile token verification or an invisible Honeypot field (e.g., `website_url_trap`).
  - Server-side rate-limiting (`throttle:5,1` - max 5 submissions per minute per IP).
- **Submission Feedback:** Inline asynchronous success message (no page refresh).

---

### 5.2 Back-End & Administrative Area

#### FR-2.1: Authentication & Security
- Secure admin authentication (Laravel Breeze / Filament Authentication).
- Session-based auth with CSRF protection and brute-force lockout.

#### FR-2.2: Portfolio Management (CRUD)
- Admin can create, read, update, and delete portfolio entries.
- Fields: `title`, `slug`, `category_id`, `description`, `challenge_solution`, `client_name`, `live_url`, `featured_flag`, `sort_order`, `thumbnail_path`.
- Automatic image resizing/conversion to WebP upon upload.

#### FR-2.3: Inquiries & Leads Management
- Database table storing every contact form entry (`inquiries`).
- Status tracking: `New`, `Contacted`, `Archived`.
- Real-time notification: When an inquiry is submitted, an automated transactional email is sent to the agency owner's email address via Resend/Brevo API.

---

## 6. Technical Stack & Implementation Guidelines

```
+--------------------------------------------------------------+
|                       Presentation                           |
|       Blade Templates + Tailwind CSS + Alpine.js             |
|       (or FilamentPHP Admin Panel for backend)               |
+--------------------------------------------------------------+
                                |
+--------------------------------------------------------------+
|                     Application Layer                        |
|                  Laravel 11.x / PHP 8.2+                     |
|          - Form Request Validation                           |
|          - Mailables / Queued Mail Notifications             |
|          - Rate Limiting Middleware                          |
+--------------------------------------------------------------+
                                |
+--------------------------------------------------------------+
|                     Persistence & Media                      |
|       MySQL 8.x / MariaDB  +  Local Storage (public disk)    |
+--------------------------------------------------------------+
                                |
+--------------------------------------------------------------+
|                   External Micro-Services                    |
|    - Transactional Mail: Resend / Brevo (Free API)           |
|    - Spam Defense: Cloudflare Turnstile (Free)               |
|    - DNS / Edge: Cloudflare Free Tier                        |
+--------------------------------------------------------------+
```

### 6.1 Database Schema (Core Tables)

```sql
-- Categories
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Projects
CREATE TABLE projects (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    short_description VARCHAR(500) NOT NULL,
    full_description TEXT NULL,
    tech_stack JSON NULL,
    thumbnail_url VARCHAR(255) NOT NULL,
    external_url VARCHAR(255) NULL,
    is_featured BOOLEAN DEFAULT FALSE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Inquiries
CREATE TABLE inquiries (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(255) NOT NULL,
    service_type VARCHAR(100) NULL,
    budget_range VARCHAR(50) NULL,
    message TEXT NOT NULL,
    ip_address VARCHAR(45) NULL,
    status ENUM('new', 'contacted', 'closed') DEFAULT 'new',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

---

## 7. Non-Functional Requirements (NFR)

1. **Performance:** Google PageSpeed Insights mobile score $\ge 85$, desktop score $\ge 95$.
2. **Accessibility:** Form fields must have associated labels and semantic HTML markup (WCAG AA compliant contrast ratios).
3. **SEO Fundamentals:** Dynamic Meta title, OpenGraph image tags for social sharing preview, and auto-generated `sitemap.xml`.
4. **Zero Cost Beyond Hosting:** Zero paid SaaS requirements. Utilizes free tiers for SMTP and bot protection.

---

## 8. Phased Delivery Roadmap

```
Phase 1: Foundation (Day 1 - 2)
  ├── Setup Laravel project + Tailwind CSS + Alpine.js
  ├── Run database migrations (Categories, Projects, Inquiries)
  └── Configure Filament admin panel for basic CRUD operations

Phase 2: Public UI & Layout (Day 3 - 4)
  ├── Build responsive Hero, Category Tabs, and Portfolio Grid
  ├── Implement client-side filtering via Alpine.js
  └── Build Project Detail modal dialog

Phase 3: Lead Pipeline & Verification (Day 5)
  ├── Contact form submission with Cloudflare Turnstile verification
  ├── Setup Resend / Brevo Mailer integration
  └── Store inquiries into database with auto-reply dispatch

Phase 4: Deployment & DNS Setup (Day 6)
  ├── Host on server (Nginx + PHP 8.x + MySQL)
  ├── Route domain through Cloudflare DNS
  └── Issue SSL certificate & test production delivery
```