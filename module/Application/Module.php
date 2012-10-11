<?php

namespace Application;
use Application\Controller\Exception\MyException as MyException;
class Module
{
    public function onBootstrap(\Zend\Mvc\MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();

        $eventManager->attach('dispatch.error', function($e) {            
            if ($e->getParam('exception') instanceof MyException) {
                $exception = $e->getParam('exception');
                exit('<h3>'.$exception->getMessage().'</h3>');
            }
        }, 1000);

        // A very crude ACL...
        $eventManager->attach('dispatch', function($e) {
            $controller = $e->getRouteMatch()->getParam('controller');
            $action = $e->getRouteMatch()->getParam('action');
            $auth = $e->getApplication()->getServiceManager()->get('Auth');
            $acl = new Acl\MyAcl();
            $role = $auth->hasIdentity() ? $auth->getIdentity()->type : 'guest';
            if (!$acl->hasResource($controller) || $acl->isAllowed($role, $controller, $action)) {
                return;
            }
            exit('ACCESS DENIED.');
        }, 1000);
    }

    //public function getViewHelperConfig()
    //{
        //return array(
            //'factories' => array(
            //),
        //);
    //}

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Model/History' => function($sm) {
                    return new Model\History($sm->get('dbAdapter'));
                },
                'Model/Page' => function($sm) {
                    return new Model\Page($sm->get('dbAdapter'));
                },
                'Model/Pdf' => function($sm) {
                    return new Model\Pdf($sm->get('dbAdapter'));
                },
                'Model/Favorite' => function($sm) {
                    return new Model\Favorite($sm->get('dbAdapter'));
                },
                'Model/User' => function($sm) {
                    return new Model\User($sm->get('dbAdapter'));
                },
                'Model/Category' => function($sm) {
                    return new Model\Category($sm->get('dbAdapter'));
                },
                'Filter/ChangePassword' => function($sm) {
                    $userId = $sm->get('auth')->getIdentity()->id;
                    $model = $sm->get('Model\User');
                    return new Filter\ChangePassword($model, $userId);
                },
            ),
        );
    }

    public function getConfig()
    {
        return array_merge(include __DIR__ . '/config/module.config.php',
                           include __DIR__ . '/config/routes.php'
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}
