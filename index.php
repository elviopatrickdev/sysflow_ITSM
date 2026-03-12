<?php
include("config/database.php");

// Força UTF-8 na conexão
mysqli_set_charset($conn, "utf8");

$tickets = mysqli_query($conn, "SELECT COUNT(*) as total FROM tickets");
$tickets_total = mysqli_fetch_assoc($tickets)['total'];

$requests = mysqli_query($conn, "SELECT COUNT(*) as total FROM requests");
$requests_total = mysqli_fetch_assoc($requests)['total'];

?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysFlow | Homepage</title>

    <meta name="description" content="SysFlow é uma mini plataforma ITSM full-stack desenvolvida por Elvio Patrick com HTML, CSS, JavaScript, PHP e MySQL, com gestão de tickets e dashboards.">

    <meta name="keywords" content="SysFlow, ITSM platform, ticket management system, service desk project, full stack PHP MySQL, Elvio Patrick portfolio, IT support system">

    <meta name="author" content="Elvio Patrick">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="icon" type="image/png" href="assets/image/favicon.png">

</head>

<body>

    <main>
        <div class="background-hero">
            <header>
                <a href="index.php" style="text-decoration: none; display: block;">
                    <img src="assets/image/logo_01.png" style="width: 120px; cursor: pointer;" alt="SysFlow Logo" class="logo">
                </a>

                <button class="menu-toggle" id="menu-toggle" aria-label="menu-toggle">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <nav id="nav">
                    <button class="close-menu" id="close-menu" aria-label="close-menu"><i class="fa-solid fa-square-xmark"></i></button>
                    <a href="index.php">Home</a>
                    <a href="helpdesk/index.php">Help Desk</a>
                    <a href="portal/index.php">Portal</a>
                    <a href="dashboard/index.php">Dashboard</a>
                </nav>
            </header>

            <section class="hero">
                <h1>Gestão de Suporte e Solicitações de TI</h1>
                <p>Gerencie chamados de TI, aprove solicitações internas e monitore todas as operações em um só lugar.</p>
                <a class="btn" onclick="openCreateModal()">Novo Ticket</a>
                <div class="metrics">
                    <div class="card">
                        <h3><i class="fa-solid fa-ticket" style="transform: rotate(-45deg); margin-right: 8px;"></i>Tickets</h3>
                        <p id="tickets-count">
                            <?php echo $tickets_total; ?>
                        </p>
                    </div>
                    <div class="card">
                        <h3><i class="fa-regular fa-file-lines" style="margin-right: 8px; font-size: 18px;"></i>Solicitações</h3>
                        <p id="requests-count">
                            <?php echo $requests_total; ?>
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <section class="modules">
            <div class="module">
                <div class="header-module">
                    <h3>Help Desk</h3>
                    <img class="icon-image" src="assets/image/helpdesk.png" alt="helpdesk icon">
                </div>
                <p>Gerencie chamados de suporte técnico.</p>
                <a href="helpdesk/index.php">Acessar</a>
            </div>
            <div class="module">
                <div class="header-module">
                    <h3>Portal de Solicitações</h3>
                    <img class="icon-image" src="assets/image/solicitation.png" alt="solicitation icon">
                </div>
                <p>Solicite softwares, acessos e equipamentos.</p>
                <a href="portal/index.php">Acessar</a>
            </div>
            <div class="module">
                <div class="header-module">
                    <h3>Dashboard</h3>
                    <img class="icon-image" src="assets/image/dashboard.png" alt="dashboard icon">
                </div>
                <p>Visualize métricas e relatórios do sistema.</p>
                <a href="dashboard/index.php">Acessar</a>
            </div>
        </section>

        <!-- MODAL CRIAR TICKET -->

        <div id="createModal" class="modal">

            <div class="modal-content">

                <span class="close" onclick="closeCreateModal()"><i class="fa-solid fa-xmark"></i></span>

                <h2>Criar Ticket</h2>

                <form action="./actions/create_ticket.php" method="POST">

                    <label for="title">Título</label>
                    <input type="text" id="title" name="title" required>

                    <label for="description">Descrição</label>
                    <textarea id="description" name="description"></textarea>

                    <label for="priority">Prioridade</label>

                    <select id="priority" name="priority">
                        <option>Baixa</option>
                        <option>Média</option>
                        <option>Alta</option>
                    </select>

                    <button class="btn-model-update" type="submit">Criar Ticket</button>

                </form>

            </div>

        </div>

    </main>

    <footer>
        <p>&copy; 2026 Sistema de Gestão de TI | Desenvolvido por Elvio Patrick.</p>
    </footer>

    <script src="assets/js/main.js"></script>

</body>

</html>