<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\Contacto as ContactoForm;
use Application\Form\ContactoValidator;

/**
 * Description of ContactoController
 *
 * @author enrique
 */
class ContactoController extends AbstractActionController {
    
    public function formAction(){
        $form = new ContactoForm('contacto');
        return ['form' => $form, 'titulo' => 'Formulario con ZF3'];
    }
    
    public function resultadoAction(){
        $form = new ContactoForm('contacto');
        
        $form->setInputFilter(new ContactoValidator());
        
        $data = $this->request->getPost();
        $form->setData($data);
        
        if($form->isValid()){
            
        }else{
            
        }
        exit();
    }
}
