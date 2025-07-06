CREATE DATABASE IF NOT EXISTS library;
CREATE USER 'librarian'@'%' IDENTIFIED BY 'library123';
GRANT ALL PRIVILEGES ON library.* TO 'librarian'@'%';
USE library;

CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255),
    year INT
);

INSERT INTO books (title, author, year) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', 1925),
('To Kill a Mockingbird', 'Harper Lee', 1960),
('1984', 'George Orwell', 1949),
('Pride and Prejudice', 'Jane Austen', 1813),
('The Art of Exploitation', NULL, NULL),
('Web Hacking 101', NULL, NULL),
('SQL Injection for Dummies', NULL, NULL);
