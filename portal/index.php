<?php
include("../config/database.php");

// Força UTF-8 na conexão
mysqli_set_charset($conn, "utf8");

// Simulando usuário logado
$userId = 1;
$userRole = 'manager'; // ou 'user'

// Buscar solicitações do usuário
$query = mysqli_query($conn, "SELECT * FROM requests ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysFlow | Portal de Solicitações</title>

    <meta name="description" content="SysFlow é uma mini plataforma ITSM full-stack desenvolvida por Elvio Patrick com HTML, CSS, JavaScript, PHP e MySQL, com gestão de tickets e dashboards.">

    <meta name="keywords" content="SysFlow, ITSM platform, ticket management system, service desk project, full stack PHP MySQL, Elvio Patrick portfolio, IT support system">

    <meta name="author" content="Elvio Patrick">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../assets/css/portal.css">

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
            <button class="close-menu" id="close-menu" aria-label="close-menu"><i class="fa-solid fa-square-xmark"></i></button>
            <a href="../index.php">Home</a>
            <a href="../helpdesk/index.php">Help Desk</a>
            <a href="index.php">Portal</a>
            <a href="../dashboard/index.php">Dashboard</a>
        </nav>
    </header>

    <main>

        <h1><span>Home</span><i class="fa-solid fa-angle-right"></i>Portal</h1>

        <button class="btn-novo" onclick="openCreateRequestModal()">Nova Solicitação</button>

        <table border="1" width="100%">
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
            <?php while ($request = mysqli_fetch_assoc($query)) {
                $statusClass = strtolower($request['status']); ?>
                <tr>

                    <td data-label="ID">#<?php echo $request['id']; ?></td>

                    <td data-label="Tipo"><?php echo $request['type']; ?></td>

                    <td data-label="Descrição">
                        <?php echo $request['description']; ?>
                    </td>

                    <td data-label="Status">
                        <span class="badge <?php echo $statusClass; ?>">
                            <?php echo $request['status']; ?>
                        </span>
                    </td>

                    <td data-label="Ação">

                        <div class="actions">

                            <?php if ($userRole === 'manager') { ?>
                                <button class="btn-action" onclick="approveRequest(<?php echo $request['id']; ?>)">Aprovar</button>
                                <button class="btn-action" onclick="rejectRequest(<?php echo $request['id']; ?>)">Rejeitar</button>
                            <?php } ?>

                            <button class="btn-action" onclick="loadRequest(<?php echo $request['id']; ?>)">Detalhes</button>

                        </div>

                    </td>

                </tr>
            <?php } ?>
        </table>

        <!-- MODAL CRIAR SOLICITAÇÃO -->
        <div id="createRequestModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeCreateRequestModal()"><i class="fa-solid fa-xmark"></i></span>
                <h2>Criar Solicitação</h2>
                <form action="../actions/create_request.php" method="POST">
                    <label for="type">Tipo</label>
                    <select id="type" name="type">
                        <option>Software</option>
                        <option>Acesso</option>
                        <option>Hardware</option>
                    </select>

                    <label for="description">Descrição</label>
                    <textarea id="description" name="description" required></textarea>

                    <button class="btn-model" type="submit">Criar Solicitação</button>
                </form>
            </div>
        </div>

        <!-- MODAL VER SOLICITAÇÃO -->
        <div id="viewRequestModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeViewRequestModal()"><i class="fa-solid fa-xmark"></i></span>
                <h2>Solicitação</h2>
                <p><strong>ID:</strong> <span id="requestId"></span></p>
                <p><strong>Tipo:</strong> <span id="requestType"></span></p>
                <p><strong>Descrição:</strong> <span id="requestDesc"></span></p>
                <p><strong>Status:</strong> <span id="requestStatus"></span></p>
                <input type="hidden" id="updateId">
            </div>
        </div>

    </main>

    <footer>
        <p>&copy; 2026 Sistema de Gestão de TI | Desenvolvido por Elvio Patrick.</p>
    </footer>

    <script src="../assets/js/portal.js"></script>
</body>

</html>