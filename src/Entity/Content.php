<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @IgnoreAnnotation("ORM\Column")]
 */
#[ORM\Entity(repositoryClass: ContentRepository::class)]
#[Vich\Uploadable]
class Content
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $type = null;

    #[ORM\Column(length: 20)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $document = null;

    #[ORM\ManyToOne(targetEntity: Course::class, inversedBy: 'contents')]
    private ?Course $course = null;


    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Vich\UploadableField(mapping="content_documents", fileNameProperty="documentPath")
     */
    private ?string $documentPath = null;

    /**
     * @Vich\UploadableField(mapping="content_documents", fileNameProperty="documentPath")
     */
    private ?File $documentFile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDocument(): ?array
    {
        return $this->document;
    }

    public function setDocument(?array $document): static
    {
        $this->document = $document;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): static
    {
        $this->course = $course;

        return $this;
    }
}

