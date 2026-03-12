<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=utf-8');

include("../config/database.php");

if (!$conn) { 
    echo json_encode(["error" => "Database connection failed"]); 
    exit; 
}

/* =========================
   KPI TICKETS
========================= */

// Total tickets
$resTotal = mysqli_query($conn, "SELECT COUNT(*) as total FROM tickets");
$totalTickets = mysqli_fetch_assoc($resTotal)['total'];

// Tickets abertos
$resOpen = mysqli_query($conn, "SELECT COUNT(*) as total FROM tickets WHERE LOWER(status) = 'aberto'");
$openTickets = mysqli_fetch_assoc($resOpen)['total'];

// Tickets em progresso
$resProgress = mysqli_query($conn, "SELECT COUNT(*) as total FROM tickets WHERE LOWER(status) = 'em progresso'");
$progressTickets = mysqli_fetch_assoc($resProgress)['total'];

// Tickets resolvidos
$resResolved = mysqli_query($conn, "SELECT COUNT(*) as total FROM tickets WHERE LOWER(status) = 'resolvido'");
$resolvedTickets = mysqli_fetch_assoc($resResolved)['total'];

/* =========================
   PRIORIDADES
========================= */

// Prioridade Alta
$resHigh = mysqli_query($conn, "SELECT COUNT(*) as total FROM tickets WHERE LOWER(priority) = 'alta'");
$highPriority = mysqli_fetch_assoc($resHigh)['total'];

// Prioridade Média (normalizado)
$resMedium = mysqli_query($conn, "SELECT COUNT(*) as total FROM tickets WHERE LOWER(priority) = 'média' OR LOWER(priority) = 'media'");
$mediumPriority = mysqli_fetch_assoc($resMedium)['total'];

// Prioridade Baixa
$resLow = mysqli_query($conn, "SELECT COUNT(*) as total FROM tickets WHERE LOWER(priority) = 'baixa'");
$lowPriority = mysqli_fetch_assoc($resLow)['total'];

/* =========================
   KPI SOLICITAÇÕES
========================= */

// Total de solicitações
$resTotalRequests = mysqli_query($conn, "SELECT COUNT(*) as total FROM requests");
$totalRequests = mysqli_fetch_assoc($resTotalRequests)['total'];

// Solicitações aprovadas
$resApproved = mysqli_query($conn, "SELECT COUNT(*) as total FROM requests WHERE LOWER(status) = 'aprovado'");
$approvedRequests = mysqli_fetch_assoc($resApproved)['total'];

// Solicitações rejeitadas
$resRejected = mysqli_query($conn, "SELECT COUNT(*) as total FROM requests WHERE LOWER(status) = 'rejeitado'");
$rejectedRequests = mysqli_fetch_assoc($resRejected)['total'];

/* ===================
Tickets por status
================== */
$statusQuery = mysqli_query($conn, "SELECT LOWER(status) as status, COUNT(*) as total FROM tickets GROUP BY status");

$ticketStatus = [];
while ($row = mysqli_fetch_assoc($statusQuery)) {
    $ticketStatus[$row['status']] = (int)$row['total'];
}

/* =========================
   PRIORIDADES PARA GRÁFICO
========================= */

$ticketPriority = [
    "Baixa" => (int)$lowPriority,
    "Média" => (int)$mediumPriority,
    "Alta"  => (int)$highPriority
];

/* =========================
   Solicitações por Tipo
========================= */

$requestTypes = [];
$requestTypeTotals = [];

$result = mysqli_query($conn, "SELECT type, COUNT(*) as total FROM requests GROUP BY type");

while ($row = mysqli_fetch_assoc($result)) {
    $requestTypes[] = $row['type'];          // label do gráfico
    $requestTypeTotals[] = (int)$row['total']; // valor do gráfico
}

/* =========================
   Solicitações por Status
========================= */

$requestStatus = [];
$requestStatusTotals = [];

$result = mysqli_query($conn, "SELECT status, COUNT(*) as total FROM requests GROUP BY status");

while ($row = mysqli_fetch_assoc($result)) {
    $requestStatus[] = $row['status'];             // label do gráfico
    $requestStatusTotals[] = (int)$row['total'];   // valor do gráfico
}

/* =========================
   Tickets criados por mês (Jan, Fev fixos + Mar do BD)
========================= */
$marTotal = (int)(mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tickets WHERE MONTH(created_at)=3 AND YEAR(created_at)=".date('Y')))['total'] ?? 0);
$ticketMonths = ['Jan','Fev','Mar'];
$ticketMonthTotals = [16, 27, $marTotal];

/* =========================
   Solicitações criadas por mês (Março do BD)
========================= */
$marTotalRequests = (int)(mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) as total 
    FROM requests 
    WHERE MONTH(created_at) = 3 AND YEAR(created_at) = ".date('Y')
))['total'] ?? 0);

/* =========================
   Valores para o gráfico
========================= */
$requestMonths = ['Jan', 'Fev', 'Mar'];
$requestMonthTotals = [13, 25, $marTotalRequests];

/* =========================
   Total Tickets e Solicitações
========================= */

$resTickets = mysqli_query($conn, "SELECT COUNT(*) as total FROM tickets");
$totalTickets = mysqli_fetch_assoc($resTickets)['total'] ?? 0;

$resRequests = mysqli_query($conn, "SELECT COUNT(*) as total FROM requests");
$totalRequests = mysqli_fetch_assoc($resRequests)['total'] ?? 0;

/* =========================
   JSON RESPONSE
========================= */

echo json_encode([
    "totalTickets" => (int)$totalTickets,
    "openTickets" => (int)$openTickets,
    "progressTickets" => (int)$progressTickets,
    "resolvedTickets" => (int)$resolvedTickets,
    "highPriority" => (int)$highPriority,
    "mediumPriority" => (int)$mediumPriority,
    "lowPriority" => (int)$lowPriority,
    "totalRequests" => (int)$totalRequests,
    "approvedRequests" => (int)$approvedRequests,
    "rejectedRequests" => (int)$rejectedRequests,
    "ticketStatus" => $ticketStatus,
    "ticketPriority" => $ticketPriority,
    "requestTypes" => $requestTypes,
    "requestTypeTotals" => $requestTypeTotals,
    "requestStatus" => $requestStatus,
    "requestStatusTotals" => $requestStatusTotals,
	"ticketMonths" => $ticketMonths,
    "ticketMonthTotals" => $ticketMonthTotals,
    "requestMonths" => $requestMonths,
    "requestMonthTotals" => $requestMonthTotals,
    "comparison" => [(int)$totalTickets, (int)$totalRequests]
], JSON_UNESCAPED_UNICODE);

exit;
?>