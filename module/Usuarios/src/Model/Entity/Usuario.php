<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Model\Entity;

/**
 * Description of Usuario
 *
 * @author enrique
 */
class Usuario {

    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;

    public function __construct($id = null, $nombre = null, $apellido = null, $email = null, $password = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->apellido = (isset($data['apellido'])) ? $data['apellido'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
