<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Maschine
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MaschineRepository")
 * @Vich\Uploadable
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
     * @ORM\OneToMany(targetEntity="Stoerung", mappedBy="maschine")
     */
    private $stoerungen;

    /**
    * @Vich\UploadableField(mapping="maschine_bild", fileNameProperty="bildDateiname")
    **/
    private $bild;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $bildDateiname;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setBild(File $image = null)
    {
        $this->bild = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getBild()
    {
        return $this->bild;
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

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

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Maschine
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set bildDateiname
     *
     * @param string $bildDateiname
     *
     * @return Maschine
     */
    public function setBildDateiname($bildDateiname)
    {
        $this->bildDateiname = $bildDateiname;

        return $this;
    }

    /**
     * Get bildDateiname
     *
     * @return string
     */
    public function getBildDateiname()
    {
        return $this->bildDateiname;
    }
}
