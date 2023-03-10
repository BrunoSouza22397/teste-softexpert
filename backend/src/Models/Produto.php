<?php

namespace TesteSoftexpert\Backend\Models;

use TesteSoftexpert\Backend\Connection;

/**
 * classe modelo para a tabela Produtos
 */
class Produto
{
    private $id;
    private $nome;
    private $valor;
    private $tipo;

    public function __construct(string $nome, float $valor, int $tipo)
    {
        $this->nome = $nome;
        $this->valor = $valor;
        $this->tipo = $tipo;
    }

    public function salvarProduto()
    {
        $db = new Connection();
        $query = "INSERT INTO public.\"Produtos\"(
            nome, valor, tipo)
            VALUES ('" . $this->nome . "', " . $this->valor . ", ". $this->tipo .")";

        $db->createQuery($query);
    }
}
