<?php

namespace App\Entity;

use App\Repository\BulbRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BulbRepository::class)]
class Bulb
{/*  */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $room_label = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_on = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(nullable: true)]
    private ?float $luminosity = null;

    #[ORM\Column(nullable: true)]
    private ?int $hours = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $wifi = null;

    #[ORM\ManyToOne(inversedBy: 'bulbs')]
    private ?Model $model_id = null;

    #[ORM\ManyToOne(inversedBy: 'bulbs')]
    private ?Mood $mood_id = null;

    #[ORM\ManyToOne(inversedBy: 'bulbs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Place $place_id = null;


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

    public function getRoomLabel(): ?string
    {
        return $this->room_label;
    }

    public function setRoomLabel(string $room_label): static
    {
        $this->room_label = $room_label;

        return $this;
    }

    public function getIsOn(): ?bool
    {
        return $this->is_on;
    }

    public function setIsOn(bool $is_on): static
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

    public function getWifi(): ?string
    {
        return $this->wifi;
    }

    public function setWifi(string $wifi): static
    {
        $this->wifi = $wifi;

        return $this;
    }

    public function getModelId(): ?Model
    {
        return $this->model_id;
    }

    public function setModelId(?Model $model_id): static
    {
        $this->model_id = $model_id;

        return $this;
    }

    public function getMoodId(): ?Mood
    {
        return $this->mood_id;
    }

    public function setMoodId(?Mood $mood_id): static
    {
        $this->mood_id = $mood_id;

        return $this;
    }

    public function getPlaceId(): ?Place
    {
        return $this->place_id;
    }

    public function setPlaceId(?Place $place_id): static
    {
        $this->place_id = $place_id;

        return $this;
    }
}
