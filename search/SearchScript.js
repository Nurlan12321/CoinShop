
function toggleSearchBar() {
    const searchBar = document.querySelector('.search-bar');
    searchBar.classList.toggle('visible');
}

function performSearch() {
    const query = document.getElementById('search-input').value;
    window.location.href = `index.php?search=${query}`;
}

function goToMainPage() {
    window.location.href = `index.php`;
}
