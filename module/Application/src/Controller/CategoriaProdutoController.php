<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\CategoriaProdutoForm;
use Application\Filter\CategoriaProdutoFilter;
use Application\Controller\AbstractController;
use Application\Entity\TbCategoriaProduto;
use Application\Entity\TbProduto;
use Application\Util\Util;
use Zend\Json\Json;

class CategoriaProdutoController extends AbstractController
{      
    
    public function __construct($container, $entityManager) {
        parent::__construct($container, $entityManager);   
        
        $this->container = $container;
        $this->route = 'categoria/default';
        $this->Util = new Util();
    }

    public function indexAction()
    {                 
        $categorias = $this->entityManager->getRepository(TbCategoriaProduto::class)->findAll();        
        $view = new ViewModel(array(           
            'categorias' => $categorias
            )
         );        
        return $view;
    }
    
    public function cadastrarAction()
    {        
        $form = new CategoriaProdutoForm();
        $request = $this->getRequest();
        
        if ($request->isPost()) {

            $data = $request->getPost()->toArray();  
            
            $form->setData($request->getPost());
            
            if($form->isValid()){
                
                $serviceCategoria = $this->container->get('Application\Service\CategoriaProduto');  
                $retorno = $serviceCategoria->cadastrar($data);

                if ($retorno) {
                    $this->setMessage($this->Util->GetFlash('success', 'cadastrado_sucesso'), $tipo = 'success');
                    return $this->redirect()->toRoute($this->route, array('action' => 'index'));
                } else {
                   // $this->setMessage($this->Util->GetFlash('error', 'erro_comum'), $tipo = 'error');
                    return $this->redirect()->toRoute($this->route);
                }   
            }    
       }
       
        $view = new ViewModel(array(
            'form' => $form           
            )
         );
        
        return $view;
    }
    
    public function editarAction()
    {        
        $form = new CategoriaProdutoForm();
        $request = $this->getRequest();
        $categoriaId = $this->params()->fromRoute('id', 0);
        
        if(empty($categoriaId)){
           return $this->redirect()->toRoute($this->route, array('action' => 'index'));
        }    
               
        $entityCategoria = $this->entityManager->getRepository(TbCategoriaProduto::class)->find($categoriaId);
        
        $data = $entityCategoria->toArray();
        $form->setData($data);
        $form->get("submitForm")->setValue("Editar");
        
        if ($request->isPost()) {

            $data = $request->getPost()->toArray();
            
            $form->setInputFilter(new CategoriaProdutoFilter($this->container));
            
            if($form->isValid()){
               
                $serviceCategoria = $this->container->get('Application\Service\CategoriaProduto');
                $retorno = $serviceCategoria->editar($data, $categoriaId);

                if ($retorno) {
                    $this->setMessage($this->Util->GetFlash('success', 'atualizado_sucesso'), $tipo = 'success'); 
                    return $this->redirect()->toRoute($this->route, array('action' => 'index'));
                } else {
                   // $this->setMessage($this->Util->GetFlash('error', 'erro_comum'), $tipo = 'error');
                    return $this->redirect()->toRoute($this->route);
                }
                
            }
            
       }
       
       $view = new ViewModel(array(
            'form' => $form,
            'categoriaId' =>  $categoriaId
            )
        );
       
        return $view;
    }
    
    
    public function excluirAction()
    {  
        $categoriaId = $this->params()->fromRoute('id', 0);
        
        if(empty($categoriaId)){
           return $this->redirect()->toRoute($this->route, array('action' => 'index'));
        }   
        
        $categoria = $this->entityManager->getRepository(TbCategoriaProduto::class)->find($categoriaId);
        
        $serviceCategoria = $this->container->get('Application\Service\CategoriaProduto');
        $retorno = $serviceCategoria->excluir($categoriaId);

        if ($retorno) {
            $this->setMessage($this->Util->GetFlash('success', 'excluido_sucesso'), $tipo = 'success');
            return $this->redirect()->toRoute($this->route, array('action' => 'index'));
        } else {
            $this->setMessage($this->Util->GetFlash('error', 'excluido_erro'), $tipo = 'error');
            return $this->redirect()->toRoute($this->route);
        } 
            
        $view = new ViewModel();
       
        $view->setTerminal(true);
       
        return $view;
    }
    
    
    public function checkProdutosAction()
    {  
        
        $data = $this->params()->fromRoute();       
        
        $hasProdutos = $this->entityManager->getRepository(TbProduto::class)->findOneBy(array("idCategoriaProduto" =>$data["id"]));
        
        $retorno = false;
        if(!empty($hasProdutos)){
            $retorno = true;            
        }        
        ob_clean();
        return $this->getResponse()->setContent(Json::encode($retorno));
    }
    
   
    
}
