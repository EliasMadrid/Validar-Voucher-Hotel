<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "voucher_clientes";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Iniciar uma transação
    $conn->begin_transaction();

    try {
        // Obter o próximo valor para id_voucher
        $result = $conn->query("SELECT MAX(VoucherID) AS max_id FROM voucher");
        $row = $result->fetch_assoc();
        $max_id = $row['max_id'];
        $new_id_voucher = $max_id + 1;

        $codigo_voucher = substr(strtoupper(bin2hex(random_bytes(3))), 0, 5);
        $status = $_POST['status'];
        $data_cadastro = date('Y-m-d H:i:s');
        $data_validade = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($data_cadastro)));
        $nome_voucher = $_POST['tipo_voucher'];
        $preco_original = $_POST['preco_original'];
        $preco_final = $_POST['preco_final'];
        $descricao = $_POST['descricao'];

        // Inserir o novo registro
        $sql = "INSERT INTO voucher (VoucherID, codigo, status, data_cadastro, DataValidade, tipo_voucher, preco_original, preco_final, descricao)
        VALUES ('$new_id_voucher', '$codigo_voucher','$status', '$data_cadastro', '$data_validade', '$nome_voucher', '$preco_original', '$preco_final', '$descricao')";

        if ($conn->query($sql) === TRUE) {
            // Commit se tudo estiver bem
            $conn->commit();
            echo "<p>Cadastro realizado com sucesso!</p>";
        } else {
            // Rolar de volta em caso de erro
            $conn->rollback();
            echo "<p>Erro ao cadastrar: " . $conn->error . "</p>";
        }
    } catch (Exception $e) {
        // Lidar com exceções
        $conn->rollback();
        echo "<p>Erro ao cadastrar: " . $e->getMessage() . "</p>";
    }

    // Fechar a conexão
    $conn->close();
}
?>
