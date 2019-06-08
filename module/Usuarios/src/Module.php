<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios;

use Zend\Mvc\MvcEvent;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Usuarios\Model\Dao\IUsuarioDao;
use Usuarios\Model\Dao\UsuarioDao;
use Usuarios\Model\Entity\Usuario;

/**
 * Description of Module
 *
 * @author enrique
 */
class Module {

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap($e) {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, [$this, 'tiempoTranscurridoPre'], 100);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, [$this, 'tiempoTranscurridoPost'], -100);

        $application = $e->getParam('application');
        $application->getEventManager()->attach(MvcEvent::EVENT_DISPATCH, [$this, 'setLayout'], -100);
    }

    public function tiempoTranscurridoPre(MvcEvent $e) {
        // Calcular milisegundos tiempo de   inicio/partida del dispatch   
        // Guardar calculo time inicio en service   manager, ejemplo:
        $application = $e->getApplication();
        $sm = $application->getServiceManager();
        $sm->setService('TimeInicio', microtime(true));
    }

    public function tiempoTranscurridoPost(MvcEvent $e) {
        // Calcular milisegundos tiempo de   término (después del dispatch)   
        // Restar ambos para el resultado   final (obtener time inicio desde el service manager)   
        // Pasar un texto con el resultado   final a un atributo del layout, ejemplo:
        $application = $e->getApplication();
        $sm = $application->getServiceManager();

        $timeInicio = $sm->get('TimeInicio');
        $timeFin = microtime(true);

        $resultado = ($timeFin - $timeInicio) * 1000;

        $e->getViewModel()->setVariable('tiempoCarga', "El tiempo de carga es de {$resultado} milisegundos");
    }

    public function getServiceConfig() {
        return [
            'factories' => [
                IUsuarioDao::class => function($sm) {
                    $tableGateway = $sm->get('UsuarioTableGateway');
                    $dao = new UsuarioDao($tableGateway);
                    return $dao;
                },
                'UsuarioTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Usuario());
                    return new TableGateway('usuarios', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function setLayout(MvcEvent $e) {
        $matches = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        if (0 !== strpos($controller, __NAMESPACE__, 0)) {
            return;
        }

        $viewModel = $e->getViewModel();
        $viewModel->setTemplate('layout/layout_otro');
    }

}
