<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Catalogo\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Catalogo\Model\Entity\Producto;

use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

use RuntimeException;

/**
 * Description of ProductoDao
 *
 * @author enrique
 */
class ProductoDao implements IProductoDao {

    protected $tableGateway;
    protected $tableCategoria;

    public function __construct(TableGateway $tableGateway, TableGateway $tableCategoria) {
        $this->tableGateway = $tableGateway;
        $this->tableCategoria = $tableCategoria;
    }

    public function obtenerPorId($id) {
        $rowset = $this->tableGateway->select(['id' => (int)$id]);
        $row = $rowset->current();
        if (!$row) {
            throw new \RuntimeException("No se pudo encontrar el Producto: $id");
        }
        return $row;
    }

    public function obtenerTodos() {
//        $resultSet = $this->tableGateway->select();
        $select = $this->tableGateway->getSql()->select();
        $dbAdapter = $this->tableGateway->getAdapter();
        $resultSetPrototype = $this->tableGateway->getResultSetPrototype();

        $select->join(['cat' => 'categorias'], 'cat.id = productos.categoria_id', ['categoriaId' => 'id', 'categoriaNombre' => 'nombre']);
        $select->order("id");
        
        $adapter = new DbSelect($select, $dbAdapter, $resultSetPrototype);
        $paginator = new Paginator($adapter);
        return $paginator;
    }

    public function eliminar(Producto $producto) {
        $this->tableGateway->delete(['id' => $producto->getId()]);
    }

    public function guardar(Producto $producto) {
        $data = ['descripcion' => $producto->getDescripcion(),
            'cantidad' => $producto->getCantidad(),
            'precio' => $producto->getPrecio(),];

        if ($producto->getCategoria() !== null) {
            $data['categoria_id'] = $producto->getCategoria()->getId();
        }

        $id = (int) $producto->getId();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->obtenerPorId($id)) {
                $this->tableGateway->update($data, ['id' => $id]);
            } else {
                throw new \RuntimeException('Id del Producto no existe');
            }
        }
    }

    public function obtenerCategorias() {
        return $this->tableCategoria->select();
    }

    public function obtenerCategoriasSelect() {
        $categorias = $this->obtenerCategorias();
        $result = [];
        foreach ($categorias as $cat) {
            $result[$cat->getId()] = $cat->getNombre();
        }
        return $result;
    }

}
