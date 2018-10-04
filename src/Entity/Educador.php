<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EducadorRepository")
 */
class Educador
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nome;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="educador", cascade={"persist", "remove"})
     */
    private $app_user;

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

    public function getAppUser(): ?User
    {
        return $this->app_user;
    }

    public function setAppUser(?User $app_user): self
    {
        $this->app_user = $app_user;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNome();
    }
}
