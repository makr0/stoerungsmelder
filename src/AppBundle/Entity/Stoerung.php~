<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stoerung
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\StoerungRepository")
 */
class Stoerung
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
     * @ORM\ManyToOne(targetEntity="Maschine", inversedBy="stoerungen")
     */
    private $maschine;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="st_start", type="datetime")
     */
    private $stStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="st_end", type="datetime")
     */
    private $stEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="bemerkungen", type="text")
     */
    private $bemerkungen;


    /**
     * @var string
     *
     * @ORM\Column(name="massnahmen", type="text")
     */
    private $massnahmen;


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
     * Set stStart
     *
     * @param \DateTime $stStart
     *
     * @return Stoerung
     */
    public function setStStart($stStart)
    {
        $this->stStart = $stStart;

        return $this;
    }

    /**
     * Get stStart
     *
     * @return \DateTime
     */
    public function getStStart()
    {
        return $this->stStart;
    }

    /**
     * Set stEnd
     *
     * @param \DateTime $stEnd
     *
     * @return Stoerung
     */
    public function setStEnd($stEnd)
    {
        $this->stEnd = $stEnd;

        return $this;
    }

    /**
     * Get stEnd
     *
     * @return \DateTime
     */
    public function getStEnd()
    {
        return $this->stEnd;
    }

    /**
     * Set bemerkungen
     *
     * @param string $bemerkungen
     *
     * @return Stoerung
     */
    public function setBemerkungen($bemerkungen)
    {
        $this->bemerkungen = $bemerkungen;

        return $this;
    }

    /**
     * Get bemerkungen
     *
     * @return string
     */
    public function getBemerkungen()
    {
        return $this->bemerkungen;
    }



    /**
     * Set massnahmen
     *
     * @param string $massnahmen
     *
     * @return Stoerung
     */
    public function setMassnahmen($massnahmen)
    {
        $this->massnahmen = $massnahmen;

        return $this;
    }

    /**
     * Get massnahmen
     *
     * @return string
     */
    public function getMassnahmen()
    {
        return $this->massnahmen;
    }

    /**
     * Set maschine
     *
     * @param \AppBundle\Entity\Maschine $maschine
     *
     * @return Stoerung
     */
    public function setMaschine(\AppBundle\Entity\Maschine $maschine = null)
    {
        $this->maschine = $maschine;

        return $this;
    }

    /**
     * Get maschine
     *
     * @return \AppBundle\Entity\Maschine
     */
    public function getMaschine()
    {
        return $this->maschine;
    }
}
