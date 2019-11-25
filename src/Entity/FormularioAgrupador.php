<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormularioAgrupadorRepository")
 */
class FormularioAgrupador implements EntityInterface, LimiterEscolaInterface
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Formulario", inversedBy="formularioAgrupadores")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formulario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioCampo", mappedBy="agrupador", cascade={"persist"})
     * @ORM\OrderBy({"linha"="ASC","coluna"="ASC", "ordem" ="ASC"})
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
        return $this->getTituloWithFormulario();
    }

    private function getTituloWithFormulario()
    {
        return $this->titulo.' ('.$this->formulario.')';
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

    public function __clone()
    {
        if ($this->id) {
            $this->id = null;
            $registers = $this->getFormularioCampos();

            $registersArray = new ArrayCollection();
            foreach ($registers as $register) {
                /** @var FormularioCampo $register */
                $registerClone = clone $register;
                $registerClone->setAgrupador($this);
                $registersArray->add($registerClone);
            }
            $this->formularioCampos = $registersArray;
        }
    }

    public function getEscola(): ?Escola
    {
        return $this->formulario->getEscola();
    }
}
