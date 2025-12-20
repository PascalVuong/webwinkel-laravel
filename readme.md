# Naam
**Webwinkel (Laravel + React/Inertia + TailwindCSS + Filament)**

# Beschrijving
Dit project is een webshop die gebouwd wordt met **Laravel 12** als backend en **Inertia + React + TailwindCSS** als frontend.  
Voor het beheer (admin) gebruiken we **Filament v4** om snel CRUD-schermen te maken voor o.a. categorieën, producten en bestellingen.

Ik bouw dit project volgens de **Vertical slices workflow**: elke feature wordt 1 voor 1 afgemaakt van database → backend → frontend → admin, voordat ik naar de volgende ga.

# Techstack
## Backend
- **PHP 8.4**
- **Laravel 12**
- **Composer**
- **MySQL** (WAMP/phpMyAdmin)

## Admin (beheer)
- **Filament v4** (admin panel / CRUD)
- (Admin CRUD houden we voorlopig **Engels**, frontend wordt later volledig **Nederlands**)

## Frontend
- **Inertia.js**
- **React**
- **TypeScript**
- **Vite**
- **Tailwind CSS**

## Tooling / kwaliteit
- **ESLint**
- **Prettier**
- **Pest / PHPUnit** (tests)

## Betaalprovider (gepland)
- **Mollie** (betalingen via Mollie API)

# ProjectStructuur
### Belangrijkste mappen/bestanden
```
├── app/
│   ├── Filament/
│   │   └── Resources/
│   │       └── Categories/
│   │           ├── CategoryResource.php
│   │           ├── Pages/
│   │           │   ├── CreateCategory.php
│   │           │   ├── EditCategory.php
│   │           │   └── ListCategories.php
│   │           ├── Schemas/
│   │           │   └── CategoryForm.php
│   │           └── Tables/
│   │               └── CategoriesTable.php
│   ├── Models/
│   │   ├── Category.php
│   │   └── User.php
│   └── Providers/
│       ├── Filament/
│       │   └── AdminPanelProvider.php
│       ├── AppServiceProvider.php
│       └── FortifyServiceProvider.php
├── bootstrap/
│   ├── app.php
│   ├── providers.php
│   └── cache/
│       ├── packages.php
│       ├── services.php
│       └── ... (overige cache-bestanden)
├── config/
│   └── ... (Laravel config bestanden)
├── database/
│   ├── factories/
│   │   └── UserFactory.php
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_08_26_100418_add_two_factor_columns_to_users_table.php
│   │   └── 2025_12_19_233700_create_categories_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── public/
│   ├── index.php
│   ├── favicon.ico
│   ├── ... (public assets)
│   └── build/
│       └── ... (Vite build output)
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.tsx
│   │   ├── ssr.tsx
│   │   └── ... (React/Inertia + TypeScript)
│   └── views/
│       └── app.blade.php
├── routes/
│   ├── console.php
│   ├── web.php
│   └── ... (extra route files)
├── storage/
│   └── ... (uploads/logs/framework mappen)
├── tests/
│   └── ... (Pest/PHPUnit tests)
├── components.json
├── composer.json
├── composer.lock
├── eslint.config.js
├── package.json
├── package-lock.json
├── phpunit.xml
├── readme.md
├── tsconfig.json
└── vite.config.ts
```

### Admin voorbeeld (Category)
- `app/Filament/Resources/Categories/CategoryResource.php`
- `app/Filament/Resources/Categories/Pages/ListCategories.php`
- `app/Filament/Resources/Categories/Schemas/CategoryForm.php`
- `app/Filament/Resources/Categories/Tables/CategoriesTable.php`

# Upcoming features
## Vertical slices
We bouwen features in slices, zodat elke feature compleet werkt:

### Slice A: Categorieën
- Database tabel `categories`
- Admin CRUD (Filament): Categories beheren

### Slice B: Producten
- Producten CRUD (Filament)
- Producten tonen op frontend (lijst + detail)
- Relatie Product ↔ Categorie

### Slice C: Winkelwagen
- Winkelwagen (session-based)
- Winkelwagen UI (responsive)

### Slice D: Bestellingen
- Checkout flow
- Bestelling + orderregels opslaan in database
- Admin overzicht van bestellingen

### Slice E: Betalingen
- Payment methode(s)
- Mollie integratie (ideal/bancontact/etc.)
- Payment status verwerken en orderstatus bijwerken

## Frontend goals
- Mooie frontend met **React + Tailwind**
- **Mobile responsive** (telefoon eerst, daarna desktop)
- Publieke frontend volledig **Nederlands** (labels, knoppen, teksten)

# Admin Crud met Filament
- Categories CRUD (startpunt)
- Daarna: Products CRUD, Orders CRUD
- Admin blijft voorlopig Engels voor snelheid en consistentie met Filament defaults

# Backend -> Frontend -> Admin (hoe alles samenkomt)
- **Backend (Laravel)** beheert database, business rules en routes
- **Frontend (React/Inertia)** toont shop UI en user flows (browse, cart, checkout)
- **Admin (Filament)** beheert content (categories/products/orders) via CRUD

# Dev tools
- **Visual Studio Code**
- **Microsoft PowerShell**
- **WAMP64** (lokale PHP + MySQL)
- **phpMyAdmin** (database beheren)
- **Node.js + npm**
- **Vite** (frontend build/dev server)
- **Composer** (PHP dependency manager)
- **Git + GitHub**
- **DevTools** (inspecteren van UI/HTML/links)

# Developer Log
## 20/12/2025
- Project opgezet en stack bevestigd (Laravel 12, PHP 8.4, MySQL, React/Inertia, Vite, Tailwind, Filament).
- MySQL database `webwinkel` aangemaakt (utf8mb4).
- Migratieproblemen opgelost/onderzocht rondom MySQL key length error **1071** (index te lang bij utf8mb4), inclusief fix-aanpak met kortere indexed strings (191) en/of globale default string length.
- Filament geïnstalleerd en `Category` resource gegenereerd.
- `CategoryResource` opgeschoond naar Filament v4 signature (`Schema $schema`) + aparte `CategoryForm` en `CategoriesTable`.
- Sidebar icon type mismatch gefixt (Filament v4 gebruikt `string|BackedEnum|null`).
- Create button label (“New category”) gelokaliseerd via `ListCategories` header actions.
- Breadcrumb gedrag besproken en hoe Filament page labels vandaan komen.
- Git repo opgezet: `.gitignore` aangevuld, `git init`, eerste commit voorbereidingen, remote `origin` gekoppeld en push-problemen opgelost (remote had al commits).