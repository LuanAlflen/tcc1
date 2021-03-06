<?php

class Usuario
{
    public $id;
    public $nome;
    public $login;
    public $senha;
    public $email;
    public $telefone;
    public $cpf;
    public $tipuser;

    public function __construct($nome=null, $login=null, $senha=null, $email=null, $telefone=null, $cpf=null, $tipuser=null, $id=null){
        $this->nome = $nome;
        $this->login = $login ;
        $this->senha = $senha;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->cpf = $cpf;
        $this->tipuser = $tipuser;
        $this->id = $id;

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getTipuser()
    {
        return $this->tipuser;
    }

    public function setTipuser($tipuser)
    {
        $this->tipuser = $tipuser;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
}


