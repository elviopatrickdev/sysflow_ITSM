<?php
include("../config/database.php");

// Força UTF-8 na conexão
mysqli_set_charset($conn, "utf8");

?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysFlow | Dashboard</title>

    <meta name="description" content="SysFlow é uma mini plataforma ITSM full-stack desenvolvida por Elvio Patrick com HTML, CSS, JavaScript, PHP e MySQL, com gestão de tickets e dashboards.">

    <meta name="keywords" content="SysFlow, ITSM platform, ticket management system, service desk project, full stack PHP MySQL, Elvio Patrick portfolio, IT support system">

    <meta name="author" content="Elvio Patrick">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="../assets/css/dashboard.css">

    <link rel="icon" type="image/png" href="../assets/image/favicon.png">

</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="index.php" style="text-decoration: none; display: block;">
                <img src="../assets/image/logo_02.png" style="width: 120px; cursor: pointer;" alt="SysFlow Logo" class="logo">
            </a>
        </div>

        <nav class="sidebar-nav">
            <small class="nav-label">Principal</small>
            <a href="../index.php" class="nav-link">
                <i class="fa-solid fa-house"></i>
                <span class="link-text">Home</span>
            </a>
            <a href="../helpdesk/index.php" class="nav-link">
                <i class="fa-solid fa-headset"></i>
                <span class="link-text">Help Desk</span>
            </a>
            <a href="../portal/index.php" class="nav-link">
                <i class="fa-solid fa-file-lines"></i>
                <span class="link-text">Portal</span>
            </a>
            <a href="index.php" class="nav-link active">
                <i class="fa-solid fa-chart-simple"></i>
                <span class="link-text">Dashboard</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <p>v1.0.0</p>
            <p>Desenvolvido por Elvio Patrick</p>
        </div>
    </aside>

    <main>

        <h1><span>Home</span><i class="fa-solid fa-angle-right"></i>Dashboard</h1>

        <!-- KPI CARDS -->

        <div class="kpi-grid">

            <div class="card">
                <h3>Total Tickets</h3>
                <p id="totalTickets">0</p>
            </div>

            <div class="card">
                <h3>Tickets Abertos</h3>
                <p id="openTickets">0</p>
            </div>

            <div class="card">
                <h3>Tickets Progresso</h3>
                <p id="progressTickets">0</p>
            </div>

            <div class="card">
                <h3>Tickets Resolvidos</h3>
                <p id="resolvedTickets">0</p>
            </div>

            <div class="card">
                <h3>Prioridade Alta</h3>
                <p id="highPriority">0</p>
            </div>

            <div class="card">
                <h3>Prioridade Média</h3>
                <p id="mediumPriority">0</p>
            </div>

            <div class="card">
                <h3>Prioridade Baixa</h3>
                <p id="lowPriority">0</p>
            </div>

            <div class="card">
                <h3>Total Solicitações</h3>
                <p id="totalRequests">0</p>
            </div>

            <div class="card">
                <h3>Aprovadas</h3>
                <p id="approvedRequests">0</p>
            </div>

            <div class="card">
                <h3>Rejeitadas</h3>
                <p id="rejectedRequests">0</p>
            </div>

        </div>

        <!-- GRÁFICOS -->

        <div class="charts">

            <div class="chart-card">
                <h3>Tickets por Status</h3>
                <canvas id="ticketStatusChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Tickets por Prioridade</h3>
                <canvas id="ticketPriorityChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Solicitações por Tipo</h3>
                <canvas id="requestTypeChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Solicitações por Status</h3>
                <canvas id="requestStatusChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Tickets criados por mês</h3>
                <canvas id="ticketMonthChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Solicitações criadas por mês</h3>
                <canvas id="requestMonthChart"></canvas>
            </div>

            <div class="chart-card full">
                <h3>Tickets vs Solicitações</h3>
                <canvas id="comparisonChart"></canvas>
            </div>

        </div>

    </main>

    <script src="../assets/js/dashboard.js"></script>

</body>

</html>