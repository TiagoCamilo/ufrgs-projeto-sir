<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormularioAgrupadorRepository")
 */
class FormularioAgrupador implements IEntity
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
    private $titulo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtitulo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coluna1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coluna2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coluna3;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formulario", inversedBy="formularioAgrupadores")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formulario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioCampo", mappedBy="agrupador")
     * @ORM\OrderBy({"linha"="ASC","coluna"="ASC"})
     */
    private $formularioCampos;

    /**
     * @ORM\Column(type="smallint")
     */
    private $ordem;

    public function __construct()
    {
        $this->formularioCampos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getSubtitulo(): ?string
    {
        return $this->subtitulo;
    }

    public function setSubtitulo(?string $subtitulo): self
    {
        $this->subtitulo = $subtitulo;

        return $this;
    }

    public function getColuna1(): ?string
    {
        return $this->coluna1;
    }

    public function setColuna1(?string $coluna1): self
    {
        $this->coluna1 = $coluna1;

        return $this;
    }

    public function getColuna2(): ?string
    {
        return $this->coluna2;
    }

    public function setColuna2(?string $coluna2): self
    {
        $this->coluna2 = $coluna2;

        return $this;
    }

    public function getColuna3(): ?string
    {
        return $this->coluna3;
    }

    public function setColuna3(?string $coluna3): self
    {
        $this->coluna3 = $coluna3;

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

    public function __toString(): string
    {
        return $this->getTitulo();
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
            $formularioCampo->setAgrupador($this);
        }

        return $this;
    }

    public function removeFormularioCampo(FormularioCampo $formularioCampo): self
    {
        if ($this->formularioCampos->contains($formularioCampo)) {
            $this->formularioCampos->removeElement($formularioCampo);
            // set the owning side to null (unless already changed)
            if ($formularioCampo->getAgrupador() === $this) {
                $formularioCampo->setAgrupador(null);
            }
        }

        return $this;
    }

    public function getOrdem(): ?int
    {
        return $this->ordem;
    }

    public function setOrdem(int $ordem): self
    {
        $this->ordem = $ordem;

        return $this;
    }
}
