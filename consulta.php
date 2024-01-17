<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}

// Verifica se os dados do cliente estão na sessão
if (!isset($_SESSION['cliente'])) {
    header('Location: validar_voucher.php'); // Redireciona de volta para a validação se os dados não estiverem presentes
    exit();
}

// Obtém os dados do cliente da sessão
$cliente = $_SESSION['cliente'];

// ... (seu código existente)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/style.css">
    <title>Consulta</title>
</head>
<body>
    <!-- Seção do cabeçalho -->
    <div class="header">
        <!-- Conteúdo do cabeçalho -->
    </div>
    
    <!-- Seção principal -->
    <div class="container">
        <h1>Dados do Cliente</h1>
        <!-- Exibe os dados do cliente -->
        <p>ID: <?php echo $cliente['id']; ?></p>
        <p>Nome: <?php echo $cliente['nome']; ?></p>
        <!-- Adicione os outros campos conforme necessário -->

        <!-- ... (seu código existente) -->
    </div>

    <!-- Rodapé -->
    <footer class="footer">
        Whatsap +41 77 809 42 18 Email info@madridmarketing.ch
    </footer>
</body>
</html>


