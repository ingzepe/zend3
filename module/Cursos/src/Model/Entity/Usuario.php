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

    public function __construct($id, $nombre, $apellido) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

}
