<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cursos;

use Zend\Mvc\MvcEvent;

/**
 * Description of Module
 *
 * @author enrique
 */
class Module {

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function init($mm){
        $eventManager = $mm->getEventManager();
        $sharedEvents = $eventManager->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, [$this, 'setLayout']);
    }
    
    public function setLayout($e){
        $viewModel = $e->getViewModel();
        $viewModel->setTemplate('layout/layout_curso');
    }
}
