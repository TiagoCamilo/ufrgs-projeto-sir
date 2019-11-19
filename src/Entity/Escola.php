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
class Escola implements EntityInterface
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
     * @ORM\OneToMany(targetEntity="App\Entity\Aluno", mappedBy="escola")
     */
    private $alunos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Formulario", mappedBy="escola", cascade={"persist"})
     */
    private $formularios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Usuario", mappedBy="escola")
     */
    private $usuarios;

    public function __construct()
    {
        $this->educadores = new ArrayCollection();
        $this->alunos = new ArrayCollection();
        $this->formularios = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
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

    /**
     * @return Collection|Formulario[]
     */
    public function getFormularios(): Collection
    {
        return $this->formularios;
    }

    public function addFormulario(Formulario $formulario): self
    {
        if (!$this->formularios->contains($formulario)) {
            $this->formularios[] = $formulario;
            $formulario->setEscola($this);
        }

        return $this;
    }

    public function removeFormulario(Formulario $formulario): self
    {
        if ($this->formularios->contains($formulario)) {
            $this->formularios->removeElement($formulario);
            // set the owning side to null (unless already changed)
            if ($formulario->getEscola() === $this) {
                $formulario->setEscola(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Usuario[]
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): self
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
            $usuario->setEscola($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): self
    {
        if ($this->usuarios->contains($usuario)) {
            $this->usuarios->removeElement($usuario);
            // set the owning side to null (unless already changed)
            if ($usuario->getEscola() === $this) {
                $usuario->setEscola(null);
            }
        }

        return $this;
    }
}
