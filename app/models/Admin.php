<?php

class Admin
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        //$user = $this->db->query("SELECT * FROM users");
        $image = $this->user["sexo"] == "Masculino" ? "logo_hombre" : "logo_mujer";
        return [
            "header" => new Template("views/components/headers/inner_header.html", []),
            "child" => new Template("views/home.html", [
                "cards" => array(
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "4",
                        "title" => "Administradores",
                        "child" => new Template("views/components/tables/table.html", [
                            "title" => "Admins",
                            "data" => array(
                                array(
                                    "id" => 1,
                                    "name" => "Name 1"
                                ),
                                array(
                                    "id" => 2,
                                    "name" => "Name 2"
                                )
                            ),
                            "insertModal" => new Template("views/components/forms/Admins/insert.html", []),
                            "deleteModal" => new Template("views/components/forms/Admins/delete.html", []),
                            "updateModal" => new Template("views/components/forms/Admins/update.html", []),
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "4",
                        "title" => "Horarios de Examen",
                        "child" => new Template("views/components/tables/table.html", [
                            "title" => "Schedule",
                            "data" => array(
                                array(
                                    "id" => 1,
                                    "name" => "Name 3"
                                ),
                                array(
                                    "id" => 2,
                                    "name" => "Name 4"
                                )
                            ),
                            "insertModal" => new Template("views/components/forms/Schedule/insert.html", []),
                            "deleteModal" => new Template("views/components/forms/Schedule/delete.html", []),
                            "updateModal" => new Template("views/components/forms/Schedule/update.html", []),
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "4",
                        "title" => "Alumnos inscritos",
                        "child" => new Template("views/components/tables/table.html", [
                            "title" => "Students",
                            "data" => array(
                                array(
                                    "id" => 1,
                                    "name" => "Name 5"
                                ),
                                array(
                                    "id" => 2,
                                    "name" => "Name 6"
                                )
                            ),
                            "insertModal" => new Template("views/components/forms/Students/insert.html", []),
                            "deleteModal" => new Template("views/components/forms/Students/delete.html", []),
                            "updateModal" => new Template("views/components/forms/Students/update.html", []),
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "12",
                        "title" => "Alumnos registrados"
                    ])
                )
            ])
        ];
    }

    public function show($arg)
    {
        # code...
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
