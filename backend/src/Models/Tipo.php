<?php
namespace TesteSoftexpert\Backend\Models;

use TesteSoftexpert\Backend\Connection;

/**
 * classe modelo para a tabela Tipos
 */
class Tipo
{
    private $id;
    private $nome;
    private $imposto;

    public function __construct(string $nome, float $imposto)
    {
        $this->nome = $nome;
        $this->imposto = $imposto;
    }

    public function salvarTipo()
    {
        $db = new Connection();
        $query = "INSERT INTO public.\"Tipos\"(
            nome, porcentagem_imposto)
            VALUES ('". $this->nome ."', ". $this->imposto .")";

        $db->createQuery($query);
    }
}