CREATE DATABASE IF NOT EXISTS campusbook CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE campusbook;
CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL UNIQUE, password_hash VARCHAR(255) NOT NULL, role ENUM('student','admin') NOT NULL DEFAULT 'student');
CREATE TABLE IF NOT EXISTS books (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(180) NOT NULL, author VARCHAR(120) NOT NULL, category VARCHAR(80) NOT NULL, total_copies INT NOT NULL DEFAULT 1, available_copies INT NOT NULL DEFAULT 1, CHECK(total_copies >= 0), CHECK(available_copies >= 0));
CREATE TABLE IF NOT EXISTS reservations (id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, book_id INT NOT NULL, reserved_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, status ENUM('active','cancelled') NOT NULL DEFAULT 'active', FOREIGN KEY (user_id) REFERENCES users(id), FOREIGN KEY (book_id) REFERENCES books(id));
INSERT INTO books (title,author,category,total_copies,available_copies) VALUES
('Ingeniería de software','Ian Sommerville','Ingeniería',5,5),('Clean Code','Robert C. Martin','Programación',3,3),('Diseño de bases de datos','Carlos Coronel','Bases de datos',4,4),('Patrones de diseño','Gamma y colaboradores','Programación',2,2),('Introducción a los algoritmos','Cormen y colaboradores','Algoritmos',6,6);
