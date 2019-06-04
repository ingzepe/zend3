<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Model\Dao\UsuarioDao;
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

    public function __construct(UsuarioDao $usuarioDao, array $config) {
        $this->usuariosDao = $usuarioDao;
        $this->config = $config;
    }

    public function indexAction() {
        return $this->redirect()->toRoute('usuarios', ['action' => 'listar']);
    }

    public function listarAction() {
        $titulo = $this->config['parametros']['mvc']['usuario']['titulo'];
        return new ViewModel(['listaUsuario' => $this->usuariosDao->obtenerTodos(),
            'titulo' => $titulo]);
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
    
    public function crearAction(){
        return ['titulo' => 'Alta', 'form' => new Crear('Alta')];
    }
    
    public function guardarAction(){
        if(!$this->request->isPost()){
            $this->redirect()->toRoute('login', ['action' => 'index']);
        }
        
        $form = new Crear('Alta');
        $form->setInputFilter(new CrearValidator('Alta'));
        
        $data = $this->request->getPost();
        $form->setData($data);
        
        if(!$form->isValid()){
            $modelView = new ViewModel(['titulo' => 'Alta', 'form' => $form]);
            $modelView->setTemplate('usuarios/index/crear');
            return $modelView;
        }
        
        $values = $form->getData();

        $usuario = new Usuario(0);
        $usuario->exchangeArray($values);

        return new ViewModel(array('titulo' => $this->config['parametros']['mvc']['usuario']['guardar'], 'form' => $form, 'usuario' => $usuario));

    }

}
