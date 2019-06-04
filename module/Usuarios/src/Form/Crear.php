<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Element\Text;
use Zend\Form\Element\Email;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;

/**
 * Description of Crear
 *
 * @author enrique
 */
class Crear extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $nombre = new Text('nombre');
        $nombre->setAttribute('class', 'form-control')
                ->setLabel('Nombre')
                ->setLabelAttributes(['class' => 'col-sm-2 control-label']);

        $apellido = new Text('apellido');
        $apellido->setAttribute('class', 'form-control')
                ->setLabel('Apellido')
                ->setLabelAttributes(['class' => 'col-sm-2 control-label']);
        
        $email = new Email('email');
        $email->setAttribute('class', 'form-control')
                ->setLabel('Email')
                ->setLabelAttributes(['class' => 'col-sm-2 control-label']);
        
        $usuario = new Text('usuario');
        $usuario->setAttribute('class', 'form-control')
                ->setLabel('Usuario')
                ->setLabelAttributes(['class' => 'col-sm-2 control-label']);
        
        $password = new Password('password');
        $password->setAttribute('class', 'form-control')
                ->setLabel('Password')
                ->setLabelAttributes(['class' => 'col-sm-2 control-label']);
        
        $guardar = new Submit('guardar');
        $guardar->setAttributes(['type' => 'submit', 'value' => 'Guardar', 'class' => 'btn btn-primary']);
        
        $this->add($nombre);
        $this->add($apellido);
        $this->add($email);
        $this->add($usuario);
        $this->add($password);
        $this->add($guardar);
        
        
    }

}
