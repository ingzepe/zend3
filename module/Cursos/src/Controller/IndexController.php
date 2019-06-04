<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cursos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Description of IndexController
 *
 * @author enrique
 */
class IndexController extends AbstractActionController {

    public function listarAction() {
        return new ViewModel(array('cursos' => ['Symfony 3', 'Laravel 5', 'Zend Framework 3', 'CodeIgniter 3']));
    }

}
