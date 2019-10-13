<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParecerRepository")
 */
class Parecer implements IEntity
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
     * @ORM\Column(type="blob")
     * @Assert\NotBlank()
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aluno", inversedBy="pareceres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aluno;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="pareceres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * Parecer constructor.
     */
    public function __construct()
    {
        $this->data_hora = new \DateTime();
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

    public function getDescricao()
    {
        return !empty($this->descricao) ? stream_get_contents($this->descricao) : $this->descricao;
    }

    public function setDescricao($descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getAluno(): ?Aluno
    {
        return $this->aluno;
    }

    public function setAluno(?Aluno $aluno): self
    {
        $this->aluno = $aluno;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }
}
