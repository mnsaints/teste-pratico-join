<?php

namespace Application\Form;

use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Entity\TbCategoriaProduto;
use Zend\Form\Form;


use Zend\ServiceManager\ServiceManager;

class ProdutoForm extends Form {

    public function __construct($em) {
        parent::__construct('Produto');        

        $this->setAttributes(array(
            'method' => 'POST',
            'class' => 'row col-12 form-horizontal sys-col',           
            'role' => 'form'
        ));
       
        $this->add(array(
            'name' => 'nomeProduto',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'num_cols' => '12',
                'autofocus' => true,
                'class' => 'form-control input',
                'id' => 'nomeProduto',
                'placeholder' => 'Nome do produto',
                'required' => 'required',
                'custom_attributes' => array(
                    'class' => 'col-12'
                ),
            ),
            'options' => array(
                'label' => 'Nome do produto:',
            ),
        ));
        
        
       $listaCategorias = array();
       $listaCategorias = $em->getRepository(TbCategoriaProduto::class)->getOptionsCategoria();       
        
        $this->add(array(
                'name' => 'idCategoriaProduto',
                'type' => 'Zend\Form\Element\Select',
                'attributes' => array(
                    'class' => 'form-control',
                    'id' => 'idCategoriaProduto',
                     'required' => true,
                    'custom_attributes' => array(
                        'class' => 'col-md-6',
                    ),
            ),
            'options' => array(
                'label' => 'Categoria:',
                'empty_option' => 'Selecione',
                'value_options' => $listaCategorias
            )
        ));
        
        $this->add(array(
            'name' => 'valorProduto',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'num_cols' => '12',
                'autofocus' => true,
                'class' => 'form-control money-real',
                'id' => 'valorProduto',
               
                'required' => 'required',
                'custom_attributes' => array(
                    'class' => 'col-12'
                ),
            ),
            'options' => array(
                'label' => 'Valor do produto:',
            ),
        ));  
        
        
        $this->add(array(
            'name' => 'submitForm',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'class' => 'btn btn-info',
                'value' => 'Cadastrar',
                'id' => 'submitForm',
            ),
        ));
      
    }

}
