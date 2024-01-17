Para criar um arquivo PDF ao clicar no botão de validar, você pode utilizar a biblioteca FPDF, que é uma biblioteca popular para criar documentos PDF em PHP. Primeiro, você precisará baixar a biblioteca FPDF do [site oficial](http://www.fpdf.org/) e incluir em seu projeto.

Aqui está uma versão modificada do seu código, adicionando a geração do PDF:

```php
<?php
session_start();
require('fpdf/fpdf.php');  // Inclua o caminho correto para o arquivo fpdf.php


$servername = "localhost";
$username = "root";
$password = "";
$database = "voucher_clientes";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
}

$mensagem = '';
$dados_cliente = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_voucher = $_POST['codigo_voucher'];

    $stmt = $conn->prepare("SELECT * FROM clientes WHERE codigo_voucher = ?");
    $stmt->bind_param("s", $codigo_voucher);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['cliente'] = $result->fetch_assoc();
        $dados_cliente = $_SESSION['cliente'];
        $mensagem = "<span style='color: green; font-weight: bold;'>Voucher Enregistrée.</span><br><br>Client:";
    } else {
        $mensagem = "Código do voucher inválido. Tente novamente.";
    }

    $stmt->close();
}

// Geração do PDF
if (isset($_POST['gerar_pdf'])) {
    class PDF extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, 'Detalhes do Cliente', 0, 1, 'C');
            $this->Ln(10);
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    foreach ($dados_cliente as $key => $value) {
        $pdf->Cell(0, 10, utf8_decode("$key: $value"), 0, 1);
    }

    $pdf->Output('Detalhes_Cliente.pdf', 'D');
    exit();
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
    <!-- ... Seção principal ... -->
    <div class="container">
        <h1>Validar Voucher</h1>
        <!-- Formulário de validação de voucher -->
        <form method="post" action="validar_voucher.php">
            <label for="codigo_voucher">Código do Voucher:</label>
            <input type="text" id="codigo_voucher" name="codigo_voucher" value="<?php echo isset($dados_cliente['codigo_voucher']) ? $dados_cliente['codigo_voucher'] : ''; ?>" required>
            <button type="submit">Validar</button>

            <!-- Adicionando botão para gerar o PDF -->
            <button type="submit" name="gerar_pdf">Gerar PDF</button>
        </form>
        <!-- Exibição da mensagem, se houver -->
        <?php if (isset($mensagem)): ?>
            <p><?php echo $mensagem; ?></p>
            <?php
            // Exibe os dados do cliente se o voucher for válido
            if ($dados_cliente) {
                echo "<p><strong>Nome:</strong> " . $dados_cliente['nome'] . "</p>";
                // ... Outros campos ...
            }
            ?>
        <?php endif; ?>
    </div>
    <!-- ... Rodapé ... -->
</body>
</html>
```

Este código adiciona um botão no formulário para gerar um PDF com os detalhes do cliente. Certifique-se de ajustar o caminho para o arquivo `fpdf.php` conforme necessário.