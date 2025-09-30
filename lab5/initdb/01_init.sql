CREATE DATABASE IF NOT EXISTS guitarshop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE guitarshop;

CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT NOT NULL,
  code VARCHAR(50) NOT NULL,
  name VARCHAR(255) NOT NULL,
  listPrice DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO categories (name) VALUES ('Guitars') ON DUPLICATE KEY UPDATE name=name;

INSERT INTO products (category_id, code, name, listPrice)
SELECT c.id, 'test1', 'Test Product 2211', 550.00 FROM categories c WHERE c.name='Guitars'
ON DUPLICATE KEY UPDATE name=VALUES(name);
