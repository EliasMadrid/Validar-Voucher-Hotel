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

// Inicializa a variável $mensagem
$mensagem = '';
$dados_cliente = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_voucher = $_POST['codigo_voucher'];

    // Consulta o banco de dados para verificar o voucher
    $stmt = $conn->prepare("SELECT * FROM clientes WHERE codigo_voucher = ?");
    $stmt->bind_param("s", $codigo_voucher);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // O voucher é válido, armazena os dados do cliente na sessão
        $_SESSION['cliente'] = $result->fetch_assoc();
        $dados_cliente = $_SESSION['cliente'];
        $mensagem = "<span style='color: green; font-weight: bold;'>Voucher Enregistrée.</span><br><br>Client:";
    } else {
        $mensagem = "Código do voucher inválido. Tente novamente.";
    }

    $stmt->close();
}

$conn->close();
?>

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
            <form method="post" action="validar_voucher.php">
                <label for="codigo_voucher">Código do Voucher:</label>
                <input type="text" id="codigo_voucher" name="codigo_voucher" value="<?php echo isset($dados_cliente['codigo_voucher']) ? $dados_cliente['codigo_voucher'] : ''; ?>" required>
                <button type="submit">Validar</button>
            </form>
        <!-- Exibição da mensagem, se houver -->
        <?php if (isset($mensagem)): ?>
            <p><?php echo $mensagem; ?></p>
            <?php
            // Exibe os dados do cliente se o voucher for válido
            if ($dados_cliente) {
               
                echo "<p><strong>Nome:</strong> " . $dados_cliente['nome'] . "</p>";
                echo "<p><strong>Email:</strong> " . $dados_cliente['email'] . "</p>";
                echo "<p><strong>Tipo de Voucher:</strong> " . $dados_cliente['tipo_voucher'] . "</p>";

                $data_compra_formatada = date('d/m/Y', strtotime($dados_cliente['data_compra']));
                $data_validacao_formatada = date('d/m/Y', strtotime($dados_cliente['data_validacao']));
                echo "<p><strong>Data de Compra:</strong> " . $data_compra_formatada . "</p>";
                echo "<p><strong>Data de Validação:</strong> " . $data_validacao_formatada . "</p>";

                #echo "<p>Endereço: " . $dados_cliente['endereco'] . "</p>";
                #echo "<p>Telefone: " . $dados_cliente['telefone'] . "</p>";
                #echo "<p>Data de Compra: " . $dados_cliente['data_compra'] . "</p>";
                #echo "<p>Data de Validação: " . $dados_cliente['data_validacao'] . "</p>";
                // Formatando as datas usando a função date()
             

           
            }
            ?>
        <?php endif; ?>
    </div>

    <!-- Rodapé -->
    <footer class="footer">
        Whatsap +41 77 809 42 18 Email info@mswissstaydeals.ch
    </footer>
</body>
</html>
