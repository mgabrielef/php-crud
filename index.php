<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="static/style.css" rel="stylesheet" type="text/css" />
    <title>CRUD em PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

  <?php
    $pdo = new PDO("mysql:host=localhost;dbname=cadastro_cliente", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['excluir'])){
        $cod_cliente = (int) $_GET['excluir'];
        $pdo->exec("DELETE FROM tab_clientes WHERE cod_cliente = $cod_cliente");
        echo "<h3>Cliente $cod_cliente excluído com sucesso.</h3>";
        header("Location: index.php");
    };

    if(isset($_POST['nome'])){
        $sql = $pdo->prepare("INSERT INTO `tab_clientes` VALUES (null, ?,?,?)");
        $nome = $_POST['nome'];
        $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email']));
        echo "<h3>Cliente $nome cadastrado com sucesso.</h3>";
    }
  ?>
      
    <div class="container">
      <div class="cadastro">
        <form method="POST">
        <legend><h2 class="row justify-content-center">Cadastro de clientes</h2></legend>
        <fieldset>
            <div>
                Nome: <input type="text" name="nome" class="form-control" placeholder="Insira seu nome">
            </div>
            <div>
                CPF: <input type="text" name="cpf" class="form-control" placeholder="Insira seu CPF">
            </div>
            <div>
                Email: <input type="email" name="email" class="form-control" placeholder="Insira seu email">
            </div>
            <div>
              <br>
                <button class="botao" type="submit" value="Enviar">Enviar</button>
                <button class="botao" type="reset" value="Limpar dados">Limpar dados</button>
            </div>
        </form>
        </fieldset>
        </form>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <?php 
        $sql = $pdo->prepare("SELECT * FROM `tab_clientes`");
        $sql-> execute();
        $clientes = $sql->fetchAll();
        
        echo "<table class= 'table table-stripped table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope='col' colspan='2' class='text-center'>Ações</th>";
        echo "<th scope='col'>Nome</th>";
        echo "<th scope='col'>CPF</th>";
        echo "<th scope='col'>Email</th>";
        echo "</tr></thead><tbody>";

        foreach($clientes as $cliente){
            echo "<tr>";
            echo '<td align=center><a href="?excluir='. $cliente['cod_cliente'] . '">(X)</a></td>';
            echo '<td align=center><a href="alterar.php?cod_cliente='. $cliente['cod_cliente'] . '">(Alterar)</a></td>';
            echo "<td>" . $cliente['nome'] . "</td>";
            echo "<td>" . $cliente['cpf'] . "</td>";
            echo "<td>" . $cliente['email'] . "</td>";
            echo "</tr> </div>";
        }
    ?>

  </body>
</html>