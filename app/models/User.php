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
        //$user = $this->db->query("SELECT * FROM users");
        $user = [
            "boleta" => "0000000000",
            "name" => "Juan Paul Cruz Cruz",
            "born" => "08/12/2000",
            "sexo" => "Masculino",
            "curp" => "XXXX000000XXXXXXX0",
            "addr" => "calle numero, colonia cp",
            "phone" => "5555555555",
            "email" => "email@example.com",
            "high_school" => "CECyT 13 Ricardo Flores Magón",
            "state" => "CDMX",
            "high_school_name" => null,
            "score" => "9.62",
            "opt" => "1",
        ];
        $time = "10:00 AM";
        $group = "1CM1";
        $image = $user["sexo"] == "Masculino" ? "logo_hombre" : "logo_mujer";
        return [
            "header" => new Template("views/components/headers/inner_header.html", []),
            "child" => new Template("views/home.html", [
                "cards" => array(
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "12",
                        "title" => "Datos Personales",
                        "child" => new Template("views/components/display/user_data.html", [
                            "image" => $image,
                            "data" => $user
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "6",
                        "title" => "Horario de Examen",
                        "child" => new Template("views/components/display/big_data.html", [
                            "data" => $time
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "6",
                        "title" => "Grupo Asignado",
                        "child" => new Template("views/components/display/big_data.html", [
                            "data" => $group
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "12",
                        "title" => "Recursos estudiantiles"
                    ])
                )
            ])
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
