<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="static/stylecadastro.css">
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
                <li><a href="validar_voucher.php">Cadastrar um voucher</a></li>
                <li><a href="">Beneficiario</a></li>
                <li><a href="">Atividade</a></li>
                <li><a href=""></a></li>
                <li class="submenu">
                    <a href="">Registrar um Parceiro</a>
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

    <div class="container">
        <h1>Cadastro de Cliente</h1>

        <form method="POST" action="processar_cadastro.php">
            <div class="form-group">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="data_compra">Data da Compra:</label><br>
                <input type="date" id="data_compra" name="data_compra" required>
            </div>
           
            <div class="form-group">
                <label for="id_voucher">Escolha o Tipo de Voucher:</label><br>
                <select id="id_voucher" name="id_voucher" required>
                    <?php
                    // Conectar ao banco de dados
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "voucher_clientes";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verificar a conexão
                    if ($conn->connect_error) {
                        die("Falha na conexão: " . $conn->connect_error);
                    }

                    // Consultar os tipos de voucher na tabela vouchers
                    $result = $conn->query("SELECT * FROM voucher");

                    // Exibir os tipos de voucher como opções no menu suspenso
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['tipo_voucher'] . '</option>';
                    }

                    $conn->close();
                    ?>
                </select>
                
            </div>
            <br><br>
            <button type="submit">Cadastrar</button>
        </form>
        
    </div>
   
    <footer class="footer">
        Whatsap +41 77 809 42 18 Email info@mswissstaydeals.ch
    </footer>
</body>
</html>


