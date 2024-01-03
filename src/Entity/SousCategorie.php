<?php

namespace App\Entity;

use App\Repository\SousCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousCategorieRepository::class)]
class SousCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'sousCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $idCategorie = null;

    #[ORM\OneToMany(mappedBy: 'idSousCategorie', targetEntity: Recette::class)]
    private Collection $idRecette;

    public function __construct()
    {
        $this->idRecette = new ArrayCollection();
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

    public function getIdCategorie(): ?Categorie
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?Categorie $idCategorie): static
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getIdRecette(): Collection
    {
        return $this->idRecette;
    }

    public function addIdRecette(Recette $idRecette): static
    {
        if (!$this->idRecette->contains($idRecette)) {
            $this->idRecette->add($idRecette);
            $idRecette->setIdSousCategorie($this);
        }

        return $this;
    }

    public function removeIdRecette(Recette $idRecette): static
    {
        if ($this->idRecette->removeElement($idRecette)) {
            // set the owning side to null (unless already changed)
            if ($idRecette->getIdSousCategorie() === $this) {
                $idRecette->setIdSousCategorie(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }
}
