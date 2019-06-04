<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Model\Dao;

use ArrayObject;
use Usuarios\Model\Entity\Usuario;

/**
 * Description of UsuarioDao
 *
 * @author enrique
 */
class UsuarioDao {
    
    private $listaUsuario;
    
    /**
     * realizar la carga de los datos ya conocidos y el objeto de lista debe ser atributo de la clase modelo (cargar 10 - 20 usuarios).
     */
    public function __construct() {
        $this->listaUsuario = new ArrayObject();
        $this->listaUsuario->append(new Usuario(1, "Andres", "Guzman"));
        $this->listaUsuario->append(new Usuario(2, "Linus", "Torvalds"));
        $this->listaUsuario->append(new Usuario(3, "Steve", "Jobs"));
        $this->listaUsuario->append(new Usuario(4, "Rasmus", "Lerdorf"));
        $this->listaUsuario->append(new Usuario(5, "Erich", "Gamma"));
        $this->listaUsuario->append(new Usuario(9, "James", "Gosling"));
        $this->listaUsuario->append(new Usuario(6, "Richard", "Helm"));
        $this->listaUsuario->append(new Usuario(7, "Ralph", "Johnson"));
        $this->listaUsuario->append(new Usuario(8, "John", "Vlissides"));
        $this->listaUsuario->append(new Usuario(10, "Bruce", "Lee"));
    }
    
    /**
     * recibir el listado de todos los usuarios.
     */
    public function obtenerTodos(){
        return $this->listaUsuario;
    }
    
    /**
     * obtener/retornar el usuario por id.
     * @param type $id
     */
    public function obtenerPorId($id){
        foreach ($this->listaUsuario as $usuario) {
            if($usuario->getId() == $id){
                return $usuario;
            }
        }
    }
    
    /**
     * retorna el listado de usuarios encontrado por ese nombre (el listado de usuarios retornado debe ser del tipo ArrayObject).
     * @param type $nombre
     */
    public function buscarPorNombre($nombre){
        $usuariosEncontrados = new ArrayObject();
        foreach ($this->listaUsuario as $usuario) {
            if($usuario->getNombre() == $nombre){
                $usuariosEncontrados->append($usuario);
            }
        }
        return $usuariosEncontrados;
    }
    
    public function obtenerCuenta($email, $password){
        return true;
    }
    
    
}
