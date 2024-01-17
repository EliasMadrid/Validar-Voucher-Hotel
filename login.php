<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylelogin.css
    ">
    <title>Login</title>
</head>

<body>

    <!-- Cabeçalho -->
    <header class="header">
        <div class="logo">
            <img src="img/logo.png" alt="Logo SwissStayDeals">
        </div>
        <!-- Adicione aqui outros elementos do cabeçalho, como menu, etc. -->
    </header>

    <!-- Conteúdo principal -->
    <div class="container">
        <h1>Login</h1>
        <br>
        <?php
        // Verifica se houve uma tentativa de login mal-sucedida
        if (isset($_GET['login_failed'])) {
            echo '<p style="color: red;">Nome de usuário ou senha incorretos. Tente novamente.</p>';
        }
        ?>
        <form method="post" action="processa_login.php">
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
            <br><br>
        </form>

        <p>Não tem conta? <a href="cadastro_usuario.php">cadastre-se aqui</a></p>
    </div>

    <!-- Rodapé -->
    <footer class="footer">
        Whatsap +41 77 809 42 18 Email info@swissstaydeals.ch
    </footer>

</body>
   

</html>


