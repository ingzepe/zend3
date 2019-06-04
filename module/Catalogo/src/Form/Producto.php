<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Catalogo\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Description of Producto
 *
 * @author enrique
 */
class Producto extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'descripcion',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Descripcion',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'precio',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Precio',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'cantidad',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Cantidad',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);
        $this->add([
            'name' => 'send',
            'type' => Element\Submit::class,
            'attributes' => [
                'value' => 'Crear',
                'class' => 'btn btn-primary',
            ],
        ]);
    }

}
