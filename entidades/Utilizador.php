<?php

class Utilizador{
    public $nome;
    public $password;
    public $email;
    public $morada;
    public $telefone;

public function __construct($nome,$password,$email,$morada,$telefone){
    $this->nome = $nome;
    $this->password = $password;
    $this->email=$email;
    $this->morada=$morada;
    $this->telefone=$telefone;	
} 
}
?>