<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],          
            'categoria' => array(
                'type' => Literal::class,
                'options' => array(
                    'route' => '/categoria',
                    'defaults' => array(
                        'controller' => Controller\CategoriaProdutoController::class,
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[/:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-z][a-zA-Z_]*',
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => Controller\CategoriaProdutoController::class,
                            ),
                        ),
                    ),
                ),
            ),
            'produto' => array(
                'type' => Literal::class,
                'options' => array(
                    'route' => '/produto',
                    'defaults' => array(
                        'controller' => Controller\ProdutoController::class,
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[/:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-z][a-zA-Z_]*',
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => Controller\ProdutoController::class,
                            ),
                        ),
                    ),
                ),
            ),
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\ProdutoController::class => Factory\ControllerFactory::class,
            Controller\CategoriaProdutoController::class => Factory\ControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            SuperService::class => SuperServiceFactory::class,
            'Application\Service\CategoriaProduto' => Factory\ControllerFactory::class,
            'Application\Service\Produto' => Factory\ControllerFactory::class,
           
        ],
    ],    
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
        'configuration' => array(
            'orm_default' => array(
                'string_functions' => array(
                    'GroupConcat' => 'DoctrineExtensions\Query\Mysql\GroupConcat',
                    'Count' => 'DoctrineExtensions\Query\Mysql\CountIf',
                    'YEAR' => 'DoctrineExtensions\Query\Mysql\Year',
                    'DATE_FORMAT' => 'DoctrineExtensions\Query\Mysql\DateFormat',
                    'RAND' => 'DoctrineExtensions\Query\Mysql\Rand',
                    
                )
            )
        )
    ),
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
