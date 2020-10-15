<?php

class BDD
{
    const HOST = "mysql-flo.alwaysdata.net";
    const DBNAME = "flo_formulaire";
    const USER = "flo_formulaire";
    const PWD = "Symfony";
    public $connexion;
    public function __construct()
    {


        try {
            // essaye de te connecter
            $this->connexion = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DBNAME, self::USER, self::PWD); //mysql avec Wampp

        } catch (Exception $e) {
            // On prépare un message d'erreur si le site ne peut pas accéder à la database
            echo "Erreur : " . $e->getMessage();
        }
    }
}
