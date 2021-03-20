<?php

namespace Application\Service;

use Application\Service\AbstractService;
use Application\Entity\TbProduto;
use Zend\Hydrator;

class Produto extends AbstractService {

    public function __construct($container, $entityManager) {
        parent::__construct($entityManager);
        $this->container = $container;
        $this->entity = 'Application\Entity\TbProduto';      
        $this->entityCategoriaProduto = 'Application\Entity\TbCategoriaProduto';      
    }
    
   
    function cadastrar($data) { 
        
        try {             
            $entityCategoria = $this->em->getReference($this->entityCategoriaProduto, $data["idCategoriaProduto"]);   
            $entityProduto = new $this->entity();
            
            $entityProduto->setNomeProduto(trim($data["nomeProduto"]));
            $entityProduto->setValorProduto(str_replace(['.', ','], ['', '.'], $data["valorProduto"]));
            $entityProduto->setDataCadastro(new \DateTime('now', new \DateTimeZone('America/Bahia')));
            $entityProduto->setIdCategoriaProduto($entityCategoria);
            $this->em->persist($entityProduto);
            $this->em->flush();           

            $retorno = true;
            
        }catch(Exception $ex) {      
            $retorno = false;            
        }        
        return $retorno;
    }
    
    
    function editar($data, $id) {             
        try { 
            
            $entityProduto = $this->em->getReference($this->entity, $id);
            $entityCategoria = $this->em->getReference($this->entityCategoriaProduto, $data["idCategoriaProduto"]);              
            
            $entityProduto->setNomeProduto($data["nomeProduto"]);
            $entityProduto->setValorProduto(str_replace(['.', ','], ['', '.'], $data["valorProduto"]));
            $entityProduto->setDataCadastro(new \DateTime('now', new \DateTimeZone('America/Bahia')));
            $entityProduto->setIdCategoriaProduto($entityCategoria);
            $this->em->persist($entityProduto);
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
