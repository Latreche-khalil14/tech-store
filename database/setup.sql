-- Tech Store - Complete Setup Script
DROP DATABASE IF EXISTS tech_store;
CREATE DATABASE tech_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tech_store;
-- 1. Users Table
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    role ENUM('admin', 'customer') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;
-- 2. Categories Table
CREATE TABLE IF NOT EXISTS categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    slug VARCHAR(100) NOT NULL UNIQUE
) ENGINE = InnoDB;
-- 3. Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category_id INT UNSIGNED,
    image_url VARCHAR(255),
    stock INT UNSIGNED DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE
    SET NULL
) ENGINE = InnoDB;
-- 4. Orders Table
CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM(
        'pending',
        'processing',
        'shipped',
        'delivered',
        'cancelled'
    ) DEFAULT 'pending',
    shipping_address TEXT NOT NULL,
    payment_method VARCHAR(50) DEFAULT 'COD',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE = InnoDB;
-- 5. Order Items Table
CREATE TABLE IF NOT EXISTS order_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE = InnoDB;
-- Default Data
INSERT IGNORE INTO users (username, email, password, full_name, role)
VALUES (
        'admin',
        'admin@techstore.com',
        '$2y$10$hkhCbYyjs3hiikxCSK8.JuX50nTwUqXgxUIR5NYvKcK0sVi5A.u0W',
        'المدير العام',
        'admin'
    );
INSERT IGNORE INTO categories (name, slug)
VALUES ('لابتوب', 'laptops'),
    ('كمبيوتر مكتبي', 'desktops'),
    ('شاشات', 'monitors'),
    ('الملحقات', 'accessories');
INSERT IGNORE INTO products (
        name,
        slug,
        description,
        price,
        category_id,
        stock,
        image_url
    )
VALUES (
        'Laptop Dell XPS 15',
        'dell-xps-15',
        'لابتوب احترافي بمعالج i7 و 16GB RAM',
        1299.99,
        1,
        10,
        'assets/images/placeholder.jpg'
    ),
    (
        'Gaming PC RTX 4070',
        'gaming-pc-rtx-4070',
        'كمبيوتر ألعاب جبار للأداء العالي',
        1899.00,
        2,
        5,
        'assets/images/placeholder.jpg'
    ),
    (
        'Monitor LG 27 4K',
        'lg-monitor-27-4k',
        'شاشة مذهلة بدقة 4K',
        449.99,
        3,
        20,
        'assets/images/placeholder.jpg'
    );