<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlunoRepository")
 */
class Aluno implements IEntity, LimiterEscolaInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    public $nome;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comentario", mappedBy="aluno", orphanRemoval=true)
     * @ORM\OrderBy({"id"="desc"})
     */
    public $comentarios;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpeg","image/png" })
     */
    public $file;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Acompanhamento", mappedBy="aluno", orphanRemoval=true)
     * @ORM\OrderBy({"id"="desc"})
     */
    public $acompanhamentos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Escola", inversedBy="alunos")
     * @ORM\JoinColumn(nullable=false)
     */
    public $escola;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parecer", mappedBy="aluno", orphanRemoval=true)
     * @ORM\OrderBy({"id"="desc"})
     */
    public $pareceres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioRegistro", mappedBy="aluno", orphanRemoval=true)
     */
    public $formularioRegistros;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $nomeMae;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $nomePai;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    public $historicoEscolar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $turma;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public $dataNascimento;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->acompanhamentos = new ArrayCollection();
        $this->pareceres = new ArrayCollection();
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
        $pareceres = $this->getPareceres();
        $formularios = $this->getFormularioRegistros();

        $elements = new ArrayCollection(
            array_merge($comentarios->toArray(), $acompanhamentos->toArray(), $pareceres->toArray(), $formularios->toArray())
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
            $formularioRegistro->setAluno($this);
        }

        return $this;
    }

    public function removeFormularioRegistro(FormularioRegistro $formularioRegistro): self
    {
        if ($this->formularioRegistros->contains($formularioRegistro)) {
            $this->formularioRegistros->removeElement($formularioRegistro);
            // set the owning side to null (unless already changed)
            if ($formularioRegistro->getAluno() === $this) {
                $formularioRegistro->setAluno(null);
            }
        }

        return $this;
    }

    public function getNomeMae(): ?string
    {
        return $this->nomeMae;
    }

    public function setNomeMae(?string $nomeMae): self
    {
        $this->nomeMae = $nomeMae;

        return $this;
    }

    public function getNomePai(): ?string
    {
        return $this->nomePai;
    }

    public function setNomePai(?string $nomePai): self
    {
        $this->nomePai = $nomePai;

        return $this;
    }

    public function getHistoricoEscolar()
    {
        return !empty($this->historicoEscolar) ? stream_get_contents($this->historicoEscolar) : $this->historicoEscolar;
    }

    public function setHistoricoEscolar($historicoEscolar): self
    {
        $this->historicoEscolar = $historicoEscolar;

        return $this;
    }

    public function getTurma(): ?string
    {
        return $this->turma;
    }

    public function setTurma(?string $turma): self
    {
        $this->turma = $turma;

        return $this;
    }

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(?\DateTimeInterface $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getIdade(): int{
        return 1;
    }

}
