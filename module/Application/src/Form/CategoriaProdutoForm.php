<?php

namespace Application\Form;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;

use Zend\ServiceManager\ServiceManager;

class CategoriaProdutoForm extends Form {

    public function __construct() {
        parent::__construct('CategoriaProduto');        

        $this->setAttributes(array(
            'method' => 'POST',
            'class' => 'row col-12 form-horizontal sys-col',           
            'role' => 'form'
        ));
       
        $this->add(array(
            'name' => 'nomeCategoria',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'num_cols' => '12',
                'autofocus' => true,
                'class' => 'form-control   input',
                'id' => 'nomeCategoria',
                'placeholder' => 'Nome da categoria',
                'required' => 'required',
                'custom_attributes' => array(
                    'class' => 'col-12'
                ),
            ),
            'options' => array(
                'label' => 'Nome da Categoria:',
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
