DROP DATABASE IF EXISTS GroupTask;

-- Create the database
CREATE DATABASE GroupTask;

-- Create the user and grant privileges
GRANT USAGE ON *.* TO 'cst8285'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON GroupTask.* TO 'cst8285'@'localhost';
FLUSH PRIVILEGES;

-- Use the database
USE GroupTask;

-- Create the users table
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

-- Create the books table
CREATE TABLE books (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    genre VARCHAR(50),
    description TEXT,
    PRIMARY KEY (id)
);

-- Create the reviews table
CREATE TABLE reviews (
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    rating INT,
    comment TEXT
    
);

-- Create the favorites table
CREATE TABLE favorites (
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    PRIMARY KEY (user_id, book_id)
);
