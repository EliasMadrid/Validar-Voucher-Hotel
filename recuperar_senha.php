<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recuperação de Senha</title>
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
        <h1>Recuperação de Senha</h1>
        <?php
        // Implementar lógica de recuperação de senha aqui
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar o email no banco de dados e enviar o email de recuperação
            // (Você precisará implementar esta parte)
            $email = $_POST["email"];

            // Aqui você deve implementar a lógica para verificar se o email existe no banco de dados
            // e enviar um email com um link para redefinir a senha.
            // Pode usar uma biblioteca de envio de email ou a função mail() do PHP.

            // Exemplo de como enviar um email (não esqueça de configurar o servidor de email):
            $assunto = "Recuperação de Senha";
            $mensagem = "Você solicitou a recuperação de senha. Clique no link abaixo para redefinir sua senha:\n\n";
            $mensagem .= "http://seusite.com/redefinir_senha.php?token=seu_token";  // Substitua pelo link real
            $headers = "From: webmaster@seusite.com";

            // mail($email, $assunto, $mensagem, $headers);
            echo "Um link de recuperação foi enviado para o seu email.";
        }
        ?>

        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Enviar Email de Recuperação</button>
        </form>
        <p>Já lembrou a senha? <a href="login.php">Faça login aqui</a></p>
    </div>
</body>
</html>
