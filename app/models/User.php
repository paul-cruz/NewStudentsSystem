<?php

class User
{

    private $db;

    public function setUser($user)
    {
        $this->User = $user;
    }

    public function getUser()
    {
        return $this->User;
    }

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        session_start();

        if (!isset($_SESSION['rol'])) {
            header('location: /');
        } else {
            if ($_SESSION['rol'] != 2) {
                header('location: /');
            }
        }
        $user = (array) $this->db->queryOne("SELECT boleta AS 'Numero de Boleta', Alumno.nombre AS 'Nombre', apPat AS 'Apellido Paterno', apMat AS 'Apellido Materno', telefono AS 'Telefono', correoE AS 'Correo Electronico', genero AS 'Genero', Grupo.idGrupo AS 'Grupo', Grupo.horaExamen AS 'Horario', CatalogoDeEscuelas.nombre AS 'Escuela', promedio AS 'Promedio', opcionESCOM AS'Opcion ESCOM', calle AS 'Calle', colonia AS 'Colonia', numero AS 'Numero', codigoP AS 'CP', EntidadFederativa.nombre AS 'Entidad Federativa', fechNac AS 'Fecha de nacimiento', nombreEscuela AS 'Nombre Escuela', verificado AS 'Verificado' FROM Alumno INNER JOIN EntidadFederativa ON Alumno.idEntFed = EntidadFederativa.idEntFed LEFT JOIN CatalogoDeEscuelas ON Alumno.idEscuela = CatalogoDeEscuelas.idEscuela INNER JOIN Grupo ON Alumno.grupo = Grupo.idGrupo WHERE boleta = '" . $_SESSION['idUsuario'] . "'");
        if ($user == false) {
            header('location: /User/form');
        }

        $image = $user["Genero"] == "M" ? "logo_hombre" : "logo_mujer";
        $user["Genero"] = $user["Genero"] == "M" ? "Masculino" : "Femenino";
        $group = $user["Grupo"];
        unset($user["Grupo"]);
        $time = $user["Horario"];
        unset($user["Horario"]);
        $_SESSION['verified'] = $user["Verificado"];
        unset($user["Verificado"]);
        if ($user["Escuela"]) {
            unset($user["Nombre Escuela"]);
        } else {
            $user["Escuela"] = $user["Nombre Escuela"];
            unset($user["Nombre Escuela"]);
        }


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
        session_start();

        if (!isset($_SESSION['rol'])) {
            header('location: /');
        } else {
            if ($_SESSION['rol'] != 2) {
                header('location: /');
            }
        }

        switch ($arg) {
            case "form":
                if ($_SESSION['verified'] == 1) {
                    header('location: /User');
                }
                return [
                    "header" => new Template("views/components/headers/outter_header.html", []),
                    "child" => new Template("views/form.html", [])
                ];
                break;
            case "verified":
                if ($_SESSION['verified'] == 1) {
                    header('location: /User');
                }
                return [
                    "header" => new Template("views/components/headers/outter_header.html", []),
                    "child" => new Template("views/verified.html", [])
                ];
                break;
            case "update":
                return [
                    "header" => new Template("views/components/headers/outter_header.html", []),
                    "child" => new Template("views/updateForm.html")
                ];
                break;
        }
    }

    public function read($id) 
    {
        $boleta = $_SESSION["idUsuario"];
        $query = "SELECT * FROM Alumno WHERE boleta='".$boleta."';";
        $result = $this->db->executeQuery($query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo $row["boleta"].",".$row["nombre"].",".$row["apPat"].",".$row["apMat"].",".$row["correoE"].",".$row["telefono"].",".$row["fechNac"].",".$row["genero"].",".$row["curp"].",".$row["grupo"].",".$row["idEscuela"].",".$row["promedio"].",".$row["opcionESCOM"].",".$row["calle"].",".$row["colonia"].",".$row["numero"].",".$row["codigoP"].",".$row["idEntFed"].",".$row["fechNac"].",".$row["nombreEscuela"];
            }
          } else {
            echo "0 results";
          }
    }

    public function create($data)
    {
        var_dump($data);
        $group = $this->getGroup();
        $query = "INSERT INTO Alumno
            (boleta, nombre, apPat, apMat, telefono, correoE, genero, idEscuela, promedio, opcionESCOM, calle, colonia, numero, codigoP, idEntFed, fechNac, nombreEscuela, curp, grupo, verificado)
             VALUES (
                '" . $data["boleta"] . "',
                '" . $data["name"] . "',
                '" . $data["ApPat"] . "',
                '" . $data["ApMat"] . "',
                '" . $data["phone_number"] . "',
                '" . $data["email"] . "',
                '" . $data["sexo"] . "', 
                " . $data["school_proc"] . ", 
                " . $data["score"] . ",
                " . $data["ESCOMopt"] . ",
                '" . $data["street"] . "',
                '" . $data["colonia"] . "',
                '" . $data["num_street"] . "',
                '" . $data["postal_code"] . "',
                " . $data["state"] . ",
                '" . $data["birth"] . "',
                '" . $data["school"] . "',
                '" . $data["curp"] . "',
                '" . $group["idGrupo"] . "',
                1);";
        $this->db->executeQuery($query);
        $i = intval($group["inscritos"]) + 1;
        $query = "UPDATE Grupo SET inscritos = '" . $i . "' WHERE idGrupo = '" . $group["idGrupo"] . "'";
        $this->db->executeQuery($query);
        session_start();
        $_SESSION['verified'] = 1;
    }

    public function getGroup()
    {
        $row = (array) $this->db->queryOne("SELECT * FROM Grupo WHERE inscritos < 25 ORDER BY horaExamen LIMIT 1");
        return $row;
    }

    public function update($data)
    {
        $query = "UPDATE Alumno SET nombre = '".$data["name"]."', apPat = '".$data["ApPat"]."', apMat = '".$data["ApMat"]."', telefono = '".$data["phone_number"]."', correoE = '".$data["email"]."', genero = '".$data["sexo"]."', curp = '".$data["curp"]."', idEscuela = ".$data["school_proc"].", promedio = ".$data["score"].", opcionESCOM = ".$data["ESCOMopt"].", calle = '".$data["street"]."', colonia = '".$data["colonia"]."', numero = '".$data["num_street"]."', codigoP = '".$data["postal_code"]."', idEntFed = ".$data["state"].", fechNac = '".$data["birth"]."', nombreEscuela = '".$data["school"]."' WHERE boleta = '".$data["boleta"]."';";
        $row = $this->db->executeQuery($query);
        return $row;
    }

    public function delete($id)
    {
        # code...
    }
}

if (isset($_REQUEST["data"])) {
    require_once("../controllers/db.class.php");
    $db = new DB();
    $user = new User($db);
    $user->create($_REQUEST["data"]);
}

if(isset($_REQUEST["get"])){
    require_once("../controllers/db.class.php");
    session_start();
    $db = new DB();
    $user = new User($db);
    $user->read($_REQUEST["get"]);
}

if(isset($_REQUEST["update"])){
    require_once("../controllers/db.class.php");
    session_start();
    $db = new DB();
    $user = new User($db);
    $user->update($_REQUEST["update"]);
}