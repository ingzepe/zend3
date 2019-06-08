<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Model\Dao\IUsuarioDao;
use Usuarios\Model\Entity\Usuario;

use Usuarios\Form\Crear;
use Usuarios\Form\CrearValidator;

/**
 * Description of IndexController
 *
 * @author enrique
 */
class IndexController extends AbstractActionController {

    private $usuariosDao;
    private $config;

    public function __construct(IUsuarioDao $usuarioDao, array $config) {
        $this->usuariosDao = $usuarioDao;
        $this->config = $config;
    }

    public function indexAction() {
        return $this->redirect()->toRoute('usuarios', ['action' => 'listar']);
    }

    public function listarAction() {
        return new ViewModel(['listaUsuario' => $this->usuariosDao->obtenerTodos(),
            'titulo' => $this->config['parametros']['mvc']['usuario']['titulo']]);
    }

    public function verAction() {
        $id = (int) $this->params()->fromRoute("id", 0);

        $usuarios = $this->usuariosDao->obtenerPorId($id);

        return new ViewModel(['usuario' => $usuarios,
            'titulo' => "Detalle usuario"]);
    }

    public function buscarAction() {

        $nombre = $this->getRequest()->getPost("nombre");

        if (null === $nombre || empty($nombre)) {
            return $this->redirect()->toRoute('usuarios', array('action' => 'listar'));
        }

        $listaUsuario = $this->usuariosDao->buscarPorNombre($nombre);
        $viewModel = new ViewModel(array('listaUsuario' => $listaUsuario,
            'titulo' => 'Usuarios Encontrados (' . $listaUsuario->count() . ')'));

        $viewModel->setTemplate("/usuarios/index/listar");

        return $viewModel;
    }
    
    public function crearAction() {
        $form = $this->getForm();
        return new ViewModel(['titulo' => $this->config['parametros']['mvc']['usuario']['crear'], 'form' => $form]);
    }
    
    public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('usuarios');
        }
        $form = $this->getForm();
        $usuario = $this->usuariosDao->obtenerPorId($id);
        $form->bind($usuario);
        $form->get('guardar')->setAttribute('value', 'Editar');
        $modelView = new ViewModel(['titulo' => 'Editar Usuario', 'form' => $form]);
         $modelView->setTemplate('usuarios/index/crear');
        return $modelView;
    }
    
    public function guardarAction() {
        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute('usuarios');
        }
        $form = $this->getForm();
        $form->setInputFilter(new CrearValidator());

        $data = $this->request->getPost();
        $form->setData($data);

        if (!$form->isValid()) {
            $modelView = new ViewModel(['titulo' => 'Validando Usuario', 'form' => $form]);
            $modelView->setTemplate('usuarios/index/crear');
            return $modelView;
        }

        $dataForm = $form->getData();

        $usuario = new Usuario();
        $usuario->exchangeArray($dataForm);
        $this->usuariosDao->guardar($usuario);
        return $this->redirect()->toRoute('usuarios');
    }

    public function eliminarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('usuarios');
        }
        $usuario = new Usuario();
        $usuario->setId($id);
        $this->usuariosDao->eliminar($usuario);
        return $this->redirect()->toRoute('usuarios');
    }

    private function getForm() {
        return new Crear();
    }

}
