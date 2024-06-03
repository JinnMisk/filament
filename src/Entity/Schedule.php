<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $start_day = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $end_day = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $recurrence = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $start_hour = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $end_hour = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\ManyToOne]
    private ?Mood $mood_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDay(): ?\DateTimeImmutable
    {
        return $this->start_day;
    }

    public function setStartDay(?\DateTimeImmutable $start_day): static
    {
        $this->start_day = $start_day;

        return $this;
    }

    public function getEndDay(): ?\DateTimeImmutable
    {
        return $this->end_day;
    }

    public function setEndDay(?\DateTimeImmutable $end_day): static
    {
        $this->end_day = $end_day;

        return $this;
    }

    public function getRecurrence(): ?string
    {
        return $this->recurrence;
    }

    public function setRecurrence(?string $recurrence): static
    {
        $this->recurrence = $recurrence;

        return $this;
    }

    public function getStartHour(): ?\DateTimeImmutable
    {
        return $this->start_hour;
    }

    public function setStartHour(?\DateTimeImmutable $start_hour): static
    {
        $this->start_hour = $start_hour;

        return $this;
    }

    public function getEndHour(): ?\DateTimeImmutable
    {
        return $this->end_hour;
    }

    public function setEndHour(?\DateTimeImmutable $end_hour): static
    {
        $this->end_hour = $end_hour;

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

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

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
}
