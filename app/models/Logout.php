<?php

class Logout
{

    public function __construct($db)
    {
        session_start();
        session_unset();

        session_destroy();
        header('location: /');
    }
}
