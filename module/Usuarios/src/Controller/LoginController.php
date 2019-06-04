<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Form\Login;
use Usuarios\Form\LoginValidator;

use Usuarios\Model\Dao\UsuarioDao;

/**
 * Description of LoginController
 *
 * @author enrique
 */
class LoginController extends AbstractActionController{
    //put your code here
    private $usuarioDao;
    
    public function __construct(UsuarioDao $usuarioDao) {
        $this->usuarioDao = $usuarioDao;
    }
    
    public function indexAction() {
        return ['titulo' => 'Login', 'form' => new Login('login')];
    }
    
    public function autenticarAction(){
        if(!$this->request->isPost()){
            $this->redirect()->toRoute('login', ['action' => 'index']);
        }
        
        $form = new Login('login');
        $form->setInputFilter(new LoginValidator('login'));
        
        $data = $this->request->getPost();
        $form->setData($data);
        
        if(!$form->isValid()){
            $modelView = new ViewModel(['titulo' => 'Login', 'form' => $form]);
            $modelView->setTemplate('usuarios/login/index');
            return $modelView;
        }
        
        $values = $form->getData();
        $cuentaUsuario = $this->usuarioDao->obtenerCuenta($values['email'], $values['password']);
        
        if($cuentaUsuario != null){
            $this->layout()->mensaje = "Login Correcto!!!";
            $this->layout()->colorMensaje = "green";
            return $this->forward()->dispatch(LoginController::class, ['action' => 'success']);
        }else{
            $this->layout()->mensaje = "Login Incorrecto";
            return $this->forward()->dispatch(LoginController::class, ['action' => 'index']);
        }
    }
    
    public function successAction(){
        return ['titulo' => 'Página de exito'];
    }
}
