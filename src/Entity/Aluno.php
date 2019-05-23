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
     * @ORM\OrderBy({"id"="desc"})
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parecer", mappedBy="aluno", orphanRemoval=true)
     */
    private $pareceres;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->acompanhamentos = new ArrayCollection();
        $this->pareceres = new ArrayCollection();
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

    public function getTimelineElements(): Collection
    {
        $comentarios = $this->getComentarios();
        $acompanhamentos = $this->getAcompanhamentos();

        $elements = new ArrayCollection(
            array_merge($comentarios->toArray(), $acompanhamentos->toArray())
        );

        $iterator = $elements->getIterator();
        $iterator->uasort(function ($a, $b) {
            return ($a->getDataHora() > $b->getDataHora()) ? -1 : 1;
        });
        $collection = new ArrayCollection(iterator_to_array($iterator));

        return $collection;
    }

    public function getComentariosAcompanhamentos(): Collection
    {
        $comentarios = $this->getComentarios();
        $acompanhamentos = $this->getAcompanhamentos();

        $elements = new ArrayCollection(
            array_merge($comentarios->toArray(), $acompanhamentos->toArray())
        );

        $iterator = $elements->getIterator();
        $iterator->uasort(function ($a, $b) {
            return ($a->getDataHora() > $b->getDataHora()) ? -1 : 1;
        });
        $collection = new ArrayCollection(iterator_to_array($iterator));

        return $collection;
    }

    /**
     * @return Collection|Parecer[]
     */
    public function getPareceres(): Collection
    {
        return $this->pareceres;
    }

    public function addParecere(Parecer $parecere): self
    {
        if (!$this->pareceres->contains($parecere)) {
            $this->pareceres[] = $parecere;
            $parecere->setAluno($this);
        }

        return $this;
    }

    public function removeParecere(Parecer $parecere): self
    {
        if ($this->pareceres->contains($parecere)) {
            $this->pareceres->removeElement($parecere);
            // set the owning side to null (unless already changed)
            if ($parecere->getAluno() === $this) {
                $parecere->setAluno(null);
            }
        }

        return $this;
    }
}
