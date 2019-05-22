<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlunoRepository")
 */
class Aluno implements IEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nome;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $data_nascimento;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comentario", mappedBy="aluno", orphanRemoval=true)
     */
    private $comentarios;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpeg","image/png" })
     */
    private $file;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Acompanhamento", mappedBy="aluno", orphanRemoval=true)
     */
    private $acompanhamentos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Escola", inversedBy="alunos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $escola;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->acompanhamentos = new ArrayCollection();
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

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(?\DateTimeInterface $data_nascimento): self
    {
        $this->data_nascimento = $data_nascimento;

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios[] = $comentario;
            $comentario->setAluno($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->contains($comentario)) {
            $this->comentarios->removeElement($comentario);
            // set the owning side to null (unless already changed)
            if ($comentario->getAluno() === $this) {
                $comentario->setAluno(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNome();
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

    /**
     * @return Collection|Acompanhamento[]
     */
    public function getAcompanhamentos(): Collection
    {
        return $this->acompanhamentos;
    }

    public function addAcompanhamento(Acompanhamento $acompanhamento): self
    {
        if (!$this->acompanhamentos->contains($acompanhamento)) {
            $this->acompanhamentos[] = $acompanhamento;
            $acompanhamento->setAluno($this);
        }

        return $this;
    }

    public function removeAcompanhamento(Acompanhamento $acompanhamento): self
    {
        if ($this->acompanhamentos->contains($acompanhamento)) {
            $this->acompanhamentos->removeElement($acompanhamento);
            // set the owning side to null (unless already changed)
            if ($acompanhamento->getAluno() === $this) {
                $acompanhamento->setAluno(null);
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
}
