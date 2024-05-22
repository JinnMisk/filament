<?php

namespace App\Entity;

use App\Repository\MoodRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Nullable;

#[ORM\Entity(repositoryClass: MoodRepository::class)]
class Mood
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;
 
    #[ORM\Column(nullable: true)]
    private ?float $luminosity = null;

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

    public function setLuminosity(int $luminosity): static
    {
        $this->luminosity = $luminosity;

        return $this;
    }
}
