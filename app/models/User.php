<?php

class User
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        //$products = $this->db->query("SELECT * FROM users");

        return [
            "header" => new Template("views/components/headers/inner_header.html", []),
            "child" => new Template("views/home.html", [])
        ];
    }

    public function show($arg)
    {
        switch ($arg) {
            case "form":
                return [
                    "header" => new Template("views/components/headers/outter_header.html", []),
                    "child" => new Template("views/form.html", [])
                ];
                break;
        }
    }

    public function read($id)
    {
        # code...
    }

    public function create()
    {
        # code...
    }

    public function update($id)
    {
        # code...
    }

    public function delete($id)
    {
        # code...
    }
}
