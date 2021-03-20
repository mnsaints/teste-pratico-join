<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;

abstract class AbstractService {

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var ServiceManager
     */
    protected $sm;

    /**
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return $this->sm;
    }

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    
    /**
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->sm = $serviceLocator;
    }

    public function getEM($entity = null) {
        $location = $this->getModulo(); //verifica qual serviço irá chamar
        if ($entity === null) {
            return $this->em;
        } else {
            return $this->em->getRepository($entity);
        }
    }

    /**
     * Define em qual servico o sistema irá se conectar (padrao doctrine ou dbFactory)
     * @return String
     */
    public function getModulo() {
        $retorno = "Doctrine\ORM\EntityManager";
        return $retorno;
    }   
   
    public function getEmRef($entity, $id) {

        return $this->getEM()->getReference($entity, $id);
    }

    public function insert($data, $entity) {
        $entity = new $entity($data);
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $entity);

        $em = $this->getEM();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    public function update($data, $entity, $id) {

        $entity = $this->getEmRef($entity, $id);
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $entity);


        $em = $this->getEM();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    public function delete($entity, $id) {

        $repository = $this->getEM($entity);
        $FindEntity = $repository->find($id);

        $retorno = false;

        if ($FindEntity) {
            $entity = $this->getEmRef($entity, $id);
            $em = $this->getEM();
            $em->remove($entity);
            $em->flush();
            $retorno = true;
        }

        return $retorno;
    }

}
