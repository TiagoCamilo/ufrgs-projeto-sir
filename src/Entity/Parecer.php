<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Educador", inversedBy="pareceres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $educador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aluno", inversedBy="pareceres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aluno;

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

    public function getEducador(): ?Educador
    {
        return $this->educador;
    }

    public function setEducador(?Educador $educador): self
    {
        $this->educador = $educador;

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
}
