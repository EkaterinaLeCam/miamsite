<?php

namespace App\Entity;

use App\Entity\Image;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[ORM\Entity(repositoryClass: IngredientRepository::class)]
#[Vich\Uploadable]
class Ingredient
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]

    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'idIngredients', targetEntity: Image::class, cascade:['persist'])]
    #[Vich\UploadableField(mapping: 'image', fileNameProperty: 'nom')]
    private ?Image $idImage = null;

    public function getIdImage(): ?Image
    {
        return $this->idImage;
    }
    public function setIdImage(?Image $idImage): self
    {
        $this->idImage = $idImage;

        return $this;
    }



    #[ORM\OneToMany(mappedBy: 'nomIngredient', targetEntity: RecetteIngredient::class)]
    private Collection $recetteIngredients;

    public function __construct()
    {
        $this->recetteIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }



    /**
     * @return Collection<int, RecetteIngredient>
     */
    public function getRecetteIngredients(): Collection
    {
        return $this->recetteIngredients;
    }

    public function addRecetteIngredient(RecetteIngredient $recetteIngredient): static
    {
        if (!$this->recetteIngredients->contains($recetteIngredient)) {
            $this->recetteIngredients->add($recetteIngredient);
            $recetteIngredient->setNomIngredient($this);
        }

        return $this;
    }

    public function removeRecetteIngredient(RecetteIngredient $recetteIngredient): static
    {
        if ($this->recetteIngredients->removeElement($recetteIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recetteIngredient->getNomIngredient() === $this) {
                $recetteIngredient->setNomIngredient(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }
}
