<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormularioCampoRepository")
 */
class FormularioCampo implements EntityInterface
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FormularioAgrupador", inversedBy="formularioCampos")
     */
    private $agrupador;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $ordem;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $largura;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $altura;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EntidadeDadoMapeado")
     */
    private $entidadeDadoMapeado;

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

    public function getAgrupador(): ?FormularioAgrupador
    {
        return $this->agrupador;
    }

    public function setAgrupador(?FormularioAgrupador $agrupador): self
    {
        $this->agrupador = $agrupador;

        return $this;
    }

    public function getOrdem(): ?int
    {
        return $this->ordem;
    }

    public function setOrdem(?int $ordem): self
    {
        $this->ordem = $ordem;

        return $this;
    }

    public function getLargura(): ?int
    {
        return $this->largura;
    }

    public function setLargura(?int $largura): self
    {
        $this->largura = $largura;

        return $this;
    }

    public function getAltura(): ?int
    {
        return $this->altura;
    }

    public function setAltura(?int $altura): self
    {
        $this->altura = $altura;

        return $this;
    }

    public function getEntidadeDadoMapeado(): ?EntidadeDadoMapeado
    {
        return $this->entidadeDadoMapeado;
    }

    public function setEntidadeDadoMapeado(?EntidadeDadoMapeado $entidadeDadoMapeado): self
    {
        $this->entidadeDadoMapeado = $entidadeDadoMapeado;

        return $this;
    }
}
