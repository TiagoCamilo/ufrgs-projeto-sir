<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerfilRepository")
 */
class Perfil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PerfilControleAcao", mappedBy="perfil", orphanRemoval=true, fetch="EAGER")
     */
    private $perfilControleAcoes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="perfil")
     */
    private $users;

    public function __construct()
    {
        $this->perfilControleAcoes = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Collection|PerfilControleAcao[]
     */
    public function getPerfilControleAcoes(): Collection
    {
        return $this->perfilControleAcoes;
    }

    public function addPerfilControleAco(PerfilControleAcao $perfilControleAco): self
    {
        if (!$this->perfilControleAcoes->contains($perfilControleAco)) {
            $this->perfilControleAcoes[] = $perfilControleAco;
            $perfilControleAco->setPerfil($this);
        }

        return $this;
    }

    public function removePerfilControleAco(PerfilControleAcao $perfilControleAco): self
    {
        if ($this->perfilControleAcoes->contains($perfilControleAco)) {
            $this->perfilControleAcoes->removeElement($perfilControleAco);
            // set the owning side to null (unless already changed)
            if ($perfilControleAco->getPerfil() === $this) {
                $perfilControleAco->setPerfil(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setPerfil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getPerfil() === $this) {
                $user->setPerfil(null);
            }
        }

        return $this;
    }
}
