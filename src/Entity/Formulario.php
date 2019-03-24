<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormularioRepository")
 */
class Formulario
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
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioCampo", mappedBy="formulario", fetch="EAGER")
     */
    private $formularioCampos;

    public function __construct()
    {
        $this->formularioCampos = new ArrayCollection();
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
     * @return Collection|FormularioCampo[]
     */
    public function getFormularioCampos(): Collection
    {
        return $this->formularioCampos;
    }

    public function addFormularioCampo(FormularioCampo $formularioCampo): self
    {
        if (!$this->formularioCampos->contains($formularioCampo)) {
            $this->formularioCampos[] = $formularioCampo;
            $formularioCampo->setFormulario($this);
        }

        return $this;
    }

    public function removeFormularioCampo(FormularioCampo $formularioCampo): self
    {
        if ($this->formularioCampos->contains($formularioCampo)) {
            $this->formularioCampos->removeElement($formularioCampo);
            // set the owning side to null (unless already changed)
            if ($formularioCampo->getFormulario() === $this) {
                $formularioCampo->setFormulario(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNome();
    }
}
