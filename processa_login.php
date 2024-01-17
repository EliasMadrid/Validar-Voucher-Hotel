<?php
session_start();

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "voucher_clientes";

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar as credenciais no banco de dados
    $stmt = $conn->prepare("SELECT id, username, password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verificar se o usuário existe e a senha está correta
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['logged_in'] = true;
        header('Location: validar_voucher.php'); // Redireciona para o validar_voucher.php
    } else {
        header('Location: login.php?login_failed=true'); // Redireciona de volta para a página de login com mensagem de erro
    }

    $stmt->close();
}

$conn->close();
?>

