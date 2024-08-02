/*
    Author: SHOUJUN ZHAO
    File Name: manage_books.js
    Date: August 1, 2024
    Description: Assignment 2, adding the JavaScript to display books in a Book Cataloging System
*/

document.addEventListener('DOMContentLoaded', () => {
    // Handle form submission for adding a new book
    const addBookForm = document.getElementById('addBookForm');
    if (addBookForm) {
        addBookForm.addEventListener('submit', (e) => {
            e.preventDefault(); // Prevent the default form submission
            const formData = new FormData(addBookForm); // Get form data
            fetch('add_book.php', {
                method: 'POST',
                body: new URLSearchParams(formData) // Send form data as URL-encoded string
            })
            .then(response => response.text()) // Parse the response text
            .then(message => {
                alert(message); // Display the response message
                location.href = 'manage_books.php'; // Redirect to the book list page
            });
        });
    }

    // Handle form submission for editing a book
    const editBookForm = document.getElementById('editBookForm');
    if (editBookForm) {
        editBookForm.addEventListener('submit', (e) => {
            e.preventDefault(); // Prevent the default form submission
            const formData = new FormData(editBookForm); // Get form data
            fetch('edit_book.php', {
                method: 'POST',
                body: new URLSearchParams(formData) // Send form data as URL-encoded string
            })
            .then(response => response.text()) // Parse the response text
            .then(message => {
                alert(message); // Display the response message
                location.href = 'manage_books.php'; // Redirect to the book list page
            });
        });
    }

    // Handle form submission for deleting a book
    const deleteBookForms = document.querySelectorAll('form[action="delete_book.php"]');
    deleteBookForms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault(); // Prevent the default form submission
            if (confirm('Are you sure you want to delete this book?')) {
                const formData = new FormData(form); // Get form data
                fetch('delete_book.php', {
                    method: 'POST',
                    body: new URLSearchParams(formData) // Send form data as URL-encoded string
                })
                .then(response => response.text()) // Parse the response text
                .then(message => {
                    alert(message); // Display the response message
                    location.href = 'manage_books.php'; // Redirect to the book list page
                });
            }
        });
    });
});

