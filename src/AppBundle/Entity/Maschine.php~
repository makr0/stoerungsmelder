<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maschine
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MaschineRepository")
 */
class Maschine
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
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Abteilung", inversedBy="maschinen")
     */
    private $abteilung;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="seriennummer", type="string", length=255)
     */
    private $seriennummer;

    /**
     * @var string
     *
     * @ORM\Column(name="zustand", type="string", length=5)
     */
    private $zustand;

    /**
     * @ORM\OneToMany(targetEntity="Stoerung", mappedBy="maschine")
     */
    private $stoerungen;

    public function __toString() {
        return $this->getName();
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
     * @return Maschine
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
     * Set seriennummer
     *
     * @param string $seriennummer
     *
     * @return Maschine
     */
    public function setSeriennummer($seriennummer)
    {
        $this->seriennummer = $seriennummer;

        return $this;
    }

    /**
     * Get seriennummer
     *
     * @return string
     */
    public function getSeriennummer()
    {
        return $this->seriennummer;
    }

    /**
     * Set zustand
     *
     * @param string $zustand
     *
     * @return Maschine
     */
    public function setZustand($zustand)
    {
        $this->zustand = $zustand;

        return $this;
    }

    /**
     * Get zustand
     *
     * @return string
     */
    public function getZustand()
    {
        return $this->zustand;
    }


    /**
     * Set abteilung
     *
     * @param \stdClass $abteilung
     *
     * @return Maschine
     */
    public function setAbteilung($abteilung)
    {
        $this->abteilung = $abteilung;

        return $this;
    }

    /**
     * Get abteilung
     *
     * @return \stdClass
     */
    public function getAbteilung()
    {
        return $this->abteilung;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stoerungen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add stoerungen
     *
     * @param \AppBundle\Entity\Stoerung $stoerungen
     *
     * @return Maschine
     */
    public function addStoerungen(\AppBundle\Entity\Stoerung $stoerungen)
    {
        $this->stoerungen[] = $stoerungen;

        return $this;
    }

    /**
     * Remove stoerungen
     *
     * @param \AppBundle\Entity\Stoerung $stoerungen
     */
    public function removeStoerungen(\AppBundle\Entity\Stoerung $stoerungen)
    {
        $this->stoerungen->removeElement($stoerungen);
    }

    /**
     * Get stoerungen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStoerungen()
    {
        return $this->stoerungen;
    }
}
