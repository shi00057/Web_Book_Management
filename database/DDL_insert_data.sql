-- Insert data into the users table
INSERT INTO users (username, email, password) VALUES
('user1', 'user1@example.com', 'password1'),
('user2', 'user2@example.com', 'password2'),
('user3', 'user3@example.com', 'password3'),
('user4', 'user4@example.com', 'password4'),
('user5', 'user5@example.com', 'password5'),
('user6', 'user6@example.com', 'password6'),
('user7', 'user7@example.com', 'password7'),
('user8', 'user8@example.com', 'password8'),
('user9', 'user9@example.com', 'password9'),
('user10', 'user10@example.com', 'password10');

-- Insert data into the books table
INSERT INTO books (title, author, genre, description) VALUES
('Book Title 1', 'Author 1', 'Fiction', 'Description for Book 1'),
('Book Title 2', 'Author 2', 'Non-Fiction', 'Description for Book 2'),
('Book Title 3', 'Author 3', 'Science Fiction', 'Description for Book 3'),
('Book Title 4', 'Author 4', 'Fantasy', 'Description for Book 4'),
('Book Title 5', 'Author 5', 'Mystery', 'Description for Book 5'),
('Book Title 6', 'Author 6', 'Biography', 'Description for Book 6'),
('Book Title 7', 'Author 7', 'History', 'Description for Book 7'),
('Book Title 8', 'Author 8', 'Romance', 'Description for Book 8'),
('Book Title 9', 'Author 9', 'Horror', 'Description for Book 9'),
('Book Title 10', 'Author 10', 'Adventure', 'Description for Book 10');

-- Insert data into the reviews table
INSERT INTO reviews (user_id, book_id, rating, comment) VALUES
(1, 1, 5, 'Excellent book!'),
(2, 2, 4, 'Very informative.'),
(3, 3, 3, 'It was okay.'),
(4, 4, 2, 'Not my favorite.'),
(5, 5, 1, 'I did not like it.'),
(6, 6, 5, 'Absolutely loved it!'),
(7, 7, 4, 'Great read!'),
(8, 8, 3, 'It was fine.'),
(9, 9, 2, 'Could be better.'),
(10, 10, 1, 'Not worth my time.');

-- Insert data into the favorites table
INSERT INTO favorites (user_id, book_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);
