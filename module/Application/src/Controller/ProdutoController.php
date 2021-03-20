<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\ProdutoForm;
use Application\Filter\ProdutoFilter;
use Application\Controller\AbstractController;
use Application\Entity\TbProduto;
use Zend\Session\Container;
use Application\Util\Util;


class ProdutoController extends AbstractController
{
    
   public function __construct($container, $entityManager) {
        parent::__construct($container, $entityManager);   
        
        $this->container = $container;
        $this->route = 'produto/default';
        $this->Util = new Util();
    }

    public function indexAction()
    {                 
        $produtos = $this->entityManager->getRepository(TbProduto::class)->findAll();        
        $view = new ViewModel(array(           
            'produtos' => $produtos
            )
         );        
        return $view;
    }
    
    public function cadastrarAction()
    {        
        $form = new ProdutoForm($this->entityManager);
        $request = $this->getRequest();
                
        if ($request->isPost()) {

            $data = $request->getPost()->toArray();  
            
            $form->setData($data);
            
            if($form->isValid()){
                
                $serviceProduto = $this->container->get('Application\Service\Produto');  
                $retorno = $serviceProduto->cadastrar($data);

                if ($retorno) {
                    $this->setMessage($this->Util->GetFlash('success', 'cadastrado_sucesso'), $tipo = 'success');        
                    return $this->redirect()->toRoute($this->route, array('action' => 'index'));
                } else {
                    $this->setMessage($this->Util->GetFlash('error', 'erro_comum'), $tipo = 'error');
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
        $form = new ProdutoForm($this->entityManager);
        $request = $this->getRequest();
        $produtoId = $this->params()->fromRoute('id', 0);
        
        if(empty($produtoId)){
           return $this->redirect()->toRoute($this->route, array('action' => 'index'));
        }    
               
        $entityProduto = $this->entityManager->getRepository(TbProduto::class)->find($produtoId);
        
        $data = $entityProduto->toArray();  
        $form->setData($data);        
        $form->get("idCategoriaProduto")->setValue($entityProduto->getIdCategoriaProduto()->getIdCategoriaPlanejamento());
        $form->get("valorProduto")->setValue(number_format($entityProduto->getValorProduto(), 2, ',', '.'));
        $form->get("submitForm")->setValue("Editar");
        
        if ($request->isPost()) {

            $data = $request->getPost()->toArray();           
            
            $form->setData($data);
            $form->setInputFilter(new ProdutoFilter());
            
            if($form->isValid()){
               
                $serviceProduto = $this->container->get('Application\Service\Produto');
                $retorno = $serviceProduto->editar($data, $produtoId);

                if ($retorno) {
                    $this->setMessage($this->Util->GetFlash('success', 'atualizado_sucesso'), $tipo = 'success');                  
                    return $this->redirect()->toRoute($this->route, array('action' => 'index'));
                } else {
                   // $this->setMessage($this->Util->GetFlash('error', 'erro_comum'), $tipo = 'error');
                    return $this->redirect()->toRoute($this->route);
                } 
            }else{
                $messages = $form->getMessages();                
            }
            
       }
       
       $view = new ViewModel(array(
            'form' => $form,
            'produtoId' =>  $produtoId
            )
        );
       
        return $view;
    }
    
    public function excluirAction()
    {  
        $produtoId = $this->params()->fromRoute('id', 0);
        
        if(empty($produtoId)){
           return $this->redirect()->toRoute($this->route, array('action' => 'index'));
        }   
                
        $serviceCategoria = $this->container->get('Application\Service\Produto');
        $retorno = $serviceCategoria->excluir($produtoId);

        if ($retorno) {
           $this->setMessage($this->Util->GetFlash('success', 'excluido_sucesso'), $tipo = 'success');
            return $this->redirect()->toRoute($this->route, array('action' => 'index'));
        } else {
            $this->setMessage($this->Util->GetFlash('success', 'excluido_erro'), $tipo = 'success');
            return $this->redirect()->toRoute($this->route);
        } 
            
        $view = new ViewModel();
       
        $view->setTerminal(true);
    }
    
}
