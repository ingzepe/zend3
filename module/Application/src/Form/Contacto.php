<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Captcha;

/**
 * Description of Contacto
 *
 * @author enrique
 */
class Contacto extends Form {

    protected $captcha;

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

// Creamos un elemento text para capturar el nombre del usuario:
        $nombre = new Element\Text('nombre');
        $nombre->setLabel('Tu Nombre')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
        ]);
// Creamos un elemento email para capturar el correo del usuario:
        $email = new Element\Email('email');
        $email->setLabel('Email')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
                        ]
        );
// Creamos un elemento radio para el género:
        $genero = new Element\Radio('genero');
        $genero->setLabel('Genero')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',])
                ->setOptions(['value_options' => [
                        'H' => 'Hombre',
                        'M' => 'Mujer',
                    ],
                        ]
        );
// Creamos un elemento select para el area a contactar:
        $area = new Element\Select('area');
        $area->setLabel('Contactar a')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',])
                ->setOptions([
                    'value_options' => [
                        'Soporte' => 'Soporte',
                        'Ventas' => 'Ventas',
                        'Ingeniería' => 'Ingeniería',
                        'Compras' => 'Compras',
                    ],
                    'empty_option' => 'Seleccione un área de servicio =>',
        ]);
// Creamos un elemento text para el tema o sujeto:
        $tema = new Element\Text('tema');
        $tema->setLabel('tema')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
        ]);
// Creamos un elemento textarea para el mensaje:
        $mensaje = new Element\Textarea('mensaje');
        $mensaje->setLabel('Mensaje')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
        ]);
// Creamos un CAPTCHA:
        $captcha = new Element\Captcha('captcha');
        $captcha->setLabel('Compruebe que no es robot')
                ->setCaptcha($this->getCaptcha())
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
        ]);
// Creamos un CSRF token:
        $csrf = new Element\Csrf('csrf_token');
// Creamos un boton submit:
        $send = new Element\Submit('send');
        $send->setValue('Enviar');
        $send->setAttributes([
            'type' => 'submit',
            'class' => 'btn btn-primary',
        ]);
        $this->add($nombre);
        $this->add($email);
        $this->add($genero);
        $this->add($area);
        $this->add($tema);
        $this->add($mensaje);
        $this->add($captcha);
        $this->add($csrf);
        $this->add($send);
    }

    public function setCaptcha(CaptchaAdapter $captcha) {
        $this->captcha = $captcha;
    }

    public function getCaptcha() {
        if ($this->captcha === null) {
            $this->captcha = new Captcha\Dumb();
            $this->captcha->setLabel("Por favor, ingrese la palabra al revés");
        }
        return $this->captcha;
    }

}
