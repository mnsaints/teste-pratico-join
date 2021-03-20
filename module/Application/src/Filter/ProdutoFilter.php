<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class ProdutoFilter extends InputFilter {

    public function __construct() {

        $this->add(array(
            'name' => 'nomeProduto',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Por Favor preencha o campo [Nome do produto]',
                        ),
                    ),
                ),
            ),
        ));
        $this->add(array(
            'name' => 'valorProduto',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor preencha o campo [Valor do produto]',
                        ),
                    ),
                ),
            ),
        ));
        $this->add(array(
            'name' => 'idCategoriaProduto',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor selecione a [Categoria]',
                        ),
                    ),
                ),
            ),
        ));

    }

}
