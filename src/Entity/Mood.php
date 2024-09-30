<?php

namespace App\Entity;

use App\Repository\MoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Nullable;

#[ORM\Entity(repositoryClass: MoodRepository::class)]
class Mood
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(nullable: true)]
    private ?float $luminosity = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, Bulb>
     */
    #[ORM\OneToMany(targetEntity: Bulb::class, mappedBy: 'mood_id')]
    private Collection $bulbs;

    #[ORM\Column]
    private ?int $user_id = null;

    public function __construct()
    {
        $this->bulbs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getLuminosity(): ?float
    {
        return $this->luminosity;
    }

    public function setLuminosity(float $luminosity): static
    {
        $this->luminosity = $luminosity;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Bulb>
     */
    public function getBulbs(): Collection
    {
        return $this->bulbs;
    }

    public function addBulb(Bulb $bulb): static
    {
        if (!$this->bulbs->contains($bulb)) {
            $this->bulbs->add($bulb);
            $bulb->setMoodId($this);
        }

        return $this;
    }

    public function removeBulb(Bulb $bulb): static
    {
        if ($this->bulbs->removeElement($bulb)) {
            // set the owning side to null (unless already changed)
            if ($bulb->getMoodId() === $this) {
                $bulb->setMoodId(null);
            }
        }

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function __toString() {
        return $this->label;
    }

}
