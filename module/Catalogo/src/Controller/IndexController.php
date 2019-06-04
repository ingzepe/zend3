<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Catalogo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Catalogo\Model\Dao\IProductoDao;
use Catalogo\Model\Entity\Producto;
use Catalogo\Form\Producto as ProductoForm;
use Catalogo\Form\ProductoValidator;

/**
 * Description of IndexController
 *
 * @author enrique
 */
class IndexController extends AbstractActionController {

    private $produtoDao;

    public function __construct(IProductoDao $produtoDao) {
        $this->produtoDao = $produtoDao;
    }

    public function indexAction() {
        return [
            'titulo' => 'Lista de Productos',
            'productos' => $this->produtoDao->obtenerTodos()
        ];
    }

    public function crearAction() {
        $form = new ProductoForm("producto");
        $modelView = new ViewModel(['titulo' => 'Crear Producto', 'form' => $form]);
        $modelView->setTemplate('catalogo/index/form');
        return $modelView;
    }

//
//    public function editarAction() {
//        
//    }
//
//    public function guardarAction() {
//        
//    }
//
//    public function eliminarAction() {
//        
//    }
}
