<?php
    session_start();
    require_once __DIR__ . '/../vendor/autoload.php';

    use TesteSoftexpert\Backend\Connection;
    use TesteSoftexpert\Backend\Models\Venda;

    $db = new Connection();
    $listaProdutos = $db->buscarProdutos();

    if (isset($_POST["add"])) {
        if (isset($_SESSION["carrinho"])) {
            $idProduto = array_column($_SESSION["carrinho"], "prod_id");
            if (!in_array($_GET["prod_id"], $idProduto)) {
                $count = count($_SESSION["carrinho"]);
                $produto = array(
                    'prod_id'       => $_GET["prod_id"],
                    'prod_nome'     => $_POST["nomeProd"],
                    'prod_valor'    => $_POST["valorProd"],
                    'prod_qtd'      => $_POST["quantidade"],
                    'imposto'       => $_POST["impostoProd"],
                    'tipo'          => $_POST["tipoProd"]
                );
                $_SESSION["carrinho"][$count] = $produto;
                echo '<script>window.location="TelaVendas.php"</script>';
            } else {
                echo '<script>alert("Produto já adicionado ao carrinho, caso queira alterar a quantidade remova o produto do carrinho e adicione novamente com a quantidade desejada.")</script>';
                echo '<script>window.location="TelaVendas.php"</script>';
            }
        } else {
            $produto = array(
                'prod_id'       => $_GET["prod_id"],
                'prod_nome'     => $_POST["nomeProd"],
                'prod_valor'    => $_POST["valorProd"],
                'prod_qtd'      => $_POST["quantidade"],
                'imposto'       => $_POST["impostoProd"],
                'tipo'          => $_POST["tipoProd"]
            );
            $_SESSION["carrinho"][0] = $produto;
        }
    }
    
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "delete") {
            foreach ($_SESSION["carrinho"] as $keys => $valor) {
                if ($valor["prod_id"] == $_GET["prod_id"]) {
                    unset($_SESSION["carrinho"][$keys]);
                    echo '<script>window.location="TelaVendas.php"</script>';
                }
            }
        }
    }

    if (isset($_POST['save'])){
        foreach ($_SESSION["carrinho"] as $key => $valor) {
            $produto = $valor['prod_id'];
            $quantidade = $valor['prod_qtd'];
            $venda = new Venda($produto, $quantidade);
            $venda->salvarVenda();
        }
        unset($_SESSION['carrinho']);
        echo '<script>window.location="TelaVendas.php"</script>';
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Teste Softexpert</title>
</head>

<body>
    <a href="http://localhost:8080">Voltar</a>
    <div>
        <h1 align="left">Lista de Produtos</h1>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Qtd</th>
                    <th></th>
                </tr>
                <?php
                if (pg_num_rows($listaProdutos) > 0); {
                    while ($linha = pg_fetch_assoc($listaProdutos)) {
                ?>
                        <tr>
                            <form method="POST" action="TelaVendas.php?action=add&prod_id=<?php echo $linha["id"]; ?>">
                                <td><?php echo $linha["prod_nome"]; ?></td>
                                <td><?php echo $linha["tipo_nome"]; ?></td>
                                <td>R$<?php echo number_format($linha["prod_valor"], 2, ',', '.'); ?></td>
                                <td><input type="number" name="quantidade" placeholder="0" min="1" required></td>
                                <input type="hidden" name="nomeProd" value="<?php echo $linha["prod_nome"]; ?>" />
                                <input type="hidden" name="valorProd" value="<?php echo $linha["prod_valor"]; ?>" />
                                <input type="hidden" name="impostoProd" value="<?php echo $linha["tipo_imposto"]; ?>" />
                                <input type="hidden" name="tipoProd" value="<?php echo $linha["tipo_nome"]; ?>" />
                                <td><button type="submit" name="add">+</button></td>
                            </form>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
        
    </div>
    <?php
    if (!empty($_SESSION["carrinho"])) {
    ?>
        <div>
            <h1 align="left">Carrinho</h1>
            <div>
                <table class="table">
                    <tr>
                        <th>Nome</th>
                        <th>Qtd</th>
                        <th></th>
                        <th>Valor Unitário</th>
                        <th></th>
                        <th>Valor total</th>
                        <th></th>
                        <th>Valor imposto</th>
                        <th></th>
                    </tr>
                    <?php
                    $total = 0;
                    $totalImposto = 0;
                    foreach ($_SESSION["carrinho"] as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value["prod_nome"]; ?></td>
                            <td><?php echo $value["prod_qtd"]; ?></td>
                            <td></td>
                            <td>R$<?php echo number_format($value["prod_valor"], 2, ',', '.'); ?></td>
                            <td></td>
                            <td>R$<?php echo number_format($value["prod_qtd"] * $value["prod_valor"], 2, ',', '.'); ?></td>
                            <td></td>
                            <td>R$<?php echo number_format(($value["imposto"] / 100) * $value["prod_qtd"] * $value["prod_valor"], 2, ',', '.'); 
                                    ?></td>
                            <td><a href="TelaVendas.php?action=delete&prod_id=<?php echo $value["prod_id"]; ?>"><button>-</button></a></td>
                        </tr>
                    <?php
                        $totalImposto = $totalImposto + (($value["imposto"] / 100) * $value["prod_qtd"] * $value["prod_valor"]);
                        $total = $total + ($value["prod_qtd"] * $value["prod_valor"]) + $totalImposto;
                    }
                    ?>
                </table>
            </div>
        </div>
        <div>
            <div class="p-2">
                <h3 class="d-inline">Valor total da compra:</h3>
                <h3 class="d-inline">R$<?php echo number_format($total, 2, ',', '.'); ?></h3>
            </div>
            <div class="p-2">
                <h3 class="d-inline">Valor total dos impostos:</h3>
                <h3 class="d-inline">R$<?php echo number_format($totalImposto, 2, ',', '.'); ?></h3>
                
            </div>

            <form method="POST" action="TelaVendas.php">
                <button class="btn btn-success m-2" type="submit" name="save"><h3>Salvar Venda</h3></button>
            </form>
        </div>
    <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>