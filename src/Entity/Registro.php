<?php

namespace App\Entity;

use App\Repository\RegistroRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RegistroRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Registro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paterno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $materno;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Gedmo\Slug(fields={"nombre", "paterno", "materno"}, updatable=false)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

//    /**
//    * @ORM\Column(type="string", length=255, nullable=true)
//   */
// private $unidad;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_solicitud", fileNameProperty="solicitudName")
     *
     * @Assert\File(
     *     maxSize = "15M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 10 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Favor de subir un archivo PDF válido (carta solicitud)"
     * )
     *
     * @var File
     */
    public $solicitudFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $solicitudName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_cv", fileNameProperty="cvName")
     *
     * @Assert\File(
     *     maxSize = "15M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 10 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Favor de subir un archivo PDF válido (CV)"
     * )
     *
     * @var File
     */
    public $cvFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cvName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_comprobante", fileNameProperty="comprobanteName")
     *
     * @Assert\File(
     *     maxSize = "15M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 10 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Favor de subir un archivo PDF válido (comprobante de grado)"
     * )
     *
     * @var File
     */
    public $comprobanteFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comprobanteName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_curso", fileNameProperty="cursoName")
     *
     * @Assert\File(
     *     maxSize = "40M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 20 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Favor de subir un archivo PDF válido (comprobantes y certificaciones)"
     * )
     *
     * @var File
     */
    public $cursoFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cursoName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_ref1recom", fileNameProperty="ref1recomName")
     *
     * @Assert\File(
     *     maxSize = "10M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 2 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Favor de subir un archivo PDF válido (recomendación 1)"
     * )
     *
     * @var File
     */
    public $ref1recomFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ref1recomName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_ref2recom", fileNameProperty="ref2recomName")
     *
     * @Assert\File(
     *     maxSize = "10M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 2 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Favor de subir un archivo PDF válido (recomendación 2)"
     * )
     *
     * @var File
     */
    public $ref2recomFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ref2recomName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * @param mixed $paterno
     */
    public function setPaterno($paterno): void
    {
        $this->paterno = $paterno;
    }

    public function getMaterno(): ?string
    {
        return $this->materno;
    }

    public function setMaterno(string $materno): self
    {
        $this->materno = $materno;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

   /* public function getUnidad(): ?string
    {
        return $this->unidad;
    }

    public function setUnidad(?string $unidad): self
    {
        $this->unidad = $unidad;

        return $this;
    }*/
    /**
     * Set created
     *
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreated(new \DateTime());
        $this->setModified(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setModified(new \DateTime());
    }

    /**
     * Set solicitudFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $solicitud
     */
    public function setSolicitudFile(?File $solicitud = null): void
    {
        $this->solicitudFile = $solicitud;

        if (null !== $solicitud) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getSolicitudFile(): ?File
    {
        return $this->solicitudFile;
    }

    public function getSolicitudName(): ?string
    {
        return $this->solicitudName;
    }

    public function setSolicitudName($solicitudName): void
    {
        $this->solicitudName = $solicitudName;
    }

    /**
     * Set cvFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $cv
     */
    public function setCvFile(?File $cv = null): void
    {
        $this->cvFile = $cv;

        if (null !== $cv) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getCvFile(): ?File
    {
        return $this->cvFile;
    }

    public function getCvName(): ?string
    {
        return $this->cvName;
    }

    public function setCvName($cvName): void
    {
        $this->cvName = $cvName;
    }

    /**
     * Set comprobanteFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $comprobante
     */
    public function setComprobanteFile(?File $comprobante = null): void
    {
        $this->comprobanteFile = $comprobante;

        if (null !== $comprobante) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getComprobanteFile(): ?File
    {
        return $this->comprobanteFile;
    }

    public function getComprobanteName(): ?string
    {
        return $this->comprobanteName;
    }

    public function setComprobanteName($comprobanteName): void
    {
        $this->comprobanteName = $comprobanteName;
    }

    /**
     * Set cursoFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $curso
     */
    public function setCursoFile(?File $curso = null): void
    {
        $this->cursoFile = $curso;

        if (null !== $curso) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getCursoFile(): ?File
    {
        return $this->cursoFile;
    }

    public function getCursoName(): ?string
    {
        return $this->cursoName;
    }

    public function setCursoName($cursoName): void
    {
        $this->cursoName = $cursoName;
    }

    /**
     * Set ref1recomFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $ref1recom
     */
    public function setRef1recomFile(File $ref1recom = null)
    {
        $this->ref1recomFile = $ref1recom;
        if ($ref1recom) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getRef1recomFile(): ?File
    {
        return $this->ref1recomFile;
    }

    public function getRef1recomName(): ?string
    {
        return $this->ref1recomName;
    }

    public function setRef1recomName($ref1recomName): void
    {
        $this->ref1recomName = $ref1recomName;
    }


    /**
     * Set ref2recomFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $ref2recom
     */
    public function setRef2recomFile(File $ref2recom = null)
    {
        $this->ref2recomFile = $ref2recom;
        if ($ref2recom) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getRef2recomFile(): ?File
    {
        return $this->ref2recomFile;
    }

    public function getRef2recomName(): ?string
    {
        return $this->ref2recomName;
    }

    public function setRef2recomName($ref2recomName): void
    {
        $this->ref2recomName = $ref2recomName;
    }


}
