<?php

return array(
    'router' => array(
        'routes' => array(
        //-------------------------------------
            'home' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Home',
                        'action'     => 'index',
                    ),
                ),
            ),
        //-------------------------------------
            'about' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/about',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Home',
                        'action'     => 'about',
                    ),
                ),
            ),
        //-------------------------------------
            'contact' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/contact',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Home',
                        'action'     => 'contact',
                    ),
                ),
            ),
        //-------------------------------------
            'login' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Account',
                        'action'     => 'login',
                    ),
                ),
            ),
        //-------------------------------------
            'logout' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Account',
                        'action'     => 'logout',
                    ),
                ),
            ),
        //-------------------------------------
            'register' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/register',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Account',
                        'action'     => 'register',
                    ),
                ),
            ),
        //-------------------------------------
            'renew' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/renew',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Account',
                        'action'     => 'renew',
                    ),
                ),
            ),
        //-------------------------------------
            'change_password' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/change_password',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Account',
                        'action'     => 'changepassword',
                    ),
                ),
            ),
        //-------------------------------------
            'favorites' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/favorites',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Content',
                        'action'     => 'favorites',
                    ),
                ),
            ),
        //-------------------------------------
            'forgot_password' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/forgot_password',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Account',
                        'action'     => 'forgotpassword',
                    ),
                ),
            ),
        //-------------------------------------
            'history' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/history',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Content',
                        'action'     => 'history',
                    ),
                ),
            ),
        //-------------------------------------
            'category' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/category[/:categoryId]',
                    'constraints' => array(
                        'categoryId'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Content',
                        'action'     => 'category',
                    ),
                ),
            ),
        //-------------------------------------
            'page' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/page[/:pageId]',
                    'constraints' => array(
                        //'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'pageId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Content',
                        'action'     => 'page',
                    ),
                ),
            ),
        //-------------------------------------
            'view_pdf' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/view_pdf[/:pdfId]',
                    'constraints' => array(
                        'pdfId' => '[a-z0-9]{40}',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Content',
                        'action'     => 'viewpdf',
                    ),
                ),
            ),
        //-------------------------------------
            'add_page' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/add_page',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Admin',
                        'action'     => 'addpage',
                    ),
                ),
            ),
        //-------------------------------------
            'add_pdf' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/add_pdf',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Admin',
                        'action'     => 'addpdf',
                    ),
                ),
            ),
        //-------------------------------------
            'pdfs' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/pdfs',
                    'defaults' => array(
                        'controller' => 'Application/Controller/Content',
                        'action'     => 'pdfs',
                    ),
                ),
            ),
        //-------------------------------------
            'add_to_favorites' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/add_to_favorites[/:pageId]',
                    'constraints' => array(
                        'pageId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Content',
                        'action'     => 'addtofavorites',
                    ),
                ),
            ),
        //-------------------------------------
            'remove_from_favorites' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/remove_from_favorites[/:pageId]',
                    'constraints' => array(
                        'pageId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Content',
                        'action'     => 'removefromfavorites',
                    ),
                ),
            ),
        //-------------------------------------
        ),
    ),
);
