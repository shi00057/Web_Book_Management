-- Use the GroupTask database
USE GroupTask;

-- Insert data into the users table
INSERT INTO users (username, email, password) VALUES
('john_doe', 'john@example.com', 'password123'),
('jane_smith', 'jane@example.com', 'password456'),
('alice_johnson', 'alice@example.com', 'password789'),
('bob_brown', 'bob@example.com', 'password000'),
('charlie_davis', 'charlie@example.com', 'password111'),
('user1', 'user1@example.com', 'password1'),
('user2', 'user2@example.com', 'password2'),
('user3', 'user3@example.com', 'password3'),
('user4', 'user4@example.com', 'password4'),
('user5', 'user5@example.com', 'password5');

-- Insert data into the books table with six distinct genres
INSERT INTO books (title, author, genre, description) VALUES
('To Kill a Mockingbird', 'Harper Lee', 'Fiction', 'A novel about the serious issues of rape and racial inequality.'),
('1984', 'George Orwell', 'Science Fiction', 'A dystopian social science fiction novel and cautionary tale.'),
('Pride and Prejudice', 'Jane Austen', 'Romance', 'A romantic novel of manners written by Jane Austen.'),
('The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', 'A novel about the American dream and the Roaring Twenties.'),
('The Hobbit', 'J.R.R. Tolkien', 'Fantasy', 'A fantasy novel and children\'s book by J.R.R. Tolkien.'),
('The Da Vinci Code', 'Dan Brown', 'Mystery', 'A mystery thriller novel that explores themes of religion and conspiracy.'),
('Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Non-Fiction', 'An exploration of the history of the human species from prehistory to modern times.'),
('Dune', 'Frank Herbert', 'Science Fiction', 'A science fiction novel set in a distant future amidst a huge interstellar empire.'),
('The Name of the Wind', 'Patrick Rothfuss', 'Fantasy', 'A heroic fantasy novel that is the first book in The Kingkiller Chronicle series.'),
('Gone Girl', 'Gillian Flynn', 'Mystery', 'A thriller novel exploring the complexities of a modern marriage.');

-- Insert data into the reviews table
INSERT INTO reviews (user_id, book_id, rating, comment) VALUES
(1, 1, 5, 'An amazing read, very moving.'),
(2, 2, 4, 'A bit dark but very insightful.'),
(3, 3, 5, 'A timeless classic!'),
(1, 4, 4, 'Interesting story about the American dream.'),
(4, 5, 5, 'A wonderful adventure.'),
(5, 6, 3, 'Quite thrilling, but not my favorite.'),
(2, 7, 5, 'A very informative book.'),
(3, 8, 4, 'A rich and complex story.'),
(1, 9, 5, 'Absolutely captivating.'),
(4, 10, 4, 'A gripping psychological thriller.');

-- Insert data into the favorites table
INSERT INTO favorites (user_id, book_id) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10);

-- Insert data into the book_shelf table
INSERT INTO book_shelf (user_id, book_id) VALUES
(1, 3),
(1, 5),
(2, 1),
(2, 2),
(2, 6),
(3, 4),
(3, 8),
(4, 9),
(4, 10),
(5, 7);
