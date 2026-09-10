// Render profile details from JWT
const payload = Auth.getUserPayload();
if (payload) {
    document.getElementById('userName').innerText = payload.name || 'N/A';
    document.getElementById('userEmail').innerText = payload.email || 'N/A';
    document.getElementById('userId').innerText = payload.user_id || 'N/A';
}

// Fetch all books
async function loadBooks() {
    const booksContainer = document.getElementById('booksContainer');
    const res = await apiRequest('/books', 'GET');

    if (res.ok && res.data.data) {
        const books = res.data.data;
        if (books.length === 0) {
            booksContainer.innerHTML = '<p>No books available yet.</p>';
            return;
        }

        booksContainer.innerHTML = books.map(book => `
            <div class="book-item">
                <div>
                    <h4>${escapeHtml(book.title)}</h4>
                    <p>By ${escapeHtml(book.author)}</p>
                </div>
                <div>
                    ${book.owner_id === payload.user_id ? 
                        `<button class="btn-danger" onclick="deleteBook(${book.id})">Delete</button>` : 
                        `<small style="color:#94a3b8">Owner: ${escapeHtml(book.owner_name || 'User')}</small>`
                    }
                </div>
            </div>
        `).join('');
    } else {
        booksContainer.innerHTML = '<p>Failed to load books catalog.</p>';
    }
}

// Handle Add Book
document.getElementById('addBookForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const title = document.getElementById('bookTitle').value;
    const author = document.getElementById('bookAuthor').value;
    const bookError = document.getElementById('bookError');

    bookError.style.display = 'none';

    const res = await apiRequest('/books', 'POST', { title, author });

    if (res.ok) {
        document.getElementById('addBookForm').reset();
        loadBooks();
    } else {
        bookError.innerText = res.data.error || 'Could not create book.';
        bookError.style.display = 'block';
    }
});

// Handle Delete Book
async function deleteBook(id) {
    if (!confirm('Are you sure you want to delete this book?')) return;

    const res = await apiRequest(`/books?id=${id}`, 'DELETE');
    if (res.ok) {
        loadBooks();
    } else {
        alert(res.data.error || 'Could not delete book');
    }
}

function escapeHtml(str) {
    return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
}

// Initial Load
loadBooks();