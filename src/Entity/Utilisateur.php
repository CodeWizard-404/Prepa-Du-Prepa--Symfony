<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{

    #[ORM\Column(length: 255)]
    private ?string $type = null;
    
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?personne $id_utilisateur = null;


    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getIdUtilisateur(): ?personne
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?personne $id_utilisateur): static
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }
}
