<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address_2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $zip = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column]
    private ?int $user_id = null;

    /**
     * @var Collection<int, Bulb>
     */
    #[ORM\OneToMany(targetEntity: Bulb::class, mappedBy: 'place_id')]
    private Collection $bulbs;

    public function __construct()
    {
        $this->bulbs = new ArrayCollection();
    }

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

    public function getAddress1(): ?string
    {
        return $this->address_1;
    }

    public function setAddress1(string $address_1): static
    {
        $this->address_1 = $address_1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address_2;
    }

    public function setAddress2(?string $address_2): static
    {
        $this->address_2 = $address_2;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): static
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

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
            $bulb->setPlaceId($this);
        }

        return $this;
    }

    public function removeBulb(Bulb $bulb): static
    {
        if ($this->bulbs->removeElement($bulb)) {
            // set the owning side to null (unless already changed)
            if ($bulb->getPlaceId() === $this) {
                $bulb->setPlaceId(null);
            }
        }

        return $this;
    }
}
