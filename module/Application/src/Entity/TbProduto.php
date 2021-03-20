<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\AbstractEntity;

/**
 * TbProduto
 *
 * @ORM\Table(name="tb_produto", indexes={@ORM\Index(name="IXFK_tb_produto_tb_categoria_produto", columns={"id_categoria_produto"})})
 * @ORM\Entity(repositoryClass="Application\Repository\ProdutoRepository")
 */
class TbProduto extends AbstractEntity {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_produto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduto;    
    
    /**
     * @var \Application\Entity\TbCategoriaProduto
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\TbCategoriaProduto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoria_produto", referencedColumnName="id_categoria_planejamento")
     * })
     */
    private $idCategoriaProduto;
    

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_cadastro", type="datetime", nullable=false)
     */
    private $dataCadastro;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="nome_produto", type="string", length=150, nullable=false)
     */
    private $nomeProduto;
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="valor_produto", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $valorProduto;
    
    
    function getIdProduto() {
        return $this->idProduto;
    }

    function getIdCategoriaProduto() {
        return $this->idCategoriaProduto;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getNomeProduto() {
        return $this->nomeProduto;
    }

    function getValorProduto() {
        return $this->valorProduto;
    }

    function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    function setIdCategoriaProduto($idCategoriaProduto) {
        $this->idCategoriaProduto = $idCategoriaProduto;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setNomeProduto($nomeProduto) {
        $this->nomeProduto = $nomeProduto;
    }

    function setValorProduto($valorProduto) {
        $this->valorProduto = $valorProduto;
    }


   
}
