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
// MODAL VER TICKET (AJAX)
// ==============================

function loadTicket(id) {

    fetch("../api/get_ticket.php?id=" + id)

        .then(response => response.json())

        .then(data => {

            const modal = document.getElementById("viewModal");

            modal.classList.add("active");

            document.getElementById("ticketId").innerText = data.id;
            document.getElementById("ticketTitle").innerText = data.title;
            document.getElementById("ticketDesc").innerText = data.description;
            document.getElementById("ticketPriority").innerText = data.priority;
            document.getElementById("ticketStatus").innerText = data.status;

            document.getElementById("updateId").value = data.id;

        })

        .catch(error => {

            console.error("Erro ao carregar ticket:", error);

        });

}


// ==============================
// FECHAR MODAL VIEW
// ==============================

function closeViewModal() {

    document.getElementById("viewModal").classList.remove("active");

}


// ==============================
// FECHAR MODAL CLICANDO FORA
// ==============================

window.onclick = function (event) {

    const createModal = document.getElementById("createModal");
    const viewModal = document.getElementById("viewModal");

    if (event.target === createModal) {

        createModal.classList.remove("active");

    }

    if (event.target === viewModal) {

        viewModal.classList.remove("active");

    }

};