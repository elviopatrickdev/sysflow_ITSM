<?php
include("../config/database.php");

// Simulando usuário logado (substituir por session em produção)
$userId = 1;

// Recebendo dados do formulário 
$type = isset($_POST['type']) ? mysqli_real_escape_string($conn, $_POST['type']) : '';
$description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : '';

// Validação
if($type != '' && $description != ''){
    $query = "INSERT INTO requests (user_id, type, description) VALUES ('$userId', '$type', '$description')";

    if(mysqli_query($conn, $query)){
        
        header("Location: ../portal/index.php");
        exit();
    } else {
        echo "Erro ao criar solicitação: " . mysqli_error($conn);
    }
} else {
    echo "Por favor preencha todos os campos!";
}
?>