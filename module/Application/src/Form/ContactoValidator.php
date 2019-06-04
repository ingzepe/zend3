<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Form;

use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;
use Zend\InputFilter\Input;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\EmailAddress;


/**
 * Description of ContactoValidator
 *
 * @author enrique
 */
class ContactoValidator extends InputFilter {

    public function __construct() {
        $nombre = new Input('nombre');
        $nombre->getFilterChain()
                ->attachByName('StripTags')
                ->attachByName('StringTrim');
        $nombre->getValidatorChain()
                ->addValidator(new StringLength([
                    'min' => 4,
                    'max' => 14,]
                ))
                ->addValidator(new Alnum(['allowWhiteSpace' => true]));
        $email = new Input('email');
        $email->getValidatorChain()
                ->attach(new EmailAddress());
        $genero = new Input('genero');
        $genero->setRequired(false);
        $area = new Input('area');
        $area->setRequired(false);
        $tema = new Input('tema');
        $tema->setRequired(false)
                ->getValidatorChain()
                ->attach(new Alnum(['allowWhiteSpace' => true]));
        $mensaje = new Input('mensaje');
        $mensaje->getValidatorChain()
                ->attach(new Alnum(['allowWhiteSpace' => true]));
        $this->add($nombre);
        $this->add($email);
        $this->add($genero);
        $this->add($area);
        $this->add($tema);
        $this->add($mensaje);
    }

}
