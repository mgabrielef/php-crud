<link href="static/style.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=cadastro_cliente', 'root', '');

if (isset($_GET['cod_cliente'])) {
    $cod_cliente = (int)$_GET['cod_cliente'];
    $sql = $pdo->prepare("SELECT * FROM tab_clientes WHERE cod_cliente = $cod_cliente");
    $sql->execute();
    $clientes = $sql->fetchAll();

    foreach ($clientes as $cliente) {
        echo "<div class='container'>";
        echo "<form method='POST'>";
        echo "<legend>Insira os dados abaixo:</legend>";
        echo "<fieldset>";
        echo "<div>";
        echo "Nome: <input type='text' class='form-control' name='nome' value='" . $cliente['nome'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "CPF: <input type='text' class='form-control' name='cpf' value='" . $cliente['cpf'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "Email: <input type='email' class='form-control' name='email' value='" . $cliente['email'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "<br><button class='botao' type='submit' value='Enviar'>Enviar</button>";
        echo "<button class='botao' type='reset' value='Limpar dados'>Limpar dados</button>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form></div>";
    }
}

if (isset($_POST['nome'])) {
    $sql = $pdo->prepare("UPDATE tab_clientes SET nome = ?, cpf = ?, email = ? WHERE cod_cliente = $cod_cliente");
    $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email']));
    echo "<h1>Usuário com id = $cod_cliente alterado com sucesso!</h1>";
    echo "<button class='botao'><a href='index.php'>Voltar</a></button>";
}