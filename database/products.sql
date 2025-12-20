-- Products Database Tables
-- Categories and Products
USE tech_store;
-- Categories Table
CREATE TABLE categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    slug VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
-- Products Table
CREATE TABLE products (
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
-- Sample Categories
INSERT INTO categories (name, slug)
VALUES ('لابتوب', 'laptops'),
    ('كمبيوتر مكتبي', 'desktops'),
    ('شاشات', 'monitors'),
    ('الملحقات', 'accessories');
-- Sample Products
INSERT INTO products (
        name,
        slug,
        description,
        price,
        category_id,
        image_url,
        stock
    )
VALUES (
        'Laptop Dell XPS 15',
        'dell-xps-15',
        'لابتوب Dell XPS 15 بمعالج Intel Core i7، 16GB RAM، 512GB SSD، شاشة 15.6 بوصة',
        1299.99,
        1,
        'assets/images/laptop-dell.jpg',
        15
    ),
    (
        'Gaming PC RTX 4070',
        'gaming-pc-rtx-4070',
        'جهاز كمبيوتر للألعاب بمعالج AMD Ryzen 7، كرت شاشة RTX 4070، 32GB RAM',
        1899.00,
        2,
        'assets/images/gaming-pc.jpg',
        8
    ),
    (
        'Monitor LG 27 4K',
        'lg-monitor-27-4k',
        'شاشة LG 27 بوصة بدقة 4K، HDR10، معدل تحديث 144Hz',
        449.99,
        3,
        'assets/images/monitor-lg.jpg',
        25
    ),
    (
        'Logitech MX Master 3S',
        'logitech-mx-master-3s',
        'ماوس لاسلكي احترافي من Logitech بـ 8 أزرار قابلة للبرمجة',
        99.99,
        4,
        'assets/images/mouse-logitech.jpg',
        50
    ),
    (
        'Keychron K8 Pro',
        'keychron-k8-pro',
        'لوحة مفاتيح ميكانيكية لاسلكية، Hot-Swappable، RGB Backlight',
        159.99,
        4,
        'assets/images/keyboard-keychron.jpg',
        30
    ),
    (
        'MacBook Pro M3',
        'macbook-pro-m3',
        'MacBook Pro 14 بمعالج M3 Pro، 18GB RAM، 512GB SSD',
        2499.00,
        1,
        'assets/images/macbook-pro.jpg',
        12
    );