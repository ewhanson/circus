<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Source
 *
 * @ORM\Table(name="source")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SourceRepository")
 */
class Source extends AbstractTerm
{
    /**
     * YYYY-MM-DD
     * 
     * @var string
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $date;
    
    /**
     * @var Collection|Clipping[]
     * @ORM\OneToMany(targetEntity="Clipping", mappedBy="source")
     */
    private $clippings;
    

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Source
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add clipping
     *
     * @param \AppBundle\Entity\Clipping $clipping
     *
     * @return Source
     */
    public function addClipping(\AppBundle\Entity\Clipping $clipping)
    {
        $this->clippings[] = $clipping;

        return $this;
    }

    /**
     * Remove clipping
     *
     * @param \AppBundle\Entity\Clipping $clipping
     */
    public function removeClipping(\AppBundle\Entity\Clipping $clipping)
    {
        $this->clippings->removeElement($clipping);
    }

    /**
     * Get clippings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClippings()
    {
        return $this->clippings;
    }
}
