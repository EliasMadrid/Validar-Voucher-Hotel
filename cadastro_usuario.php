<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <style>
        /* Estilos existentes permanecem iguais */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            color: #333333;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555555;
            text-align: left;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        button[type="submit"] {
            background-color: #5c130c;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Usuário</h1>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Validar os campos (apenas um exemplo, você pode adicionar mais validações)
            if (empty($username) || empty($email) || empty($password)) {
                echo "Nome de usuário, email e senha são campos obrigatórios.";
            } else {
                // Dados de conexão com o banco de dados
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $banco = "voucher_clientes";

                // Criar conexão
                $conexao = new mysqli($servidor, $usuario, $senha, $banco);

                // Verificar a conexão
                if ($conexao->connect_error) {
                    die("Erro na conexão: " . $conexao->connect_error);
                }

                // Hash da senha
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Preparar a consulta usando um Prepared Statement
                $sql = "INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("sss", $username, $email, $hashed_password);

                // Executar a consulta
                if ($stmt->execute()) {
                    echo "Usuário cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar o usuário: " . $stmt->error;
                }

                // Fechar a conexão e liberar recursos
                $stmt->close();
                $conexao->close();
            }
        }
        ?>

        <form method="POST" action="">
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Cadastrar</button>
        </form>
        <p>Já tem uma conta? <a href="login.php">Faça login aqui</a></p>
        <br> <p> <a href="recuperar_senha.php">Esqueci a Senha</a></p>

    </div>
</body>
</html>

