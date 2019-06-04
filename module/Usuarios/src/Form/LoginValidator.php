<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Form;

use Zend\InputFilter\InputFilter;

/**
 * Description of LoginValidator
 *
 * @author enrique
 */
class LoginValidator extends InputFilter {

    public function __construct() {
        $this->add(
                ['name' => 'email',
                    'validators' => [
                        [
                            'name' => 'EmailAddress',
                        ],
                    ],
        ]);
        $this->add(
                ['name' => 'password',
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' => [
                        [
                            'name' => 'StringLength',
                            'options' => [
                                'min' => 4,
                                'max' => 8,
                            ],
                        ],
                        [
                            'name' => 'Alnum',
                        ],
                    ],
        ]);
    }

}
