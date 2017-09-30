<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Analisis
 *
 * @ORM\Table(name="analisis")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnalisisRepository")
 */
class Analisis
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Paciente")
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     *
     */
    private $paciente;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Profesional")
     * @ORM\JoinColumn(name="profesional_id", referencedColumnName="id")
     */
    private $profesional;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creado", type="date")
     */
    private $fechaCreado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrega", type="date")
     */
    private $fechaEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=40)
     */
    private $estado;

    /**
     * @ORM\ManyToMany(targetEntity="TipoAnalisis")
     * @ORM\JoinTable(name="analisis_tipoanalisis",
     *          joinColumns={@ORM\JoinColumn(name="analisis_id", referencedColumnName="id")},
     *          inverseJoinColumns={@ORM\JoinColumn(name="tipoanalisis_id", referencedColumnName="id")}
     *          )
     */
    private $tipoAnalisis;


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
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     * @return Analisis
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime 
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Analisis
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaCreado
     *
     * @param \DateTime $fechaCreado
     * @return Analisis
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->fechaCreado = $fechaCreado;

        return $this;
    }

    /**
     * Get fechaCreado
     *
     * @return \DateTime 
     */
    public function getFechaCreado()
    {
        return $this->fechaCreado;
    }

    /**
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     * @return Analisis
     */
    public function setPaciente(\AppBundle\Entity\Paciente $paciente = null)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return \AppBundle\Entity\Paciente 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set profesional
     *
     * @param \AppBundle\Entity\Paciente $profesional
     * @return Analisis
     */
    public function setProfesional(\AppBundle\Entity\Profesional $profesional = null)
    {
        $this->profesional = $profesional;

        return $this;
    }

    /**
     * Get profesional
     *
     * @return \AppBundle\Entity\Paciente 
     */
    public function getProfesional()
    {
        return $this->profesional;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tipoAnalisis = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tipoAnalisis
     *
     * @param \AppBundle\Entity\TipoAnalisis $tipoAnalisis
     * @return Analisis
     */
    public function addTipoAnalisi(\AppBundle\Entity\TipoAnalisis $tipoAnalisis)
    {
        $this->tipoAnalisis[] = $tipoAnalisis;

        return $this;
    }

    /**
     * Remove tipoAnalisis
     *
     * @param \AppBundle\Entity\TipoAnalisis $tipoAnalisis
     */
    public function removeTipoAnalisi(\AppBundle\Entity\TipoAnalisis $tipoAnalisis)
    {
        $this->tipoAnalisis->removeElement($tipoAnalisis);
    }

    /**
     * Get tipoAnalisis
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTipoAnalisis()
    {
        return $this->tipoAnalisis;
    }
}
