<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComentarioRepository")
 */
class Comentario implements IEntity
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
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Educador")
     * @ORM\JoinColumn(nullable=false)
     */
    private $educador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aluno", inversedBy="comentarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aluno;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     *
     * @Assert\File(maxSize = "200M", mimeTypes={ "image/*", "video/*" })
     */
    private $file;

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

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
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

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): self
    {
        $this->file = $file;

        return $this;
    }
}
