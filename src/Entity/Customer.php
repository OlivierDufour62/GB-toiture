<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @UniqueEntity("email", message="Cet email est déjà utilisé.")
 * @UniqueEntity("phonenumber", message="Ce numéro de téléphone est déjà utilisé.")
 */
class Customer implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phonenumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresOne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $addressTwo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zipcode2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $role;

    /**
     * @var \DateTime $date_create
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $date_create;

    /**
     * @var \DateTime $date_update
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $date_update;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_delete;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="client")
     */
    private $documents;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity=ConstructionSite::class, mappedBy="customer")
     */
    private $constructionSites;

    /**
     * @ORM\Column(type="boolean")
     */
    private $genre;

    public function __construct()
    {
        $this->setDateCreate(new \DateTime('now'));
        $this->date_update = new \DateTime();
        $this->documents = new ArrayCollection();
        $this->setIsActive(true);
        $this->constructionSites = new ArrayCollection();
        $this->quoteRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getAddresOne(): ?string
    {
        return $this->addresOne;
    }

    public function setAddresOne(string $addresOne): self
    {
        $this->addresOne = $addresOne;

        return $this;
    }

    public function getAddressTwo(): ?string
    {
        return $this->addressTwo;
    }

    public function setAddressTwo(string $addressTwo): self
    {
        $this->addressTwo = $addressTwo;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode2(): ?string
    {
        return $this->zipcode2;
    }

    public function setZipcode2(string $zipcode2): self
    {
        $this->zipcode2 = $zipcode2;

        return $this;
    }

    public function getCity2(): ?string
    {
        return $this->city2;
    }

    public function setCity2(string $city2): self
    {
        $this->city2 = $city2;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->date_create;
    }

    public function setDateCreate(\DateTimeInterface $date_create): self
    {
        $this->date_create = $date_create;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->date_update;
    }

    public function setDateUpdate(\DateTimeInterface $date_update): self
    {
        $this->date_update = $date_update;

        return $this;
    }

    public function getDateDelete(): ?\DateTimeInterface
    {
        return $this->date_delete;
    }

    public function setDateDelete(?\DateTimeInterface $date_delete): self
    {
        $this->date_delete = $date_delete;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setClient($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->contains($document)) {
            $this->documents->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getClient() === $this) {
                $document->setClient(null);
            }
        }

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|ConstructionSite[]
     */
    public function getConstructionSites(): Collection
    {
        return $this->constructionSites;
    }

    public function addConstructionSite(ConstructionSite $constructionSite): self
    {
        if (!$this->constructionSites->contains($constructionSite)) {
            $this->constructionSites[] = $constructionSite;
            $constructionSite->setCustomer($this);
        }

        return $this;
    }

    public function removeConstructionSite(ConstructionSite $constructionSite): self
    {
        if ($this->constructionSites->contains($constructionSite)) {
            $this->constructionSites->removeElement($constructionSite);
            // set the owning side to null (unless already changed)
            if ($constructionSite->getCustomer() === $this) {
                $constructionSite->setCustomer(null);
            }
        }

        return $this;
    }

    public function getRoles(): array
    {
        $roles = [];
        $roles[] = $this->role;
        $roles[] = 'ROLE_USER';
        return $roles;
    }

    public function getSalt()
    {
        // you may need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
    }

    public function getGenre(): ?bool
    {
        return $this->genre;
    }

    public function setGenre(bool $genre): self
    {
        $this->genre = $genre;

        return $this;
    }
}
