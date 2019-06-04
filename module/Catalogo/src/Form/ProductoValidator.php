<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Catalogo\Form;

use Zend\InputFilter\InputFilter;

/**
 * Description of ProductoValidator
 *
 * @author enrique
 */
class ProductoValidator extends InputFilter {

    public function __construct() {
        $this->add([
            'name' => 'id',
            'filters' => [
                ['name' => 'Int'],
            ],
        ]);
        $this->add([
            'name' => 'descripcion',
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'Alnum',
                    'options' => [
                        'allowWhiteSpace' => true,
                    ],
                ],
            ],
        ]);
        $this->add([
            'name' => 'precio',
            'validators' => [
                [
                    'name' => 'Int',
                ],
            ],
        ]);
        $this->add([
            'name' => 'cantidad',
            'validators' => [
                [
                    'name' => 'Int',
                ],
            ],
        ]);
    }

}
