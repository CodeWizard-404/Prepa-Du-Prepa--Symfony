<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin
{
    

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'admins')]
    private ?personne $id_admin = null;


    public function getIdAdmin(): ?personne
    {
        return $this->id_admin;
    }

    public function setIdAdmin(?personne $id_admin): static
    {
        $this->id_admin = $id_admin;

        return $this;
    }
}
