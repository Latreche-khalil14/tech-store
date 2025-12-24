# 🚀 TechStore - Modern E-Commerce Solution

[![Version](https://img.shields.io/badge/version-2.0.0-blue.svg)](https://github.com/Latreche-khalil14/tech-store)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-8.x-purple.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-DB-orange.svg)](https://www.mysql.com/)

**TechStore** is a state-of-the-art, high-performance e-commerce platform dedicated to high-end technology products. Built with a focus on user experience (UX), modern aesthetics, and modular architecture, it provides a seamless shopping journey from discovery to checkout.

---

## ✨ Key Features

- **💎 Premium UI/UX:** Responsive design using Tailwind CSS with glassmorphism effects and smooth animations (AOS & tsParticles).
- **🛒 Advanced Cart System:** Real-time cart management using `localStorage` with persistence across sessions.
- **🔐 Secure Authentication:** Robust login/registration system with session management and account protection.
- **📦 Order Management:** Seamless checkout process with automated order creation and validation.
- **⚙️ Dynamic Product Catalog:** Category-based filtering, real-time search, and optimized product loading via AJAX.
- **🛠️ Admin Dashboard:** Centralized control panel for managing products, monitoring orders, and site configurations.
- **🔗 Modular API:** Decoupled Backend-as-a-Service (BaaS) architecture for better scalability and developer collaboration.

---

## 🛠️ Technology Stack

| Layer | Technologies |
| :--- | :--- |
| **Frontend** | HTML5, Tailwind CSS, JavaScript (ES6+), jQuery, AOS, SweetAlert2 |
| **Backend** | PHP (OOP principles), PDO for secure DB interaction |
| **Database** | MySQL |
| **Animations** | tsParticles, Tailwind Animations |

---

## 📂 Project Structure

The project is structured to support parallel development for a 3-person team:

```text
tech-store2/
├── admin/           # Administrative Dashboard (Specialist: Admin/Config)
├── api/             # RESTful API Endpoints (Specialist: Backend/API)
├── config/          # Project Configuration & Helpers (Specialist: Admin/Config)
├── database/        # SQL Migrations & Database Scripts
├── frontend/        # Main User Interface & Client Experience (Specialist: Frontend)
│   ├── assets/      # CSS, JS, & Media files
│   ├── includes/    # PHP Layout Components (Header/Footer)
│   └── ...          # Store Pages (Index, Products, Cart, Checkout)
└── index.php        # Entry point redirector
```

---

## 🚀 Quick Setup (local)

### Prerequisites
- PHP >= 8.0
- MySQL Server
- XAMPP / WampServer / Laravel Herd

### Installation Steps
1. **Clone the repository:**
   ```bash
   git clone https://github.com/Latreche-khalil14/tech-store.git
   ```
2. **Setup Database:**
   - Open PHPMyAdmin.
   - Create a database named `tech_store`.
   - Import the `database/setup.sql` file.
3. **Configuration:**
   - Navigate to `config/database.php`.
   - Update your database credentials (DB_HOST, DB_USER, DB_PASS).
4. **Run Project:**
   - Move the folder to your `htdocs` or `www` directory.
   - Access `http://localhost/tech_store2/` in your browser.

---

## 👥 Team Responsibilities

This project follows a conflict-free "Copy-Paste" workflow designed for team efficiency:

- **👤 Specialist 1 (Frontend):** Owns the `frontend/` directory. Focuses on UI/UX, product cards, and API integration.
- **👤 Specialist 2 (Backend):** Owns the `api/` and `database/` directories. Focuses on data processing and database integrity.
- **👤 Specialist 3 (Admin):** Owns the `admin/` and `config/` directories. Focuses on the management panel and global helper functions.

---

## 📝 Roadmap

- [x] Modern UI redesign with Tailwind CSS.
- [x] Modular directory restructuring.
- [x] AJAX-based product loading & filtering.
- [x] Secure order checkout flow.
- [ ] User profile and order history.
- [ ] Payment gateway integration (Stripe/PayPal).
- [ ] Dark Mode Support.

---

## 📄 License
Distributed under the MIT License. See `LICENSE` for more information.

---

## 📧 Support
For support, email `support@techstore.com` or open an issue in the repository.

---
*Created with ❤️ by the TechStore Team.*