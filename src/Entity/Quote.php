<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuoteRepository")
 */
class Quote extends Media
{
    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $attribution;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subAttribution;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateRecorded;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $publicDocumentLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sourceDocumentLink;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Slide", mappedBy="quote", cascade={"persist", "remove"})
     */
    private $slide;

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getAttribution(): ?string
    {
        return $this->attribution;
    }

    public function setAttribution(?string $attribution): self
    {
        $this->attribution = $attribution;

        return $this;
    }

    public function getSubAttribution(): ?string
    {
        return $this->subAttribution;
    }

    public function setSubAttribution(?string $subAttribution): self
    {
        $this->subAttribution = $subAttribution;

        return $this;
    }

    public function getDateRecorded(): ?\DateTimeInterface
    {
        return $this->dateRecorded;
    }

    public function setDateRecorded(?\DateTimeInterface $dateRecorded): self
    {
        $this->dateRecorded = $dateRecorded;

        return $this;
    }

    public function getPublicDocumentLink(): ?string
    {
        return $this->publicDocumentLink;
    }

    public function setPublicDocumentLink(?string $publicDocumentLink): self
    {
        $this->publicDocumentLink = $publicDocumentLink;

        return $this;
    }

    public function getSourceDocumentLink(): ?string
    {
        return $this->sourceDocumentLink;
    }

    public function setSourceDocumentLink(?string $sourceDocumentLink): self
    {
        $this->sourceDocumentLink = $sourceDocumentLink;

        return $this;
    }

    public function getSlide(): ?Slide
    {
        return $this->slide;
    }

    public function setSlide(Slide $slide): self
    {
        $this->slide = $slide;

        // set the owning side of the relation if necessary
        if ($this !== $slide->getQuote()) {
            $slide->setQuote($this);
        }

        return $this;
    }
}
