<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResultadoAnalisis
 *
 * @ORM\Table(name="resultado_analisis")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultadoAnalisisRepository")
 */
class ResultadoAnalisis
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
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Analisis")
     * @ORM\JoinColumn(name="analisis_id", referencedColumnName="id")
     */
    private $analisis;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ItemTipoAnalisis")
     * @ORM\JoinColumn(name="item_tipoanalisis_id", referencedColumnName="id")
     */
    private $item;

    /**
     * @var float
     *
     * @ORM\Column(name="resultado", type="string")
     */
    private $resultado;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

   

    /**
     * Set resultado
     *
     * @param string $resultado
     * @return ResultadoAnalisis
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return string 
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set analisis
     *
     * @param \AppBundle\Entity\Analisis $analisis
     * @return ResultadoAnalisis
     */
    public function setAnalisis(\AppBundle\Entity\Analisis $analisis = null)
    {
        $this->analisis = $analisis;

        return $this;
    }

    /**
     * Get analisis
     *
     * @return \AppBundle\Entity\Analisis 
     */
    public function getAnalisis()
    {
        return $this->analisis;
    }

    /**
     * Set item
     *
     * @param \AppBundle\Entity\ItemTipoAnalisis $item
     * @return ResultadoAnalisis
     */
    public function setItem(\AppBundle\Entity\ItemTipoAnalisis $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \AppBundle\Entity\ItemTipoAnalisis 
     */
    public function getItem()
    {
        return $this->item;
    }

    public function __toString()
    {
        return 'asd';
    }
}
