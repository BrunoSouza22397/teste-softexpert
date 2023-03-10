<?php
namespace TesteSoftexpert\Backend\Models;

use TesteSoftexpert\Backend\Connection;

/**
 * classe modelo para a tabela Vendas
 */
class Venda
{
    private $id;
    private $produto;
    private $quantidade;

    public function __construct(int $idProduto, int $qtd)
    {
        $this->produto = $idProduto;
        $this->quantidade = $qtd;
    }

    public function salvarVenda()
    {
        $db = new Connection();
        $query = "INSERT INTO public.\"Vendas\"(
            produto, quantidade)
            VALUES ('" . $this->produto . "', " . $this->quantidade . ")";

        $db->createQuery($query);
    }
}