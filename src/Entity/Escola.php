<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 13/10/18
 * Time: 11:22.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EscolaRepository")
 */
class Escola implements IEntity
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
     * @ORM\Column(type="string" , length=200, nullable=true)
     */
    private $endereco;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Educador", mappedBy="escola", orphanRemoval=true)
     */
    private $educadores;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aluno", mappedBy="escola")
     */
    private $alunos;

    public function __construct()
    {
        $this->educadores = new ArrayCollection();
        $this->alunos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(?string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * @return Collection|Educador[]
     */
    public function getEducadores(): Collection
    {
        return $this->educadores;
    }

    public function addEducador(Educador $educador): self
    {
        if (!$this->educadores->contains($educador)) {
            $this->educadores[] = $educador;
            $educador->setEscola($this);
        }

        return $this;
    }

    public function removeEducador(Educador $educador): self
    {
        if ($this->educadores->contains($educador)) {
            $this->educadores->removeElement($educador);
            // set the owning side to null (unless already changed)
            if ($educador->getEscola() === $this) {
                $educador->setEscola(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNome();
    }

    /**
     * @return Collection|Aluno[]
     */
    public function getAlunos(): Collection
    {
        return $this->alunos;
    }

    public function addAluno(Aluno $aluno): self
    {
        if (!$this->alunos->contains($aluno)) {
            $this->alunos[] = $aluno;
            $aluno->setEscola($this);
        }

        return $this;
    }

    public function removeAluno(Aluno $aluno): self
    {
        if ($this->alunos->contains($aluno)) {
            $this->alunos->removeElement($aluno);
            // set the owning side to null (unless already changed)
            if ($aluno->getEscola() === $this) {
                $aluno->setEscola(null);
            }
        }

        return $this;
    }
}
