-- Simply Suits Database Creation Script
-- This script creates the database and all required tables

-- Create the database
CREATE DATABASE IF NOT EXISTS simply_suits_db;
USE simply_suits_db;

-- Drop tables if they exist (in reverse order of dependencies)
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS sizes;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS AuthorizedUsers;

-- Table 1: users
-- Stores customer account information (customers only, no admin roles)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NULL,
    updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table 2: categories
-- Stores product categories for dropdown lists
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) UNIQUE NOT NULL,
    description TEXT NULL,
    display_order INT NULL DEFAULT 0,
    INDEX idx_category_name (category_name),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table 3: sizes
-- Stores available product sizes for dropdown lists
CREATE TABLE sizes (
    size_id INT AUTO_INCREMENT PRIMARY KEY,
    size_value VARCHAR(20) NOT NULL,
    size_type VARCHAR(50) NOT NULL DEFAULT 'clothing',
    description VARCHAR(255) NULL,
    display_order INT NULL DEFAULT 0,
    INDEX idx_size_type (size_type),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table 4: AuthorizedUsers
-- Stores authorized usernames and passwords for login authentication
CREATE TABLE AuthorizedUsers (
    username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table 5: orders
-- Stores customer order information (simplified)
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    INDEX idx_user_id (user_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data for categories
INSERT INTO categories (category_name, description, display_order) VALUES
('Formal Suits', 'Classic formal suits for business and special occasions', 1),
('Business Casual', 'Professional yet comfortable business casual wear', 2),
('Plus Size', 'Extended sizes for a perfect fit', 3),
('Sweaters', 'Warm and stylish sweaters', 4),
('Winter Gear', 'Cold weather essentials', 5),
('Shirts', 'Dress shirts and casual shirts', 6),
('Accessories', 'Ties, belts, and other accessories', 7);

-- Insert sample data for sizes
INSERT INTO sizes (size_value, size_type, description, display_order) VALUES
('XS', 'clothing', 'Extra Small', 1),
('S', 'clothing', 'Small', 2),
('M', 'clothing', 'Medium', 3),
('L', 'clothing', 'Large', 4),
('XL', 'clothing', 'Extra Large', 5),
('XXL', 'clothing', 'Double Extra Large', 6),
('36', 'shoes', 'US Size 6', 1),
('37', 'shoes', 'US Size 7', 2),
('38', 'shoes', 'US Size 8', 3),
('39', 'shoes', 'US Size 9', 4),
('40', 'shoes', 'US Size 10', 5),
('41', 'shoes', 'US Size 11', 6),
('42', 'shoes', 'US Size 12', 7),
('S', 'accessories', 'Small Accessory', 1),
('M', 'accessories', 'Medium Accessory', 2),
('L', 'accessories', 'Large Accessory', 3);

-- Insert sample users
INSERT INTO users (username, password, phone) VALUES
('john_doe', 'password123', '555-0101'),
('jane_smith', 'password123', '555-0102'),
('bob_jones', 'password123', '555-0103');

-- Insert sample AuthorizedUsers for login
INSERT INTO AuthorizedUsers (username, password) VALUES
('admin', 'admin123'),
('john_doe', 'password123'),
('jane_smith', 'password123');

-- Display success message
SELECT 'Database and tables created successfully!' AS Message;


