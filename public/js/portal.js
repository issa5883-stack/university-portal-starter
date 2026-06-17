// ══════════════════════════════
// UNIVERSITY PORTAL — portal.js
// ══════════════════════════════

// ── Footer Profile Dropdown ──
function toggleFooterMenu() {
    const menu    = document.getElementById('footerMenu');
    const chevron = document.getElementById('footerChevron');
    const isOpen  = menu.classList.contains('show');
    menu.classList.toggle('show', !isOpen);
    chevron.className = isOpen
        ? 'bi bi-chevron-up ms-1'
        : 'bi bi-chevron-down ms-1';
}

document.addEventListener('click', function(e) {
    const btn  = document.getElementById('footerProfileBtn');
    const menu = document.getElementById('footerMenu');
    if (btn && !btn.contains(e.target) && menu && !menu.contains(e.target)) {
        menu.classList.remove('show');
        document.getElementById('footerChevron').className = 'bi bi-chevron-up ms-1';
    }
});

// ── Password Toggle (Login Page) ──
function togglePassword() {
    const field = document.getElementById('passwordField');
    const icon  = document.getElementById('eyeIcon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        field.type = 'password';
        icon.className = 'bi bi-eye';
    }
}