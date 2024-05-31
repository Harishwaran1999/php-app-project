CREATE DATABASE bookstore;
USE bookstore;
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    published_year INT,
    price DECIMAL(10,2)
);

INSERT INTO books (title, author, published_year, price) 
VALUES ('The Great Gatsby', 'F. Scott Fitzgerald', 1925, 12.99),
       ('To Kill a Mockingbird', 'Harper Lee', 1960, 10.50);
