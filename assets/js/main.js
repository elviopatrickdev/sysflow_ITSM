// ==============================
// NAV MOBILE
// ==============================

const toggle = document.getElementById("menu-toggle");
const nav = document.getElementById("nav");
const closeMenu = document.getElementById("close-menu");

toggle.addEventListener("click", () => {
    nav.classList.add("active");
});

closeMenu.addEventListener("click", () => {
    nav.classList.remove("active");
});

// ==============================
// MODAL CRIAR TICKET
// ==============================

function openCreateModal() {

    document.getElementById("createModal").classList.add("active");

}

function closeCreateModal() {

    document.getElementById("createModal").classList.remove("active");

}

// ==============================
// FECHAR MODAL CLICANDO FORA
// ==============================

window.onclick = function (event) {

    const createModal = document.getElementById("createModal");

    if (event.target === createModal) {

        createModal.classList.remove("active");

    }

};