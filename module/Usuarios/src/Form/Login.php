<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Element\Email;
use Zend\Form\Element\Password;

/**
 * Description of Login
 *
 * @author enrique
 */
class Login extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $email = new Email('email');
        $email->setAttribute('class', 'form-control')
                ->setLabel('Email')
                ->setLabelAttributes(['class' => 'col-sm-2 control-label']);
        
        $password = new Password('password');
        $password->setAttribute('class', 'form-control')
                ->setLabel('Password')
                ->setLabelAttributes(['class' => 'col-sm-2 control-label']);
        
        $send = new Element\Submit('send');
        $send->setAttributes(['type' => 'submit', 'value' => 'Login', 'class' => 'btn btn-primary']);
        
        $this->add($email);
        $this->add($password);
        $this->add($send);
        
    }

}
