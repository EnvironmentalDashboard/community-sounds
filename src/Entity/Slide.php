<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SlideRepository")
 */
class Slide extends Media
{

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", inversedBy="slide", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Quote", inversedBy="slide", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $quote;

    /**
     * @ORM\Column(type="integer")
     */
    private $probability;

    /**
     * @ORM\Column(type="integer")
     */
    private $decayPercent;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $decayStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $decayEnd;

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getQuote(): ?Quote
    {
        return $this->quote;
    }

    public function setQuote(Quote $quote): self
    {
        $this->quote = $quote;

        return $this;
    }

    public function getProbability(): ?int
    {
        return $this->probability;
    }

    public function setProbability(int $probability): self
    {
        $this->probability = $probability;

        return $this;
    }

    public function getDecayPercent(): ?int
    {
        return $this->decayPercent;
    }

    public function setDecayPercent(int $decayPercent): self
    {
        $this->decayPercent = $decayPercent;

        return $this;
    }

    public function getDecayStart(): ?\DateTimeInterface
    {
        return $this->decayStart;
    }

    public function setDecayStart(?\DateTimeInterface $decayStart): self
    {
        $this->decayStart = $decayStart;

        return $this;
    }

    public function getDecayEnd(): ?\DateTimeInterface
    {
        return $this->decayEnd;
    }

    public function setDecayEnd(?\DateTimeInterface $decayEnd): self
    {
        $this->decayEnd = $decayEnd;

        return $this;
    }
}
