<?php

class Utilisateur
{
    private $nom;
    private $mail;
    private $message;


    public function setnom($nom)
    {
        $this->nom = $nom;
    }
    public function getnom()
    {
        return $this->nom;
    }

    public function setmail($mail)
    {
        $this->mail = $mail;
    }
    public function getmail()
    {
        return $this->mail;
    }

    public function setmessage($message)
    {
        $this->message = $message;
    }
    public function getmessage()
    {
        return $this->message;
    }
}
