<?php
// Conexão com o banco
include('config/db.php');

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verifica a senha
        if (password_verify($senha, $user['senha'])) {
            // Login bem-sucedido, redirecionar ou iniciar a sessão
            echo "Login bem-sucedido!";
            // session_start(); // iniciar sessão se necessário
            // header('Location: dashboard.php'); // redireciona para a área restrita
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
}
?>
