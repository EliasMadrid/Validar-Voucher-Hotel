
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
            function generateVoucherCode($length = 5) {
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $code = '';
            
                for ($i = 0; $i < $length; $i++) {
                    $code .= $characters[rand(0, strlen($characters) - 1)];
                }
            
                return $code;
            }
            

            // Processar os dados do formulário
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $id_voucher = $_POST['id_voucher'];
            $codigo_voucher = generateVoucherCode();
            $data_compra = date('Y-m-d H:i:s');
            $data_validacao = date('Y-m-d H:i:s', strtotime('+2 years', strtotime($data_compra)));

            // Inserir no banco de dados
            $sql = "INSERT INTO clientes (nome, email, id_voucher, codigo_voucher, data_compra, data_validacao)
                    VALUES ('$nome', '$email', '$id_voucher', '$codigo_voucher', '$data_compra', '$data_validacao')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Cadastro realizado com sucesso!</p>";
            } else {
                echo "<p>Erro ao cadastrar: " . $conn->error . "</p>";
            }

            $conn->close();
        }
        ?>