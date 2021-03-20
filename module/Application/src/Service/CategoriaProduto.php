<?php

namespace Application\Service;

use Application\Service\AbstractService;
use Application\Entity\TbCategoriaProduto;
use Zend\Hydrator;

class CategoriaProduto extends AbstractService {

    public function __construct($container, $entityManager) {
        parent::__construct($entityManager);
        $this->container = $container;
        $this->entity = 'Application\Entity\TbCategoriaProduto';      
    }
    
   
    function cadastrar($data) {       
      
        $retorno = false;
        try {          
            $entityCategoria = new $this->entity();                     
            $entityCategoria->setNomeCategoria(trim($data["nomeCategoria"]));
            $this->em->persist($entityCategoria);
            $this->em->flush();

            $retorno = true;
        }catch(Exception $ex) {      
            $retorno = false;
            
        }        
        return $retorno;
    }
    
    
     function editar($data, $id) {
        $retorno = false;        
        try {  
            $entityCategoria = $this->em->getReference($this->entity,$id);                    
            $entityCategoria->setNomeCategoria(trim($data["nomeCategoria"]));

            $this->em->persist($entityCategoria);
            $this->em->flush();
         
            $retorno = true;
        } catch (Exception $ex) {
            $retorno = false;
        }         
        return $retorno;
       
    } 
    
    public function excluir($id) {
        try {
            $entityCategoria = $this->em->find($this->entity, $id);
            $this->em->remove($entityCategoria);
            $this->em->flush();
            $retorno = true;            
        } catch (Exception $ex) {
            $retorno = false;
        }
        return $retorno;
        
    }
      
    
}
