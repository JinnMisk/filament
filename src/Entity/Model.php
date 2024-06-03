<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelRepository::class)]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column]
    private ?int $hours_max = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $default_color = null;

    #[ORM\Column(nullable: true)]
    private ?float $default_luminosity = null;

    /**
     * @var Collection<int, Bulb>
     */
    #[ORM\OneToMany(targetEntity: Bulb::class, mappedBy: 'model_id')]
    private Collection $bulbs;

    public function __construct()
    {
        $this->bulbs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getHoursMax(): ?int
    {
        return $this->hours_max;
    }

    public function setHoursMax(int $hours_max): static
    {
        $this->hours_max = $hours_max;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDefaultColor(): ?string
    {
        return $this->default_color;
    }

    public function setDefaultColor(?string $default_color): static
    {
        $this->default_color = $default_color;

        return $this;
    }

    public function getDefaultLuminosity(): ?float
    {
        return $this->default_luminosity;
    }

    public function setDefaultLuminosity(?float $default_luminosity): static
    {
        $this->default_luminosity = $default_luminosity;

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
            $bulb->setModelId($this);
        }

        return $this;
    }

    public function removeBulb(Bulb $bulb): static
    {
        if ($this->bulbs->removeElement($bulb)) {
            // set the owning side to null (unless already changed)
            if ($bulb->getModelId() === $this) {
                $bulb->setModelId(null);
            }
        }

        return $this;
    }
}
