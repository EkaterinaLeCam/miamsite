<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    private ?Utilisateur $idUtilisateur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateDePublication = null;

    #[ORM\OneToMany(mappedBy: 'idCommentaire', targetEntity: Recette::class)]
    private Collection $idRecette;

    #[ORM\OneToMany(mappedBy: 'idCommentaire', targetEntity: TableDeReponses::class)]
    private Collection $tableDeReponses;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $texteCommentaire = null;

    public function __construct()
    {
        $this->idRecette = new ArrayCollection();
        $this->tableDeReponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $idUtilisateur): static
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    public function getDateDePublication(): ?\DateTimeInterface
    {
        return $this->DateDePublication;
    }

    public function setDateDePublication(\DateTimeInterface $DateDePublication): static
    {
        $this->DateDePublication = $DateDePublication;

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
            $idRecette->setIdCommentaire($this);
        }

        return $this;
    }

    public function removeIdRecette(Recette $idRecette): static
    {
        if ($this->idRecette->removeElement($idRecette)) {
            // set the owning side to null (unless already changed)
            if ($idRecette->getIdCommentaire() === $this) {
                $idRecette->setIdCommentaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TableDeReponses>
     */
    public function getTableDeReponses(): Collection
    {
        return $this->tableDeReponses;
    }

    public function addTableDeReponse(TableDeReponses $tableDeReponse): static
    {
        if (!$this->tableDeReponses->contains($tableDeReponse)) {
            $this->tableDeReponses->add($tableDeReponse);
            $tableDeReponse->setIdCommentaire($this);
        }

        return $this;
    }

    public function removeTableDeReponse(TableDeReponses $tableDeReponse): static
    {
        if ($this->tableDeReponses->removeElement($tableDeReponse)) {
            // set the owning side to null (unless already changed)
            if ($tableDeReponse->getIdCommentaire() === $this) {
                $tableDeReponse->setIdCommentaire(null);
            }
        }

        return $this;
    }

    public function getTexteCommentaire(): ?string
    {
        return $this->texteCommentaire;
    }

    public function setTexteCommentaire(string $texteCommentaire): static
    {
        $this->texteCommentaire = $texteCommentaire;

        return $this;
    }
}
