<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abteilung
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AbteilungRepository")
 */
class Abteilung
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Maschine", mappedBy="abteilung")
     */
    private $maschinen;


    public function __toString()
    {
        return $this->name;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Abteilung
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->maschinen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add maschinen
     *
     * @param \AppBundle\Entity\Maschine $maschinen
     *
     * @return Abteilung
     */
    public function addMaschinen(\AppBundle\Entity\Maschine $maschinen)
    {
        $this->maschinen[] = $maschinen;

        return $this;
    }

    /**
     * Remove maschinen
     *
     * @param \AppBundle\Entity\Maschine $maschinen
     */
    public function removeMaschinen(\AppBundle\Entity\Maschine $maschinen)
    {
        $this->maschinen->removeElement($maschinen);
    }

    /**
     * Get maschinen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMaschinen()
    {
        return $this->maschinen;
    }
}
