<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EducadorRepository")
 */
class Educador implements IEntity
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
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="educador")
     */
    private $app_user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Acompanhamento", mappedBy="educador")
     */
    private $acompanhamentos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Escola", inversedBy="educadores")
     * @ORM\JoinColumn(nullable=false)
     */
    private $escola;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parecer", mappedBy="educador")
     */
    private $pareceres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioRegistro", mappedBy="educador")
     */
    private $formularioRegistros;

    public function __construct()
    {
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

    public function getAppUser(): ?User
    {
        return $this->app_user;
    }

    public function setAppUser(?User $app_user): self
    {
        $this->app_user = $app_user;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNome();
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
            $acompanhamento->setEducador($this);
        }

        return $this;
    }

    public function removeAcompanhamento(Acompanhamento $acompanhamento): self
    {
        if ($this->acompanhamentos->contains($acompanhamento)) {
            $this->acompanhamentos->removeElement($acompanhamento);
            // set the owning side to null (unless already changed)
            if ($acompanhamento->getEducador() === $this) {
                $acompanhamento->setEducador(null);
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
            $parecere->setEducador($this);
        }

        return $this;
    }

    public function removeParecere(Parecer $parecere): self
    {
        if ($this->pareceres->contains($parecere)) {
            $this->pareceres->removeElement($parecere);
            // set the owning side to null (unless already changed)
            if ($parecere->getEducador() === $this) {
                $parecere->setEducador(null);
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
            $formularioRegistro->setEducador($this);
        }

        return $this;
    }

    public function removeFormularioRegistro(FormularioRegistro $formularioRegistro): self
    {
        if ($this->formularioRegistros->contains($formularioRegistro)) {
            $this->formularioRegistros->removeElement($formularioRegistro);
            // set the owning side to null (unless already changed)
            if ($formularioRegistro->getEducador() === $this) {
                $formularioRegistro->setEducador(null);
            }
        }

        return $this;
    }
}
