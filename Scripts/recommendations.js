// Function to fetch a new book from the server
function fetchNewBook() {
    fetch('../server/fetch_book.php')  
        .then(response => response.json())
        .then(data => {
            if (data && data.title) {
                document.querySelector('.book-title').textContent = data.title;
                document.querySelector('.book-author').textContent = data.author;
                document.querySelector('.book-genre').textContent = data.genre;
                document.querySelector('.book-description').textContent = data.description;
            } else {
                console.error('Invalid book data received.');
            }
        })
        .catch(error => console.error('Error fetching new book:', error));
}

// Fetch a new book when the page loads
document.addEventListener('DOMContentLoaded', () => {
    fetchNewBook();
});
