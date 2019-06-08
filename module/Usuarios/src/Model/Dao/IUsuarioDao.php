<?php

namespace Usuarios\Model\Dao;

use Usuarios\Model\Entity\Usuario;

/**
 *
 * @author Andres
 */
interface IUsuarioDao {

    public function obtenerTodos();

    public function obtenerPorId($id);

    public function guardar(Usuario $usuario);

    public function eliminar(Usuario $usuario);

    public function buscarPorNombre($nombre);

    public function obtenerCuenta($email, $password);
}

