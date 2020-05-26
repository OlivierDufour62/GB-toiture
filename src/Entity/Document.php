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
     * @ORM\Column(type="boolean")
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
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=ServiceDocument::class, mappedBy="document")
     */
    private $serviceDocuments;

    private $isActive;

    


    public function __construct()
    {
        $this->serviceDocuments = new ArrayCollection();
        $this->setDateCreate(new \DateTime('now'));
        $this->date_update = new \DateTime();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
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
}
