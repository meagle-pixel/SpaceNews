# SpaceNews – AFPA Fil Rouge Project

*[Version française disponible ici](README.fr.md)*

![Project demo](https://i.ibb.co/0jYKb3zq/screenplanet.jpg)

## Project description

**SpaceNews** is a website dedicated to publishing news articles related to astronomy and space exploration.
This project was built as part of the **DWWM fil rouge project**, with the goal of practicing full-stack web development: front-end, PHP back-end and MySQL database.

---

## Skills covered

### HTML
- Structure a web page using semantic elements
- Organize content (headings, sections, articles, images)
- Implement clear navigation

### CSS
- Style a web interface
- Use Flexbox and/or Grid
- Manage element positioning
- Adapt the layout to different screen sizes (responsive design)

### JavaScript
- Manipulate the DOM (`querySelector`, `querySelectorAll`, `getElementById`)
- Handle user events (`addEventListener`)
- Use conditions (`if / else`)
- Use loops (`forEach`)
- Load and use JSON data (`fetch`, `.json()`)
- Dynamically filter DOM elements based on user input
- Show / hide elements dynamically (`style.display`)
- Generate HTML dynamically with `innerHTML`
- Use Promises and `async/await` for asynchronous calls

### PHP
- Build dynamic pages with PHP
- Handle forms (POST, validation, security)
- Manage user sessions (`$_SESSION`)
- Implement an authentication system (login / logout)
- Handle user registration with password hashing (`password_hash`)
- Verify passwords securely (`password_verify`)
- Upload and manage image files server-side
- Secure data with `htmlspecialchars()`
- Apply the PRG pattern (Post-Redirect-Get) to prevent double submissions
- Use `header()` for redirects
- Include reusable files (`require_once`) for header, footer and database
- Manage success/error messages via sessions
- Use Composer for dependency management

### MySQL & PDO
- Design and structure a relational database
- Write SQL queries (SELECT, INSERT, UPDATE, DELETE)
- Use PDO with prepared statements to prevent SQL injections
- Manage transactions (`beginTransaction`, `commit`, `rollBack`)
- Manage relationships between tables (articles ↔ categories via junction table)
- Use `lastInsertId()` to retrieve the id of a newly inserted record
- Dynamically filter data with conditional WHERE clauses
- Use `fetchAll()` and `fetch()` with `PDO::FETCH_ASSOC`

---

## Features

### Public area
- **Article listing**: paginated list of published articles with summary and image
- **Article detail**: dedicated page with full content, category and date
- **Dynamic filtering**: filter articles by category using JavaScript
- **Interactive planetarium**: visual interface dedicated to space exploration
- **Planet sorting**: dynamic filtering of celestial bodies via a JSON file
- **Responsive design**: interface adapted for desktop and mobile

### Administration area (restricted access)
- **Authentication**: secure login / logout with PHP sessions
- **Article management**: full CRUD (create, read, update, delete)
- **Image upload**: add an image to each article (JPG, PNG, WEBP)
- **Category management**: associate categories to articles
- **DB transactions**: secure multiple inserts with rollback on error

---

## Tech stack

| Technology | Usage |
|---|---|
| HTML / CSS | Structure and styling |
| JavaScript | Dynamic filters, DOM |
| PHP 8 | Back-end, business logic |
| MySQL | Database |
| PDO | Secure database access |
| Docker | Local environment (LAMP) |
| AlwaysData | Online hosting |

---

## Local installation

### Prerequisites
- [Docker Desktop](https://www.docker.com) installed
- Git installed

### Steps

1. **Clone the repository**
```bash
git clone https://github.com/meagle-pixel/SpaceNews.git
cd SpaceNews
```

2. **Configure the environment**
   - Copy `.env.example` to `.env`
   - Fill in your database credentials:
```
DB_HOST=mysql
DB_NAME=spacenews
DB_USER=root
DB_PASS=yourpassword
```

3. **Start the Docker containers**
```bash
docker-compose up -d
```

4. **Import the database**
   - Open phpMyAdmin at `http://localhost:8080`
   - Create a database named `spacenews`
   - Import `SQL/bdd.sql`

5. **Access the application**
   - Public site: `http://localhost/SpaceNews`
   - Admin panel: `http://localhost/SpaceNews/admin/articlesAdmin.php`

### Test credentials
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@spacenews.fr | yourpassword |

---

## Deployment
- Live site: https://maximepau.alwaysdata.net/index.php
- Repository: https://github.com/meagle-pixel/SpaceNews.git

---

## Project structure

```text
SPACENEWS/
├── admin/
│   ├── article-create.php
│   ├── article-delete.php
│   ├── article-edit.php
│   ├── articlesAdmin.php
│   └── auth-check.php
├── css/
│   └── style.css
├── images/
├── includes/
│   ├── db.php
│   ├── footer.php
│   └── header.php
├── js/
│   ├── data/
│   └── index.js
├── SQL/
│   └── bdd.sql
├── vendor/
├── articles.php
├── connexion.php
├── deconnexion.php
├── details.php
├── index.php
├── inscription.php
├── ssolaire.php
├── .env.example
├── .gitignore
├── composer.json
├── composer.lock
├── docker-compose.yml
├── Dockerfile.php
├── robots.txt
└── README.md
```

---

## Screenshots

### Article form

![Form](https://i.ibb.co/zTn00Snh/formulaire.png)

---

### Planetarium

![Planetarium](https://i.ibb.co/gZVDcdqc/planetarium.png)

---

### Planet filter

![Planet filter](https://i.ibb.co/23xwVFD4/filtre.png)

---

## Author

Maxime Paulin – DWWM cohort 2025–2026

---

*Created for the DWWM training – Professional Title Level 5*
*RNCP37674 – Version 2026*

