<?php

namespace App\Entity;

use App\Repository\ModelRepository;
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
}
