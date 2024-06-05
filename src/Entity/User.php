<?php

namespace App\Entity;

use App\Entity\Mood;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $last_name = null;

    #[ORM\Column(nullable: true)]
    private ?int $shipping_address_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_address_streetname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_address_postalcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_address_complement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shipping_address_city = null;

    #[ORM\Column(nullable: true)]
    private ?int $billing_address_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_address_streetname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_address_postalcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_address_complement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_address_city = null;

    #[ORM\Column(nullable: true)]
    private ?int $phone_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siret = null;

    /**
     * @var Collection<int, Mood>
     */
    #[ORM\OneToMany(targetEntity: Mood::class, mappedBy: 'user_id')]
    private Collection $moods;

    public function __construct()
    {
        $this->moods = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getShippingAddressNumber(): ?int
    {
        return $this->shipping_address_number;
    }

    public function setShippingAddressNumber(?int $shipping_address_number): static
    {
        $this->shipping_address_number = $shipping_address_number;

        return $this;
    }

    public function getShippingAddressStreetname(): ?string
    {
        return $this->shipping_address_streetname;
    }

    public function setShippingAddressStreetname(string $shipping_address_streetname): static
    {
        $this->shipping_address_streetname = $shipping_address_streetname;

        return $this;
    }

    public function getShippingAddressPostalcode(): ?string
    {
        return $this->shipping_address_postalcode;
    }

    public function setShippingAddressPostalcode(?string $shipping_address_postalcode): static
    {
        $this->shipping_address_postalcode = $shipping_address_postalcode;

        return $this;
    }

    public function getShippingAddressComplement(): ?string
    {
        return $this->shipping_address_complement;
    }

    public function setShippingAddressComplement(?string $shipping_address_complement): static
    {
        $this->shipping_address_complement = $shipping_address_complement;

        return $this;
    }

    public function getShippingAddressCity(): ?string
    {
        return $this->shipping_address_city;
    }

    public function setShippingAddressCity(?string $shipping_address_city): static
    {
        $this->shipping_address_city = $shipping_address_city;

        return $this;
    }

    public function getBillingAddressNumber(): ?int
    {
        return $this->billing_address_number;
    }

    public function setBillingAddressNumber(?int $billing_address_number): static
    {
        $this->billing_address_number = $billing_address_number;

        return $this;
    }

    public function getBillingAddressStreetname(): ?string
    {
        return $this->billing_address_streetname;
    }

    public function setBillingAddressStreetname(?string $billing_address_streetname): static
    {
        $this->billing_address_streetname = $billing_address_streetname;

        return $this;
    }

    public function getBillingAddressPostalcode(): ?string
    {
        return $this->billing_address_postalcode;
    }

    public function setBillingAddressPostalcode(?string $billing_address_postalcode): static
    {
        $this->billing_address_postalcode = $billing_address_postalcode;

        return $this;
    }

    public function getBillingAddressComplement(): ?string
    {
        return $this->billing_address_complement;
    }

    public function setBillingAddressComplement(?string $billing_address_complement): static
    {
        $this->billing_address_complement = $billing_address_complement;

        return $this;
    }

    public function getBillingAddressCity(): ?string
    {
        return $this->billing_address_city;
    }

    public function setBillingAddressCity(?string $billing_address_city): static
    {
        $this->billing_address_city = $billing_address_city;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?int $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }
}
