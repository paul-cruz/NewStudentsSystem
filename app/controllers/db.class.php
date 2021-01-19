<?php

class DB
{

    private $db;

    public function __construct()
    {
        $this->db = new mysqli("172.18.0.2", "test", "test", "students_system");
    }

    public function query($sql)
    {
        $result = $this->db->query($sql);

        $arr = [];

        while ($row = $result->fetch_object()) {
            $arr[] = $row;
        }

        return $arr;
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
