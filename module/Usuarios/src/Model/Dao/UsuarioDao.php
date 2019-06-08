<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Usuarios\Model\Entity\Usuario;
use Zend\Db\Sql\Select;

/**
 * Description of UsuarioDao
 *
 * @author enrique
 */
class UsuarioDao implements IUsuarioDao {

    protected $tableGateway;

    /**
     * realizar la carga de los datos ya conocidos y el objeto de lista debe ser atributo de la clase modelo (cargar 10 - 20 usuarios).
     */
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    /**
     * recibir el listado de todos los usuarios.
     */
    public function obtenerTodos() {
        return $this->tableGateway->select();
    }

    /**
     * obtener/retornar el usuario por id.
     * @param type $id
     */
    public function obtenerPorId($id) {
        $rowset = $this->tableGateway->select(['id' => (int) $id]);
        $row = $rowset->current();

        if (empty($row)) {
            throw new \Exception('No se puedo encontrar el registro ' . $id);
        }
        return $row;
    }

    /**
     * retorna el listado de usuarios encontrado por ese nombre (el listado de usuarios retornado debe ser del tipo ArrayObject).
     * @param type $nombre
     */
    public function buscarPorNombre($nombre) {
        $rowset = $this->tableGateway->select(['nombre' => $nombre]);
        $row = $rowset->current();

        if (empty($row)) {
            throw new \Exception('No se puedo encontrar el registro ' . $nombre);
        }
        return $row;
    }

    public function eliminar(Usuario $usuario) {
        $this->tableGateway->delete(array('id' => $usuario->getId()));
    }

    public function guardar(Usuario $usuario) {
        $data = array(
            'nombre' => $usuario->getNombre(),
            'apellido' => $usuario->getApellido(),
            'email' => $usuario->getEmail(),
            'password' => $usuario->getPassword(),
        );

        $id = (int) $usuario->getId();

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->obtenerPorId($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Usuario id does not exist');
            }
        }
    }

    public function obtenerCuenta($email, $password) {
        $select = $this->tableGateway->getSql()->select();
        $select->where(array('email' => $email, 'password' => $password,));

        return $this->tableGateway->selectWith($select)->current();
    }

}
