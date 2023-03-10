<?php

namespace TesteSoftexpert\Backend;

class Connection
{
    private $db;

    public function __construct()
    {
        $this->db = pg_connect("host=localhost dbname=softexpert user=postgres password=admin")
            or exit('Could not connect: ' . pg_last_error());
    }

    public function close()
    {
        pg_close($this->db);
    }

    public function createQuery(string $query)
    {
        $result = pg_query($this->db, $query) or exit('Query failed: ' . pg_last_error());

        $resultset = array();
        while ($row = pg_fetch_row($result)) {
        $resultset[] = $row;
        }

        echo json_encode($resultset);

        pg_free_result($result);

        $this->close();
    }

}
