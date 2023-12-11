<?php

namespace App\Entity;

use App\Repository\NotePlatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotePlatRepository::class)]
class NotePlat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'notePlats')]
    private ?Utilisateur $idUtilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'notePlats')]
    private ?Recette $idRecette = null;

    #[ORM\Column]
    private ?int $note = null;

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

    public function getIdRecette(): ?Recette
    {
        return $this->idRecette;
    }

    public function setIdRecette(?Recette $idRecette): static
    {
        $this->idRecette = $idRecette;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }
}
