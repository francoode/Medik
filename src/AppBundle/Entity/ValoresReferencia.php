<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValoresReferencia
 *
 * @ORM\Table(name="valores_referencia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ValoresReferenciaRepository")
 */
class ValoresReferencia
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_min", type="float", nullable=true)
     */
    private $valorMin;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_max", type="float", nullable=true)
     */
    private $valorMax;

    /**
     * @var int
     *
     * @ORM\Column(name="edad_max", type="integer", nullable=true)
     */
    private $edadMax;

    /**
     * @var int
     *
     * @ORM\Column(name="edad_min", type="integer", nullable=true)
     */
    private $edadMin;

    /**
     * @ORM\ManyToOne(targetEntity="ItemTipoAnalisis", inversedBy="ValoresReferencia")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $itemTipoAnalisis;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valor
     *
     * @param float $valor
     *
     * @return ValoresReferencia
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return float
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set edadMax
     *
     * @param integer $edadMax
     *
     * @return ValoresReferencia
     */
    public function setEdadMax($edadMax)
    {
        $this->edadMax = $edadMax;

        return $this;
    }

    /**
     * Get edadMax
     *
     * @return int
     */
    public function getEdadMax()
    {
        return $this->edadMax;
    }

    /**
     * Set edadMin
     *
     * @param integer $edadMin
     *
     * @return ValoresReferencia
     */
    public function setEdadMin($edadMin)
    {
        $this->edadMin = $edadMin;

        return $this;
    }

    /**
     * Get edadMin
     *
     * @return int
     */
    public function getEdadMin()
    {
        return $this->edadMin;
    }



    /**
     * Set itemTipoAnalisis
     *
     * @param \AppBundle\Entity\ItemTipoAnalisis $itemTipoAnalisis
     *
     * @return ValoresReferencia
     */
    public function setItemTipoAnalisis(\AppBundle\Entity\ItemTipoAnalisis $itemTipoAnalisis = null)
    {
        $this->itemTipoAnalisis = $itemTipoAnalisis;

        return $this;
    }

    /**
     * Get itemTipoAnalisis
     *
     * @return \AppBundle\Entity\ItemTipoAnalisis
     */
    public function getItemTipoAnalisis()
    {
        return $this->itemTipoAnalisis;
    }

    /**
     * Set valorMin
     *
     * @param float $valorMin
     *
     * @return ValoresReferencia
     */
    public function setValorMin($valorMin)
    {
        $this->valorMin = $valorMin;

        return $this;
    }

    /**
     * Get valorMin
     *
     * @return float
     */
    public function getValorMin()
    {
        return $this->valorMin;
    }

    /**
     * Set valorMax
     *
     * @param float $valorMax
     *
     * @return ValoresReferencia
     */
    public function setValorMax($valorMax)
    {
        $this->valorMax = $valorMax;

        return $this;
    }

    /**
     * Get valorMax
     *
     * @return float
     */
    public function getValorMax()
    {
        return $this->valorMax;
    }
}
