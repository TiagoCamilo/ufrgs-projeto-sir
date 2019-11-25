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
    const ADMINISTRADOR = 1;
    const EDUCADOR = 2;
    const COORDENADOR = 3;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Usuario", mappedBy="perfil")
     */
    private $usuarios;

    public function __construct()
    {
        $this->perfilControleAcoes = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
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
     * @return Collection|Usuario[]
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): self
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
            $usuario->setPerfil($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): self
    {
        if ($this->usuarios->contains($usuario)) {
            $this->usuarios->removeElement($usuario);
            // set the owning side to null (unless already changed)
            if ($usuario->getPerfil() === $this) {
                $usuario->setPerfil(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNome();
    }
}
