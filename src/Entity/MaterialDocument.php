<?php

namespace App\Entity;

use App\Repository\MaterialDocumentRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass=MaterialDocumentRepository::class)
 */
class MaterialDocument
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\ManyToOne(targetEntity=Document::class, inversedBy="materialDocuments",cascade={"persist"})
     */
    private $document;

    /**
     * @ORM\ManyToOne(targetEntity=Materials::class, inversedBy="materialDocuments",cascade={"persist"})
     */
    private $material;

    public function __construct()
    {
        $this->setDateCreate(new \DateTime('now'));
        $this->date_update = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getMaterial(): ?Materials
    {
        return $this->material;
    }

    public function setMaterial(?Materials $material): self
    {
        $this->material = $material;

        return $this;
    }
}
