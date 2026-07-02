// ══════════════════════════════
// UNIVERSITY PORTAL — app.js
// ══════════════════════════════

// ── Navbar search: live-filters the table on the current page ──
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('portalSearch');
    const table = document.querySelector('.portal-table');
    if (!input || !table) return;

    input.addEventListener('input', function () {
        const term = input.value.trim().toLowerCase();

        table.querySelectorAll('tbody tr').forEach(function (row) {
            const matches = row.textContent.toLowerCase().includes(term);
            row.style.display = matches ? '' : 'none';
        });
    });
});

// ── Searchable dropdown: type a name into a text input (backed by a
//    <datalist>) and we map the typed text back to its real ID in a
//    hidden field, so the form still submits student_id / course_id. ──
function bindSearchableSelect(searchId, hiddenId, listId) {
    const search = document.getElementById(searchId);
    const hidden = document.getElementById(hiddenId);
    const list = document.getElementById(listId);
    if (!search || !hidden || !list) return;

    const options = Array.from(list.querySelectorAll('option'));

    search.addEventListener('input', function () {
        const typed = search.value.trim().toLowerCase();
        const match = options.find(opt => opt.value.toLowerCase() === typed);
        hidden.value = match ? match.dataset.id : '';
    });
}
