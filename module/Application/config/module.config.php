<?php
return array(
    'db' => array(
        'driver'   => 'pdo_mysql',
        'hostname' => get_cfg_var('zend_developer_cloud.db.host') ?: 'localhost',
        'database' => get_cfg_var('zend_developer_cloud.db.name') ?: 'ecom1_zf',
        'username' => get_cfg_var('zend_developer_cloud.db.username') ?: 'root',
        'password' => get_cfg_var('zend_developer_cloud.db.password') ?: 'beer',        
        'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'),
    ),

    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Account' => 'Application\Controller\AccountController',
            'Application\Controller\Home'    => 'Application\Controller\HomeController',
            'Application\Controller\Content' => 'Application\Controller\ContentController',
            'Application\Controller\Admin'   => 'Application\Controller\AdminController',
        ),
        'aliases' => array(
            'home' => 'Application\Controller\Home',
        ),
    ),

    'controller_plugins' => array(
        'invokables' => array(
            'getservice'    => 'Application\Controller\Plugin\GetService',
            'setflash'      => 'Application\Controller\Plugin\SetFlash',
            'isformvalid'   => 'Application\Controller\Plugin\IsFormValid',
            'sendfile'      => 'Application\Controller\Plugin\SendFile',
        ),
    ),

    'view_manager' => array(
        'display_not_found_reason'  => true,
        'display_exceptions'        => true,
        //'doctype'                   => 'HTML5',
        'not_found_template'        => 'error/404',
        'exception_template'        => 'error/index',
        'template_path_stack'       => array(__DIR__ . '/../view'),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'categories'            => 'Application\View\Helper\Categories',
            'formelementerror'      => 'Application\View\Helper\FormElementError',
            'auth'                  => 'Application\View\Helper\Auth',
            'hasflash'              => 'Application\View\Helper\HasFlash',
            'selected'              => 'Application\View\Helper\Selected',
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'dbadapter'             => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
        'services' => array(
            'auth'                  => new Zend\Authentication\AuthenticationService,
        ),
    ),
);