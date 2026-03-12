<?php
include("../config/database.php");

// Força UTF-8 na conexão
mysqli_set_charset($conn, "utf8");

$query = mysqli_query($conn, "SELECT * FROM tickets ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysFlow | Help Desk</title>

    <meta name="description" content="SysFlow é uma mini plataforma ITSM full-stack desenvolvida por Elvio Patrick com HTML, CSS, JavaScript, PHP e MySQL, com gestão de tickets e dashboards.">

    <meta name="keywords" content="SysFlow, ITSM platform, ticket management system, service desk project, full stack PHP MySQL, Elvio Patrick portfolio, IT support system">

    <meta name="author" content="Elvio Patrick">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../assets/css/helpdesk.css">

    <link rel="icon" type="image/png" href="../assets/image/favicon.png">

</head>

<body>

    <header>
        <a href="index.php" style="text-decoration: none; display: block;">
            <img src="../assets/image/logo_01.png" style="width: 120px; cursor: pointer;" alt="SysFlow Logo" class="logo">
        </a>

        <button class="menu-toggle" id="menu-toggle" aria-label="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>

        <nav id="nav">
            <a href="../index.php">Home</a>
            <a href="index.php">Help Desk</a>
            <a href="../portal/index.php">Portal</a>
            <a href="../dashboard/index.php">Dashboard</a>
        </nav>
    </header>

    <main>

        <h1><span>Home</span><i class="fa-solid fa-angle-right"></i>Help Desk</h1>

        <button class="btn-novo" onclick="openCreateModal()">Novo Ticket</button>

        <table border="1" width="100%">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Prioridade</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
            <?php while ($ticket = mysqli_fetch_assoc($query)) {
                // Lógica simples para definir a cor da prioridade
                $priorityClass = '';
                if ($ticket['priority'] == 'Alta') $priorityClass = 'prio-alta';
                if ($ticket['priority'] == 'Média') $priorityClass = 'prio-media';
                if ($ticket['priority'] == 'Baixa') $priorityClass = 'prio-baixa';

                // Lógica para cor do status
                $statusRaw = strtolower(trim($ticket['status']));

                // Lógica para definir a classe
                switch ($statusRaw) {
                    case 'aberto':
                        $statusClass = 'status-aberto';
                        break;
                    case 'em progresso':
                        $statusClass = 'status-progresso';
                        break;
                    case 'resolvido':
                        $statusClass = 'status-resolvido';
                        break;
                    default:
                        $statusClass = 'status-aberto';
                        break;
                }
            ?>
                <tr>

                    <td data-label="ID">#<?php echo $ticket['id']; ?></td>

                    <td data-label="Título" style="font-weight: 500;"><?php echo $ticket['title']; ?></td>

                    <td data-label="Prioridade"><span class="badge <?php echo $priorityClass; ?>"><?php echo $ticket['priority']; ?></span></td>

                    <td data-label="Status"><span class="badge <?php echo $statusClass; ?>"><?php echo $ticket['status']; ?></span></td>

                    <td data-label="Ação">
                        <button class="btn-ver" onclick="loadTicket(<?php echo $ticket['id']; ?>)">
                            Atualizar Status
                        </button>
                    </td>

                </tr>
            <?php } ?>
        </table>

        <!-- MODAL CRIAR TICKET -->

        <div id="createModal" class="modal">

            <div class="modal-content">

                <span class="close" onclick="closeCreateModal()"><i class="fa-solid fa-xmark"></i></span>

                <h2>Criar Ticket</h2>

                <form action="../actions/create_ticket.php" method="POST">

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

        <!-- MODAL VER TICKET -->

        <div id="viewModal" class="modal">

            <div class="modal-content">

                <span class="close" onclick="closeViewModal()"><i class="fa-solid fa-xmark"></i></span>

                <h2>Ticket</h2>

                <p><strong>ID:</strong> <span id="ticketId"></span></p>
                <p><strong>Título:</strong> <span id="ticketTitle"></span></p>
                <p><strong>Descrição:</strong> <span id="ticketDesc"></span></p>
                <p><strong>Prioridade:</strong> <span id="ticketPriority"></span></p>
                <p><strong>Status:</strong> <span id="ticketStatus"></span></p>

                <form action="../actions/update_ticket.php" method="POST">

                    <input type="hidden" name="id" id="updateId">

                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option>Aberto</option>
                        <option>Em progresso</option>
                        <option>Resolvido</option>
                    </select>

                    <button class="btn-model-update" type="submit">Atualizar</button>

                </form>

            </div>

        </div>

    </main>

    <footer>
        <p>&copy; 2026 Sistema de Gestão de TI | Desenvolvido por Elvio Patrick.</p>
    </footer>

    <script src="../assets/js/helpdesk.js"></script>

</body>

</html>