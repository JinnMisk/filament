<?php

namespace App\Entity;

use App\Repository\BulbRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BulbRepository::class)]
class Bulb
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $room_label = null;

    #[ORM\Column]
    private ?bool $is_on = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column(nullable: true)]
    private ?float $luminosity = null;

    #[ORM\Column(nullable: true)]
    private ?int $hours = null;

    #[ORM\Column(nullable: true)]
    private ?int $hours_max = null;

    #[ORM\Column(length: 255)]
    private ?string $wifi = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getRoomLabel(): ?string
    {
        return $this->room_label;
    }

    public function setRoomLabel(string $room_label): static
    {
        $this->room_label = $room_label;

        return $this;
    }

    public function isOn(): ?bool
    {
        return $this->is_on;
    }

    public function setOn(bool $is_on): static
    {
        $this->is_on = $is_on;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
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

    public function setLuminosity(?float $luminosity): static
    {
        $this->luminosity = $luminosity;

        return $this;
    }

    public function getHours(): ?int
    {
        return $this->hours;
    }

    public function setHours(?int $hours): static
    {
        $this->hours = $hours;

        return $this;
    }

    public function getHoursMax(): ?int
    {
        return $this->hours_max;
    }

    public function setHoursMax(?int $hours_max): static
    {
        $this->hours_max = $hours_max;

        return $this;
    }

    public function getWifi(): ?string
    {
        return $this->wifi;
    }

    public function setWifi(string $wifi): static
    {
        $this->wifi = $wifi;

        return $this;
    }
}
