<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[Vich\Uploadable]
class Image
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    
    private ?int $id = null;
    #[Vich\UploadableField(mapping:'image', fileNameProperty:'nom', size:'imageSize')]
    private ?File $imageFile=null;

    #[ORM\Column(nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
    #[ORM\Column(nullable: true)]
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    


    #[ORM\OneToMany(mappedBy: 'idImage', targetEntity: Ingredient::class, cascade:['persist'])]
    private Collection $idIngredients;

    #[ORM\OneToMany(mappedBy: 'photoRecette', targetEntity: Recette::class)]
    private Collection $recettes;

    public function __construct()
    {
        $this->idIngredients = new ArrayCollection();
        $this->recettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIdIngredients(): Collection
    {
        return $this->idIngredients;
    }

    public function addIdIngredient(Ingredient $idIngredient): static
    {
        if (!$this->idIngredients->contains($idIngredient)) {
            $this->idIngredients->add($idIngredient);
            $idIngredient->setIdImage($this);
        }

        return $this;
    }

    public function removeIdIngredient(Ingredient $idIngredient): static
    {
        if ($this->idIngredients->removeElement($idIngredient)) {
            // set the owning side to null (unless already changed)
            if ($idIngredient->getIdImage() === $this) {
                $idIngredient->setIdImage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): static
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes->add($recette);
            $recette->setPhotoRecette($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): static
    {
        if ($this->recettes->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getPhotoRecette() === $this) {
                $recette->setPhotoRecette(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }
}
