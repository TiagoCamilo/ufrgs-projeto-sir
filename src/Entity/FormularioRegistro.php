<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormularioRegistroRepository")
 */
class FormularioRegistro implements IEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_hora;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioRegistroCampo", mappedBy="formularioRegistro", orphanRemoval=true, cascade={"persist"}, fetch="EAGER")
     */
    private $formularioRegistroCampos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formulario", inversedBy="formularioRegistros")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formulario;

    public function __construct()
    {
        $this->formularioRegistroCampos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataHora(): ?\DateTimeInterface
    {
        return $this->data_hora;
    }

    public function setDataHora(\DateTimeInterface $data_hora): self
    {
        $this->data_hora = $data_hora;

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
            $formularioRegistroCampo->setFormularioRegistro($this);
        }

        return $this;
    }

    public function removeFormularioRegistroCampo(FormularioRegistroCampo $formularioRegistroCampo): self
    {
        if ($this->formularioRegistroCampos->contains($formularioRegistroCampo)) {
            $this->formularioRegistroCampos->removeElement($formularioRegistroCampo);
            // set the owning side to null (unless already changed)
            if ($formularioRegistroCampo->getFormularioRegistro() === $this) {
                $formularioRegistroCampo->setFormularioRegistro(null);
            }
        }

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
}
