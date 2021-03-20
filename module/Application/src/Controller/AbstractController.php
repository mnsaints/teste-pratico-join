<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;

class AbstractController extends AbstractActionController {

    public $entityManager;
    public $container;

    public function __construct($container, $entityManager) {
        $this->entityManager = $entityManager;
        $this->container = $container;      
    }


    public function getEM($entity = null) {
        if ($entity === null) {
            return $this->entityManager;
        } else {
            $em = $this->entityManager;
            return $em->getRepository($entity);
        }
    }

    public function getEmRef($entity, $id) {
        return $this->getEM()->getReference($entity, $id);
    }

    /**
     * Insere um msg no objeto "FlashMessenger"
     * @param string $texto O texto
     * @param String $tipo O tipo ('sussccess','error','warning','message')
     */
    protected function setMessage($texto, $tipo = 'message') {
        $fmsg =   new \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
        $fmsg->addMessage($texto, $tipo);
    }

    protected function getMessages() {
        $fmsg =new \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
        return $fmsg->getMessages();
    }
    

}
