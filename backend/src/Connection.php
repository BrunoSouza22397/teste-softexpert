<?php

namespace TesteSoftexpert\Backend;

/**
 * Classe responsável por controlar conexão com o banco e realizar buscas
 */
class Connection
{
    private $db;

    public function __construct()
    {
        $this->db = pg_connect("host=localhost dbname=softexpert user=postgres password=admin")
            or exit('Could not connect: ' . pg_last_error());
    }

    /**
     * realiza uma busca de acordo com a $query recebida
     */
    public function createQuery(string $query)
    {
        $result = pg_query($this->db, $query) or exit('Query failed: ' . pg_last_error());

        $return = pg_fetch_all($result);
        
        return $return;
    }

    /**
     * Busca produtos para a lista de produtos da tela de vendas
     */
    public function buscarProdutos()
    {
        $query = "SELECT p.id, p.nome prod_nome, p.valor prod_valor, t.id tipo_id, t.nome tipo_nome, t.porcentagem_imposto tipo_imposto
        FROM public.\"Produtos\" p
        INNER JOIN public.\"Tipos\" t
            ON p.tipo = t.id
        ORDER BY p.nome ASC";
        
        $result = pg_query($this->db, $query) or exit('Query failed: ' . pg_last_error());

        return $result;
    }

    /**
     * busca lista de produtos e quantidades para a tabela de estoque
     */
    public function buscarEstoque()
    {
        $query = "SELECT id, nome FROM public.\"Produtos\"";
        $idProdutos = pg_query($this->db, $query) or exit('Query failed: ' . pg_last_error());

        $result = array();

        if(pg_num_rows($idProdutos) > 0) {
            $listaIds = pg_fetch_all($idProdutos);
            foreach ($listaIds as $key => $value) {
                $query = "SELECT SUM(quantidade) FROM public.\"Vendas\" WHERE produto = ".$value['id'];
                $quantidade = pg_query($this->db, $query);
                if (pg_num_rows($quantidade) > 0) {
                    $quantidade = pg_fetch_result($quantidade, 0, 0);
                } else {
                    $quantidade = 0;
                }

                $r = ["id" => $value['id'], "produto" => $value['nome'], "quantidade" => $quantidade];
                array_push($result, $r);
            }
        }

        return $result;
    }

    /**
     * busca tipos para a seleção no cadastro de produtos
     */
    public function buscarTipos() {
        $query = "SELECT id, nome FROM public.\"Tipos\"";
        $result = pg_query($this->db, $query) or exit('Query failed: ' . pg_last_error());

        $return = pg_fetch_all($result);
     
        return $return;
    }

}
