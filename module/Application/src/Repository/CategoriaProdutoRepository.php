<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\EntityManager;

class CategoriaProdutoRepository extends EntityRepository {

    public function getOptionsCategoria() {
        $categorias = $this->findBy(array(), array('nomeCategoria' => 'ASC'));
        $array = array();
        foreach ($categorias as $categoria) {
            $array[$categoria->getIdCategoriaPlanejamento()] = $categoria->getNomeCategoria();
        }
        return $array;
    }
}
