<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Description of Estudiante
 *
 * @author enrique
 */
class Estudiante extends Form{
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        
        $username = new Element\Text('username');
        $username->setAttribute('class', 'form-control')
                ->setLabel('Username')
                ->setLabelAttributes(['class' =>'col-sm-2 control-label']);
        $this->add($username);
        
        $direccion = new Element\Text('direccion');
        $direccion->setLabel('Dirección')
                ->setLabelAttributes(['class' => 'col-sm-2 control-label']);
        $this->add($direccion);
    }
}
