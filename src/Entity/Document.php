<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

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
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="documents",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=ServiceDocument::class, mappedBy="document")
     */
    private $serviceDocuments;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="document",cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=MaterialDocument::class, mappedBy="document")
     */
    private $materialDocuments;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $additionnalInformation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeBat;

    public function __construct()
    {
        $this->serviceDocuments = new ArrayCollection();
        $this->setDateCreate(new \DateTime('now'));
        $this->date_update = new \DateTime();
        $this->setIsActive(true);
        $this->images = new ArrayCollection();
        $this->materialDocuments = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

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

    public function getClient(): ?Customer
    {
        return $this->client;
    }

    public function setClient(?Customer $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|ServiceDocument[]
     */
    public function getServiceDocuments(): Collection
    {
        return $this->serviceDocuments;
    }

    public function addServiceDocument(ServiceDocument $serviceDocument): self
    {
        if (!$this->serviceDocuments->contains($serviceDocument)) {
            $this->serviceDocuments[] = $serviceDocument;
            $serviceDocument->setDocument($this);
        }

        return $this;
    }

    public function removeServiceDocument(ServiceDocument $serviceDocument): self
    {
        if ($this->serviceDocuments->contains($serviceDocument)) {
            $this->serviceDocuments->removeElement($serviceDocument);
            // set the owning side to null (unless already changed)
            if ($serviceDocument->getDocument() === $this) {
                $serviceDocument->setDocument(null);
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
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setDocument($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getDocument() === $this) {
                $image->setDocument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MaterialDocument[]
     */
    public function getMaterialDocuments(): Collection
    {
        return $this->materialDocuments;
    }

    public function addMaterialDocument(MaterialDocument $materialDocument): self
    {
        if (!$this->materialDocuments->contains($materialDocument)) {
            $this->materialDocuments[] = $materialDocument;
            $materialDocument->setDocument($this);
        }

        return $this;
    }

    public function removeMaterialDocument(MaterialDocument $materialDocument): self
    {
        if ($this->materialDocuments->contains($materialDocument)) {
            $this->materialDocuments->removeElement($materialDocument);
            // set the owning side to null (unless already changed)
            if ($materialDocument->getDocument() === $this) {
                $materialDocument->setDocument(null);
            }
        }

        return $this;
    }

    public function getAdditionnalInformation(): ?string
    {
        return $this->additionnalInformation;
    }

    public function setAdditionnalInformation(string $additionnalInformation): self
    {
        $this->additionnalInformation = $additionnalInformation;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTypeBat(): ?string
    {
        return $this->typeBat;
    }

    public function setTypeBat(string $typeBat): self
    {
        $this->typeBat = $typeBat;

        return $this;
    }
}
