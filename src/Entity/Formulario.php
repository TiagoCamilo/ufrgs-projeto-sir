<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormularioRepository")
 */
class Formulario implements IEntity
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
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioCampo", mappedBy="formulario")
     */
    private $formularioCampos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioAgrupador", mappedBy="formulario", orphanRemoval=true, cascade={"persist"})
     * @ORM\OrderBy({"ordem"="ASC"})
     */
    private $formularioAgrupadores;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioRegistro", mappedBy="formulario", orphanRemoval=true)
     */
    private $formularioRegistros;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Escola", inversedBy="formularios")
     */
    private $escola;

    public function __construct()
    {
        $this->formularioCampos = new ArrayCollection();
        $this->formularioAgrupadores = new ArrayCollection();
        $this->formularioRegistros = new ArrayCollection();
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
        $criteria = Criteria::create()
            ->orderBy(['linha' => Criteria::ASC, 'coluna' => Criteria::ASC]);

        return $this->formularioCampos->matching($criteria);
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

    /**
     * @return Collection|FormularioAgrupador[]
     */
    public function getFormularioAgrupadores(): Collection
    {
        return $this->formularioAgrupadores;
    }

    public function addFormularioAgrupadore(FormularioAgrupador $formularioAgrupadore): self
    {
        if (!$this->formularioAgrupadores->contains($formularioAgrupadore)) {
            $this->formularioAgrupadores[] = $formularioAgrupadore;
            $formularioAgrupadore->setFormulario($this);
        }

        return $this;
    }

    public function removeFormularioAgrupadore(FormularioAgrupador $formularioAgrupadore): self
    {
        if ($this->formularioAgrupadores->contains($formularioAgrupadore)) {
            $this->formularioAgrupadores->removeElement($formularioAgrupadore);
            // set the owning side to null (unless already changed)
            if ($formularioAgrupadore->getFormulario() === $this) {
                $formularioAgrupadore->setFormulario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FormularioRegistro[]
     */
    public function getFormularioRegistros(): Collection
    {
        return $this->formularioRegistros;
    }

    public function addFormularioRegistro(FormularioRegistro $formularioRegistro): self
    {
        if (!$this->formularioRegistros->contains($formularioRegistro)) {
            $this->formularioRegistros[] = $formularioRegistro;
            $formularioRegistro->setFormulario($this);
        }

        return $this;
    }

    public function removeFormularioRegistro(FormularioRegistro $formularioRegistro): self
    {
        if ($this->formularioRegistros->contains($formularioRegistro)) {
            $this->formularioRegistros->removeElement($formularioRegistro);
            // set the owning side to null (unless already changed)
            if ($formularioRegistro->getFormulario() === $this) {
                $formularioRegistro->setFormulario(null);
            }
        }

        return $this;
    }

    public function getEscola(): ?Escola
    {
        return $this->escola;
    }

    public function setEscola(?Escola $escola): self
    {
        $this->escola = $escola;

        return $this;
    }

    public function __clone()
    {
        if ($this->id) {
            $this->id = null;
            $registers = $this->getFormularioAgrupadores();

            $registersArray = new ArrayCollection();
            foreach ($registers as $register) {
                /** @var FormularioAgrupador $register */
                $registerClone = clone $register;
                $registerClone->setFormulario($this);
                $registersArray->add($registerClone);
            }
            $this->formularioAgrupadores = $registersArray;
        }
    }
}
