<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerfilControleAcaoRepository")
 */
class PerfilControleAcao
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Perfil", inversedBy="perfilControleAcoes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $perfil;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $controle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $acao;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $route;

    /**
     * PerfilControleAcao constructor.
     *
     * @param $perfil
     * @param $controle
     * @param $acao
     * @param $route
     */
    public function __construct($perfil, $controle, $acao, $route)
    {
        $this->perfil = $perfil;
        $this->controle = $controle;
        $this->acao = $acao;
        $this->route = $route;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerfil(): ?Perfil
    {
        return $this->perfil;
    }

    public function setPerfil(?Perfil $perfil): self
    {
        $this->perfil = $perfil;

        return $this;
    }

    public function getControle(): ?string
    {
        return $this->controle;
    }

    public function setControle(string $controle): self
    {
        $this->controle = $controle;

        return $this;
    }

    public function getAcao(): ?string
    {
        return $this->acao;
    }

    public function setAcao(string $acao): self
    {
        $this->acao = $acao;

        return $this;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }
}
