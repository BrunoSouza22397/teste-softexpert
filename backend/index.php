
<?php

require_once __DIR__ . '/vendor/autoload.php';

use TesteSoftexpert\Backend\Models\Tipo;
use TesteSoftexpert\Backend\Models\Produto;

if(array_key_exists('cadTipo', $_POST)) {
    //cadastra tipo
    $tipo = new Tipo($_POST['tipoNome'], $_POST['tipoImp']);
    $tipo->salvarTipo();
}

if(array_key_exists('cadProd', $_POST)) {
    //cadastra produto
    $produto = new Produto($_POST['prodNome'], $_POST['prodVal'], $_POST['prodTipo']);
    $produto->salvarProduto();
}

?>

<html>
    <head>
        <style>
            li {
                list-style: none;
            }
        </style>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </head>
    <body>
        <div>
            <h2>Cadastro de Tipo</h2>
            <ul>
                <form method="POST">
                    <li>Nome:</li>
                    <li><input type="text" name="tipoNome" id="tipoNome"></li>
                    <br>
                    <li>Imposto(%):</li>
                    <li><input type="number" name="tipoImp" id="tipoImp" step=".01"></li>
                    <br>
                    <li><input type="submit" name="cadTipo"></li>
                </form>
            </ul>        
        </div>
        <div>
            <h2>Cadastro de Produto</h2>
            <ul>
                <form method="POST">
                    <li>Nome:</li>
                    <li><input type="text" name="prodNome" id="prodNome"></li>
                    <br>
                    <li>Valor(R$):</li>
                    <li><input type="number" name="prodVal" id="prodVal" step=".01"></li>
                    <br>
                    <li>Tipo:</li>
                    <li><input type="number" name="prodTipo" id="prodTipo"></li>
                    <br>
                    <li><a href="index.php"><input type="submit" name="cadProd"></a></li>
                </form>
            </ul>
        </div>
        <div>
            <h2>Vendas</h2>
            
        </div>
    </body>
</html>
