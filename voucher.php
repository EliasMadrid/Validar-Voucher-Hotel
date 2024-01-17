<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Cliente</h1>

        <?php
        // Se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            // Processar os dados do formulário
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $tipo_voucher = $_POST['tipo_voucher'];
            $codigo_voucher = uniqid();  // Gerar um código único
            $data_compra = date('Y-m-d H:i:s');
            $data_validacao = date('Y-m-d H:i:s', strtotime('+2 years', strtotime($data_compra)));

            // Inserir no banco de dados
            $sql = "INSERT INTO clientes (nome, email, tipo_voucher, codigo_voucher, data_compra, data_validacao)
                    VALUES ('$nome', '$email', '$tipo_voucher', '$codigo_voucher', '$data_compra', '$data_validacao')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Cadastro realizado com sucesso!</p>";
            } else {
                echo "<p>Erro ao cadastrar: " . $conn->error . "</p>";
            }

            $conn->close();
        }
        ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="tipo_voucher">Tipo do Voucher:</label>
                <input type="text" id="tipo_voucher" name="tipo_voucher" required>
            </div>
            <div class="form-group">
                <label for="codigo_voucher">Código do Voucher:</label>
                <input type="text" id="codigo_voucher" name="codigo_voucher" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
