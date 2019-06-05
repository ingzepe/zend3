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
        $paginator = $this->produtoDao->obtenerTodos();
        $paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
        $paginator->setItemCountPerPage(5);
        return [
            'titulo' => 'Lista de Productos',
            'productos' => $paginator->getIterator(),
            'paginator' => $paginator,
        ];
    }

    public function crearAction() {
//        $form = new ProductoForm("producto");
        $modelView = new ViewModel(['titulo' => 'Crear Producto', 'form' => $this->getForm()]);
        $modelView->setTemplate('catalogo/index/form');
        return $modelView;
    }

    public function guardarAction() {
        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute('catalogo');
        }
        $form = $this->getForm();
        $form->setInputFilter(new ProductoValidator());

        $data = $this->request->getPost();
        $form->setData($data);

        if (!$form->isValid()) {
            $modelView = new ViewModel(['titulo' => 'Validando Producto', 'form' => $form]);
            $modelView->setTemplate('catalogo/index/form');
            return $modelView;
        }

        $dataForm = $form->getData();
        $dataForm['categoria_id'] = $dataForm['categoria'];

        $producto = new Producto();
        $producto->exchangeArray($dataForm);
        $this->produtoDao->guardar($producto);
        return $this->redirect()->toRoute('catalogo');
    }

//
    public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('catalogo');
        }
        $form = $this->getForm();
        $producto = $this->produtoDao->obtenerPorId($id);
        $form->bind($producto);
        $form->get('send')->setAttribute('value', 'Editar');
        $modelView = new ViewModel(['titulo' => 'Editar Producto', 'form' => $form]);
        $modelView->setTemplate('catalogo/index/form');
        return $modelView;
    }

    public function eliminarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('catalogo');
        }
        $producto = new Producto();
        $producto->setId($id);
        $this->produtoDao->eliminar($producto);
        return $this->redirect()->toRoute('catalogo');
    }

    private function getForm() {
        $form = new ProductoForm("producto");
        $form->get('categoria')->setValueOptions($this->produtoDao->obtenerCategoriasSelect());
        return $form;
    }

}
