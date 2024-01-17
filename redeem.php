<?php
// Conexão com o banco de dados (substitua as credenciais conforme necessário)
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "voucher_clientes";

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Variáveis para armazenar dados do voucher
$codigoVoucher = '';
$dadosVoucher = array();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

 // Recebe o código do voucher do formulário
$codigoVoucher = isset($_POST['codigoVoucher']) ? trim($_POST['codigoVoucher']) : '';

// Consulta SQL para obter os dados relacionados ao voucher

$query = "SELECT * FROM Voucher
          LEFT JOIN Beneficiario ON Voucher.VoucherID = Beneficiario.VoucherID
          LEFT JOIN Atividade ON Voucher.VoucherID = Atividade.VoucherID
          WHERE Voucher.Codigo = '$codigoVoucher'";

$result = $conn->query($query);

if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
}

if ($result->num_rows > 0) {
    $dadosVoucher = $result->fetch_assoc();
}

}
// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/style.css">
    <title>Parceiro</title>
</head>
<body>
    <!-- Exibição da mensagem, se houver -->
    <div class="container">
        <h1>Validar Voucher</h1>

        <!-- Exibição da mensagem, se houver -->
        <?php if (isset($mensagem)): ?>
            <p><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <!-- Exibe os dados do cliente se o voucher for válido -->
        <?php if (!empty($dadosVoucher)): ?>
            <h2>Dados do Voucher</h2>
            <p>Número do Voucher: <?php echo $dadosVoucher['Codigo']; ?></p>
            <p>Status: <?php echo $dadosVoucher['Status']; ?></p>
            <p>Data de Compra: <?php echo $dadosVoucher['DataCompra']; ?></p>
            <p>Data de Validade: <?php echo $dadosVoucher['DataValidade']; ?></p>

            <h2>Dados do Beneficiário</h2>
            <p>Nome: <?php echo $dadosVoucher['Nome']; ?></p>
            <p>Email: <?php echo $dadosVoucher['Email']; ?></p>
            <p>Telefone: <?php echo $dadosVoucher['Telefone']; ?></p>

            <h2>Atividade Relacionada ao Voucher</h2>
            <p>Código da Atividade: <?php echo $dadosVoucher['CodigoAtividade']; ?></p>
            <p>Preço Original: R$ <?php echo $dadosVoucher['PrecoOriginal']; ?></p>
            <p>Promoção: <?php echo $dadosVoucher['Promocao']; ?></p>
            <p>Preço: R$ <?php echo $dadosVoucher['Preco']; ?></p>
            <p>Comissão: R$ <?php echo $dadosVoucher['Comissao']; ?></p>
            <p>TVA na Comissão: R$ <?php echo $dadosVoucher['TVAComissao']; ?></p>
            <p>Preço Líquido: R$ <?php echo $dadosVoucher['PrecoLiquido']; ?></p>
            <p>Referência Complementar: <?php echo $dadosVoucher['ReferenciaComplementar']; ?></p>
        <?php else: ?>
    <p>Nenhum voucher encontrado com o código fornecido.</p>
<?php endif; ?>


    </div>

    <!-- Rodapé -->
    <footer class="footer">
        Whatsap +41 77 809 42 18 Email info@mswissstaydeals.ch
    </footer>
</body>
</html>