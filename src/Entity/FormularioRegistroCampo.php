<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormularioRegistroCampoRepository")
 */
class FormularioRegistroCampo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FormularioRegistro", inversedBy="formularioRegistroCampos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formularioRegistro;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FormularioCampo", inversedBy="formularioRegistroCampos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formularioCampo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $valor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormularioRegistro(): ?FormularioRegistro
    {
        return $this->formularioRegistro;
    }

    public function setFormularioRegistro(?FormularioRegistro $formularioRegistro): self
    {
        $this->formularioRegistro = $formularioRegistro;

        return $this;
    }

    public function getFormularioCampo(): ?FormularioCampo
    {
        return $this->formularioCampo;
    }

    public function setFormularioCampo(?FormularioCampo $formularioCampo): self
    {
        $this->formularioCampo = $formularioCampo;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(?string $valor): self
    {
        $this->valor = $valor;

        return $this;
    }
}
