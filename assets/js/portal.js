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

// MODAL CRIAR
function openCreateRequestModal(){ document.getElementById("createRequestModal").classList.add("active"); }
function closeCreateRequestModal(){ document.getElementById("createRequestModal").classList.remove("active"); }

// MODAL VER
function openViewRequestModal(){ document.getElementById("viewRequestModal").classList.add("active"); }
function closeViewRequestModal(){ document.getElementById("viewRequestModal").classList.remove("active"); }

// FECHAR CLICANDO FORA
window.addEventListener("click", function(e){
    if(e.target === document.getElementById("createRequestModal")) closeCreateRequestModal();
    if(e.target === document.getElementById("viewRequestModal")) closeViewRequestModal();
});

// CARREGAR DADOS VIA AJAX
function loadRequest(id){
    fetch("../api/get_request.php?id="+id)
    .then(r=>r.json())
    .then(data=>{
        document.getElementById("requestId").innerText = data.id;
        document.getElementById("requestType").innerText = data.type;
        document.getElementById("requestDesc").innerText = data.description;
        document.getElementById("requestStatus").innerText = data.status;
        document.getElementById("updateId").value = data.id;
        openViewRequestModal();
    });
}

// APROVAR / REJEITAR
function approveRequest(id){ fetch("../actions/approve_request.php?id="+id).then(()=>location.reload()); }
function rejectRequest(id){ fetch("../actions/reject_request.php?id="+id).then(()=>location.reload()); }