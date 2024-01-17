<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Voucher</title>
    <link rel="stylesheet" href="static/stylecadastro.css">
</head>
<body>
    <!-- Seção do cabeçalho -->
    <header class="header">
        <div class="logo">
            <img src="img/logo.png" alt="Logo SwissStayDeals">
        </div>
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
        <h1>Cadastro de Voucher</h1>

        <form method="POST" action="processar_cadastro_voucher.php">
            <div class="form-group">
                <!-- Novos campos adicionados -->
<div class="form-group">
    <label for="tipo_voucher">Nome do Voucher:</label><br>
    <input type="text" id="tipo_voucher" name="tipo_voucher" required>
</div>
<div class="form-group">
    <label for="descricao">Descrição:</label><br>
    <textarea id="descricao" name="descricao" rows="4" cols="39" required></textarea>
</div>

<div class="form-group">
    <label for="status">Status:</label><br>
    <select id="status" name="status" required>
        <option value="Ativo">Ativo</option>
        <option value="Inativo">Inativo</option>
    </select>
</div>
<br>
<div class="form-group">
    <label for="data_cadastro">Data de Cadastro:</label><br>
    <input type="date" id="data_cadastro" name="data_cadastro" value="<?php echo date('Y-m-d '); ?>">
    <!-- O campo de data de cadastro será preenchido automaticamente -->
</div>


                <div class="form-group">
                    <label for="preco_original">Preço Original (CHF):</label><br>
                    <input type="text" id="preco_original" name="preco_original" required>
                </div>
                <div class="form-group">
                    <label for="preco_final">Preço Final (CHF):</label><br>
                    <input type="text" id="preco_final" name="preco_final" required>
                </div>
                
            </div>


            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <footer class="footer">
        Whatsap +41 77 809 42 18 Email info@mswissstaydeals.ch
    </footer>
</body>
</html>


