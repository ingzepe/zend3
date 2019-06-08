<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Usuarios\Controller\IndexController;
use Usuarios\Controller\LoginController;
use Usuarios\Model\Dao\IUsuarioDao;

/**
 * Description of ControllerFactory
 *
 * @author enrique
 */
class ControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $controller = null;
        switch ($requestedName) {
            case IndexController::class :
                $usuarioDao = $container->get(IUsuarioDao::class );
                $configIni = $container->get('ConfigIni');
                $controller = new IndexController($usuarioDao, $configIni);
                break;
            case LoginController::class :
                $usuarioDao = $container->get(IUsuarioDao::class );
                $controller = new LoginController($usuarioDao);
                break;
            default:
//                return (null===$options) ? $requestedName: new $requestedName($options);
                return (null === $options) ? new $requestedName : new $requestedName($options);
        }
        return $controller;
    }

}
