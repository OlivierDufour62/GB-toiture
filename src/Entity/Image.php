<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     *     mimeTypes = {"image/jpeg", "image/png", "image/tiff"}
     * )
     */
    private $name;

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
     * @ORM\ManyToOne(targetEntity=ConstructionSite::class, inversedBy="images")
     */
    private $constructionSite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=Document::class, inversedBy="images")
     */
    private $document;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="images")
     */
    private $service;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCarroussel;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isGalery;

    
    public function __construct()
    {
        $this->setDateCreate(new \DateTime('now'));
        $this->date_update = new \DateTime();
        $this->setIsActive(true);
        $this->setIsCarroussel(false);
        $this->setIsGalery(false);
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getConstructionSite(): ?ConstructionSite
    {
        return $this->constructionSite;
    }

    public function setConstructionSite(?ConstructionSite $constructionSite): self
    {
        $this->constructionSite = $constructionSite;

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

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getIsCarroussel(): ?bool
    {
        return $this->isCarroussel;
    }

    public function setIsCarroussel(bool $isCarroussel): self
    {
        $this->isCarroussel = $isCarroussel;

        return $this;
    }

    public function getIsGalery(): ?bool
    {
        return $this->isGalery;
    }

    public function setIsGalery(bool $isGalery): self
    {
        $this->isGalery = $isGalery;

        return $this;
    }
}
