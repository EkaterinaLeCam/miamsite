<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'idImage', targetEntity: Ingredient::class)]
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
}
