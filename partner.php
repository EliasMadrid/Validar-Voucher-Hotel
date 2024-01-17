<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/style.css">
    <title>Validar Voucher</title>
</head>
<body>
    <!-- Seção do cabeçalho -->
     <header class="header">
        <div class="logo">
            <img src="img/logo.png" alt="Logo SwissStayDeals">
        </div>
        <!-- Adicione aqui outros elementos do cabeçalho, como menu, etc. -->
        <div class="menu">
            <ul>
                <li><a href="validar_voucher.php">Enregistrer  un bon</a></li>
                <li><a href="">Vos offres</a></li>
                <li><a href="">Contactez-nous</a></li>
                <li><a href="">Vos décomptes</a></li>
                <li><a href=""></a></li>
                <li class="submenu">
                    <a href="">Admin</a>
                    <ul>
                        <li>
                            <a href="cadastro_usuario.php">S'enregistrer </a>
                        </li>
                        <li>
                            <a href="login.php">Valider un Voucher</a>
                        </li>
                    </ul>
                </li>
                
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </header>
    
    <!-- Seção principal -->
    <div class="container">
        <h1>Validar Voucher</h1>
        <!-- Formulário de validação de voucher -->
             <form action="redeem.php" method="post">
                
                <label for="voucherCode">Digite o número do voucher:</label>
                <input type="text" id="voucherCode" name="voucherCode" required>
                <button type="submit">Resgatar</button>
            </form>
       
    </div>

    <!-- Rodapé -->
    <footer class="footer">
        Whatsap +41 77 809 42 18 Email info@mswissstaydeals.ch
    </footer>
</body>
</html>
