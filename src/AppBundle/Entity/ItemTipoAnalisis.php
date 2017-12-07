<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use AppBundle\Entity\TipoAnalisis;

/**
 * ItemTipoAnalisis
 *
 * @ORM\Table(name="item_tipo_analisis")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemTipoAnalisisRepository")
 */
class ItemTipoAnalisis
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoAnalisis", inversedBy = "itemTipoAnalisis")
     * @ORM\JoinColumn(name="tipoanalisis_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $tipoAnalisis;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=50)
     */
    private $nombre;



    /**
     * @var string
     * @ORM\Column(name="unidad", type="string", length=50)
     */
    private $unidad;

    /**
     * @ORM\OneToMany(targetEntity="ValoresReferencia", mappedBy="itemTipoAnalisis", cascade={"persist","remove"})
     */
    private $valoresReferencia;

    /**
     * @var boolean
     * @ORM\Column(name="es_pon", type="boolean")
     */
    private $esPon;
    



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
     * Set nombre
     *
     * @param string $nombre
     * @return ItemTipoAnalisis
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

  


    /**
     * Set tipoAnalisis
     *
     * @param \AppBundle\Entity\TipoAnalisis $tipoAnalisis
     * @return ItemTipoAnalisis
     */
    public function setTipoAnalisis(\AppBundle\Entity\TipoAnalisis $tipoAnalisis = null)
    {
        $this->tipoAnalisis = $tipoAnalisis;

        return $this;
    }

    /**
     * Get tipoAnalisis
     *
     * @return \AppBundle\Entity\TipoAnalisis 
     */
    public function getTipoAnalisis()
    {
        return $this->tipoAnalisis;
    }

    public function __toString()
    {

        return $this->getNombre();
    }

    /**
     * Set unidad
     *
     * @param string $unidad
     *
     * @return ItemTipoAnalisis
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return string
     */
    public function getUnidad()
    {
        return $this->unidad;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->valoresReferencia = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add valoresReferencium
     *
     * @param \AppBundle\Entity\ValoresReferencia $valoresReferencium
     *
     * @return ItemTipoAnalisis
     */
    public function addValoresReferencium(\AppBundle\Entity\ValoresReferencia $valoresReferencium)
    {

        $this->valoresReferencia[] = $valoresReferencium;
        $valoresReferencium->setItemTipoAnalisis($this);
        return $this;
    }

    /**
     * Remove valoresReferencium
     *
     * @param \AppBundle\Entity\ValoresReferencia $valoresReferencium
     */
    public function removeValoresReferencium(\AppBundle\Entity\ValoresReferencia $valoresReferencium)
    {
        $this->valoresReferencia->removeElement($valoresReferencium);
    }

    /**
     * Get valoresReferencia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValoresReferencia()
    {
        return $this->valoresReferencia;
    }

   

    /**
     * Set esPon
     *
     * @param boolean $esPon
     *
     * @return ItemTipoAnalisis
     */
    public function setEsPon($esPon)
    {
        $this->esPon = $esPon;

        return $this;
    }

    /**
     * Get esPon
     *
     * @return boolean
     */
    public function getEsPon()
    {
        return $this->esPon;
    }
}
