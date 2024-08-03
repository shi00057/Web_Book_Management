// Name: Guokai Shi
// File Name: recommendations.js
// Date Created: 2024-07-18
// Description: This JavaScript file handles fetching and displaying new book recommendations.
document.addEventListener('DOMContentLoaded', () => {
    // Function to fetch a new book from the server
    window.fetchNewBook = function() {
        fetch('../server/fetch_book.php')
            .then(response => response.json())
            .then(data => {
                if (data && data.title) {
                    document.getElementById('book-title').textContent = data.title;
                    document.getElementById('book-author').textContent = data.author;
                    document.getElementById('book-genre').textContent = data.genre;
                    document.getElementById('book-description').textContent = data.description;
                    document.getElementById('view-details').setAttribute('href', `detail.php?book_id=${data.id}`);
                } else {
                    console.error('Invalid book data received.');
                }
            })
            .catch(error => console.error('Error fetching new book:', error));
    }
});
