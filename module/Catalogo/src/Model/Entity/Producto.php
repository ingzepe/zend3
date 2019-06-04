<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Catalogo\Model\Entity;

/**
 * Description of Producto
 *
 * @author enrique
 */
class Producto {

    private $id;
    private $descripcion;
    private $precio;
    private $cantidad;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->cantidad = (isset($data['cantidad'])) ? $data['cantidad'] : null;
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
        $this->precio = (isset($data['precio'])) ? $data['precio'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
