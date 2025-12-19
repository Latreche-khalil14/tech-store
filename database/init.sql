CREATE DATABASE IF NOT EXISTS tech_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tech_store;
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    role ENUM('admin', 'customer') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Admin user (email: admin@techstore.com, password: admin123)
INSERT INTO users (username, email, password, full_name, role)
VALUES (
        'admin',
        'admin@techstore.com',
        '$2y$10$hkhCbYyjs3hiikxCSK8.JuX50nTwUqXgxUIR5NYvKcK0sVi5A.u0W',
        'المدير',
        'admin'
    );