<?php

class User
{
    
    private $db;
    private $User;
    private $time = "10:00 AM";
    private $group = "1CM1";

    public function setUser($user){
        $this->User = $user;
    }

    public function getUser(){
        return $this->User;
    }

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
                        "col_size" => "12",
                        "title" => "Datos Personales",
                        "child" => new Template("views/components/display/user_data.html", [
                            "image" => $this->image,
                            "data" => $this->User
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "6",
                        "title" => "Horario de Examen",
                        "child" => new Template("views/components/display/big_data.html", [
                            "data" => $this->time
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "6",
                        "title" => "Grupo Asignado",
                        "child" => new Template("views/components/display/big_data.html", [
                            "data" => $this->group
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
            case "verified":
                return [
                    "header" => new Template("views/components/headers/outter_header.html", []),
                    "child" => new Template("views/verified.html", [])
                ];
                break;
        }
    }

    public function read($id)
    {
        # code...
    }

    public function create($data)
    {
        var_dump($data);    
        
        $query = "INSERT INTO Usuario VALUES ('".$data["boleta"]."', '".$data["boleta"]."', 2);";
        
        $this->db->executeQuery($query);

        $query = "INSERT INTO Alumno
            (boleta, nombre, apPat, apMat, telefono, correoE, genero, idEscuela, promedio, opcionESCOM, calle, colonia, numero, codigoP, idEntFed, fechNac, nombreEscuela, verificado)
             VALUES (
                '".$data["boleta"]."',
                '".$data["name"]."',
                '".$data["ApPat"]."',
                '".$data["ApMat"]."',
                '".$data["phone_number"]."',
                '".$data["email"]."',
                '".$data["sexo"]."', 
                ".$data["school_proc"].", 
                ".$data["score"].",
                ".$data["ESCOMopt"].",
                '".$data["street"]."',
                '".$data["colonia"]."',
                '".$data["num_street"]."',
                '".$data["postal_code"]."',
                ".$data["state"].",
                '".$data["birth"]."',
                '".$data["school"]."',
                1);";
        $this->db->executeQuery($query);
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

if(isset($_REQUEST["data"])){
    require_once("../controllers/db.class.php");
    $db = new DB();
    $user = new User($db);
    $user->create($_REQUEST["data"]);
}