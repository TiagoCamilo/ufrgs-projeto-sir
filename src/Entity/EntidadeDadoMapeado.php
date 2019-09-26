<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntidadeDadoMapeadoRepository")
 */
class EntidadeDadoMapeado
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
    private $entidadeNome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entidadeDado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntidadeNome(): ?string
    {
        return $this->entidadeNome;
    }

    public function setEntidadeNome(string $entidadeNome): self
    {
        $this->entidadeNome = $entidadeNome;

        return $this;
    }

    public function getEntidadeDado(): ?string
    {
        return $this->entidadeDado;
    }

    public function setEntidadeDado(string $entidadeDado): self
    {
        $this->entidadeDado = $entidadeDado;

        return $this;
    }
}
