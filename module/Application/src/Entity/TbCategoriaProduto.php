<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\AbstractEntity;

/**
 * TbCategoriaProduto
 *
 * @ORM\Table(name="tb_categoria_produto")
 * @ORM\Entity(repositoryClass="Application\Repository\CategoriaProdutoRepository")
 */
class TbCategoriaProduto extends AbstractEntity {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_categoria_planejamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategoriaPlanejamento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_categoria", type="string", length=150, nullable=false)
     */
    private $nomeCategoria;   
    
    
    /**
    * Get idCategoriaPlanejamento
    *
    * @return integer
    */

    function getIdCategoriaPlanejamento() {
        return $this->idCategoriaPlanejamento;
    }

    /**
     * Set idCategoriaPlanejamento
     *
     * @param string $idCategoriaPlanejamento
     *
     * @return TbCategoriaProduto
     */
    function setIdCategoriaPlanejamento($idCategoriaPlanejamento) {
       $this->idCategoriaPlanejamento = $idCategoriaPlanejamento;
    }
    
    /**
     * Get nomeCategoria
     *
     * @return string
     */

    function getNomeCategoria() {
       return $this->nomeCategoria;
   }

    /**
     * Set nomeCategoria
     *
     * @param string $nomeCategoria
     *
     * @return TbCategoriaProduto    */

    function setNomeCategoria($nomeCategoria) {
        $this->nomeCategoria = $nomeCategoria;
    }


}



    



