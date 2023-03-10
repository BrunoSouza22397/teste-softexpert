<?php

require_once __DIR__ . '/vendor/autoload.php';

use TesteSoftexpert\Backend\Connection;
use TesteSoftexpert\Backend\Models\Tipo;
use TesteSoftexpert\Backend\Models\Produto;

//cadastra tipo
if (array_key_exists('cadTipo', $_POST)) {
    $tipo = new Tipo($_POST['tipoNome'], $_POST['tipoImp']);
    $tipo->salvarTipo();
}

//cadastra produto
if (array_key_exists('cadProd', $_POST)) {
    $produto = new Produto($_POST['prodNome'], $_POST['prodVal'], $_POST['prodTipo']);
    $produto->salvarProduto();
}

//busca lista de estoque e seleção de tipos
$db = new Connection();
$estoque = $db->buscarEstoque();
$tipos = $db->buscarTipos();
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            margin-left: 1%;
        }
        li {
            list-style: none;
        }
    </style>
</head>

<body>
    <div>
        <h2>Cadastro de Tipo</h2>
        <form method="POST" class="g-3">
            <div class="col-sm-3 mb-1">
                <label for="tipoNome" class="visually-hidden">NomeTipo</label>
                <input type="text" class="form-control" name="tipoNome" id="tipoNome" placeholder="Nome" required>
            </div>
            <div class="col-sm-3 mb-1">
                <label for="tipoImp" class="visually-hidden">ImpostoTipo</label>
                <input type="number" class="form-control" name="tipoImp" id="tipoImp" step=".01" placeholder="Imposto (%)" required>
            </div>
            <div class="col-sm">
                <input type="submit" name="cadTipo" class="btn btn-primary">
            </div>
        </form>
    </div>
    <div>
        <h2>Cadastro de Produto</h2>
        <form method="POST" class="g-3">
            <div class="col-sm-3 mb-1">
                <input type="text" class="form-control" name="prodNome" id="prodNome" placeholder="Nome" required>
            </div>
            <div class="col-sm-3 mb-1">
                <input class="form-control" type="number" name="prodVal" id="prodVal" step=".01" placeholder="Valor(R$)" required>
            </div>
            <div class="col-sm-3 mb-1">
                <select class="form-control" name="prodTipo" id="prodTipo" required>
                    <option value="">Selecione um Tipo</option>
                    <?php
                    foreach ($tipos as $tipo) {
                        ?>
                            <option value="<?php echo $tipo['id']; ?>"><?php echo $tipo['nome']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-3 mb-1">
                <a href="index.php"><input type="submit" name="cadProd" class="btn btn-primary"></a>
            </div>
        </form>
    </div>
    <div>
        <a href="http://localhost:8080/src/TelaVendas.php" class="btn btn-success"><h2>Efetuar Nova Venda</h2></a>
        <h2>Estoque</h2>
        <div>
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                </tr>
                <?php
                    foreach ($estoque as $value) {
                        ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['produto']; ?></td>
                            <td><?php echo $value['quantidade']; ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <script>
        let idCount = 0;

        //atualiza a página ao enviar um formulário, evitando reenvio
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>