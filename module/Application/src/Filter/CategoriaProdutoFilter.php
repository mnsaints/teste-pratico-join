<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class CategoriaProdutoFilter extends InputFilter {

    public function __construct() {

        $this->add(array(
            'name' => 'nomeCategoria',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Por Favor preencha o campo [Nome da Categoria]',
                        ),
                    ),
                ),
            ),
        ));

    }

}
