<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?Image $photoRecette = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?RecetteIngredient $idRecetteIngredient = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $preparation = null;

    #[ORM\ManyToOne(inversedBy: 'idRecette')]
    private ?SousCategorie $idSousCategorie = null;

    #[ORM\OneToMany(mappedBy: 'idRecette', targetEntity: NotePlat::class)]
    private Collection $notePlats;

    #[ORM\ManyToOne(inversedBy: 'idRecette')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commentaire $idCommentaire = null;

    #[ORM\Column(length: 20)]
    private ?string $tempDeCuisson = null;

    #[ORM\Column]
    private ?int $calorie = null;

    public function __construct()
    {
        $this->notePlats = new ArrayCollection();
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

    public function getPhotoRecette(): ?Image
    {
        return $this->photoRecette;
    }

    public function setPhotoRecette(?Image $photoRecette): static
    {
        $this->photoRecette = $photoRecette;

        return $this;
    }

    public function getIdRecetteIngredient(): ?RecetteIngredient
    {
        return $this->idRecetteIngredient;
    }

    public function setIdRecetteIngredient(?RecetteIngredient $idRecetteIngredient): static
    {
        $this->idRecetteIngredient = $idRecetteIngredient;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): static
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getIdSousCategorie(): ?SousCategorie
    {
        return $this->idSousCategorie;
    }

    public function setIdSousCategorie(?SousCategorie $idSousCategorie): static
    {
        $this->idSousCategorie = $idSousCategorie;

        return $this;
    }

    /**
     * @return Collection<int, NotePlat>
     */
    public function getNotePlats(): Collection
    {
        return $this->notePlats;
    }

    public function addNotePlat(NotePlat $notePlat): static
    {
        if (!$this->notePlats->contains($notePlat)) {
            $this->notePlats->add($notePlat);
            $notePlat->setIdRecette($this);
        }

        return $this;
    }

    public function removeNotePlat(NotePlat $notePlat): static
    {
        if ($this->notePlats->removeElement($notePlat)) {
            // set the owning side to null (unless already changed)
            if ($notePlat->getIdRecette() === $this) {
                $notePlat->setIdRecette(null);
            }
        }

        return $this;
    }

    public function getIdCommentaire(): ?Commentaire
    {
        return $this->idCommentaire;
    }

    public function setIdCommentaire(?Commentaire $idCommentaire): static
    {
        $this->idCommentaire = $idCommentaire;

        return $this;
    }

    public function getTempDeCuisson(): ?string
    {
        return $this->tempDeCuisson;
    }

    public function setTempDeCuisson(string $tempDeCuisson): static
    {
        $this->tempDeCuisson = $tempDeCuisson;

        return $this;
    }

    public function getCalorie(): ?int
    {
        return $this->calorie;
    }

    public function setCalorie(int $calorie): static
    {
        $this->calorie = $calorie;

        return $this;
    }
}
