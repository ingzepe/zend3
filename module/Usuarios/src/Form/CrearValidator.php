<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Form;

use Zend\InputFilter\InputFilter;

use Zend\Mvc\I18n\Translator as TranslatorMvc;
use Zend\I18n\Translator\Translator;
use Zend\Validator\AbstractValidator;

/**
 * Description of CrearValidator
 *
 * @author enrique
 */
class CrearValidator extends InputFilter {

    public function __construct() {
        $translator = new TranslatorMvc(new Translator());
        $translator->addTranslationFile('phparray', './module/Application/language/es_ES.php');
        AbstractValidator::setDefaultTranslator($translator);
        
        $this->add(
                ['name' => 'nombre',
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' => [
                        [
                            'name' => 'Alnum',
                        ],
                    ],
        ]);
        $this->add(
                ['name' => 'apellido',
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' => [
                        [
                            'name' => 'Alnum',
                        ],
                    ],
        ]);
        $this->add(
                ['name' => 'email',
                    'validators' => [
                        [
                            'name' => 'EmailAddress',
                        ],
                    ],
        ]);
        $this->add(
                ['name' => 'usuario',
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' => [
                        [
                            'name' => 'StringLength',
                            'options' => [
                                'min' => 5,
                                'max' => 10,
                            ],
                        ],
                        [
                            'name' => 'Alnum',
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
