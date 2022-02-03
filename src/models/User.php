<?php

class User
{
    private $id;
    private $email;
    private $password;
    private $name;
    private $role;

    public function __construct($id, $email, $password, $name, $role)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->role = $role;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }


}