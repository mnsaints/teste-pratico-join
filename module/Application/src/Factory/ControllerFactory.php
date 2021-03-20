<?php
/**
 * Classe Factory para o controller padrao do projeto.
 * 
 * @author Wanderson Corni <wandersoncorni@gmail.com>
 * @version 1.0
 * @return Object AbstractController
 */
namespace Application\Factory;

use Application\Controller\UgrController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Doctrine\ORM\Mapping as ORM;
class ControllerFactory 
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null) {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new $requestedName($container, $entityManager);
    }
    
}