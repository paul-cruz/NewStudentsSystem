<?php

class DB
{

    private $db;

    public function __construct()
    {
        $this->db = new mysqli("mysql-server", "root", "secret", "students_system");
    }

    /*public function query($sql)
    {
        $result = $this->db->query($sql);

        $arr = [];

        while ($row = $result->fetch_object()) {
            $arr[] = $row;
        }

        return $arr;
    }*/

    public function executeQuery($sql) {
        if(mysqli_query($this->db, $sql)){
            var_dump("Registrado!");
        } else {
            var_dump("error!");
            echo "Error: " . $sql . "" . mysqli_error($this->db);
        }
    }

    public function queryOne($sql)
    {
        $result = $this->db->query($sql);

        return $result->fetch_object();
    }

    public function escape($str)
    {
        return $this->db->escape_string($str);
    }
}
