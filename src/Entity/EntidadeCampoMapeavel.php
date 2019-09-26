<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntidadeCampoMapeavelRepository")
 */
class EntidadeCampoMapeavel
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
    private $nomeEntidade;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dadoMapeavel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeEntidade(): ?string
    {
        return $this->nomeEntidade;
    }

    public function setNomeEntidade(string $nomeEntidade): self
    {
        $this->nomeEntidade = $nomeEntidade;

        return $this;
    }

    public function getDadoMapeavel(): ?string
    {
        return $this->dadoMapeavel;
    }

    public function setDadoMapeavel(string $dadoMapeavel): self
    {
        $this->dadoMapeavel = $dadoMapeavel;

        return $this;
    }
}
