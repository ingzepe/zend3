<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Catalogo\Model\Dao;

use Catalogo\Model\Entity\Producto;

/**
 * Description of IProductoDao
 *
 * @author enrique
 */
interface IProductoDao {

    public function obtenerTodos();

    public function obtenerPorId($id);

    public function guardar(Producto $producto);

    public function eliminar(Producto $producto);
}
