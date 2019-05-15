<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormularioCampoRepository")
 */
class FormularioCampo implements IEntity
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
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formulario", inversedBy="formularioCampos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formulario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioRegistroCampo", mappedBy="formularioCampo", orphanRemoval=true)
     */
    private $formularioRegistroCampos;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $linha;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $coluna;

    public function __construct()
    {
        $this->formularioRegistroCampos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getFormulario(): ?Formulario
    {
        return $this->formulario;
    }

    public function setFormulario(?Formulario $formulario): self
    {
        $this->formulario = $formulario;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|FormularioRegistroCampo[]
     */
    public function getFormularioRegistroCampos(): Collection
    {
        return $this->formularioRegistroCampos;
    }

    public function addFormularioRegistroCampo(FormularioRegistroCampo $formularioRegistroCampo): self
    {
        if (!$this->formularioRegistroCampos->contains($formularioRegistroCampo)) {
            $this->formularioRegistroCampos[] = $formularioRegistroCampo;
            $formularioRegistroCampo->setFormularioCampo($this);
        }

        return $this;
    }

    public function removeFormularioRegistroCampo(FormularioRegistroCampo $formularioRegistroCampo): self
    {
        if ($this->formularioRegistroCampos->contains($formularioRegistroCampo)) {
            $this->formularioRegistroCampos->removeElement($formularioRegistroCampo);
            // set the owning side to null (unless already changed)
            if ($formularioRegistroCampo->getFormularioCampo() === $this) {
                $formularioRegistroCampo->setFormularioCampo(null);
            }
        }

        return $this;
    }

    public function getLinha(): ?int
    {
        return $this->linha;
    }

    public function setLinha(?int $linha): self
    {
        $this->linha = $linha;

        return $this;
    }

    public function getColuna(): ?int
    {
        return $this->coluna;
    }

    public function setColuna(?int $coluna): self
    {
        $this->coluna = $coluna;

        return $this;
    }
}
