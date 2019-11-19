<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface, LimiterEscolaInterface, IEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    public $email;

    /**
     * @ORM\Column(type="json")
     */
    public $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    public $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Perfil", inversedBy="usuarios")
     * @ORM\JoinColumn(nullable=false)
     */
    public $perfil;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $nome;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Escola", inversedBy="usuarios")
     */
    public $escola;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comentario", mappedBy="usuario")
     */
    public $comentarios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Acompanhamento", mappedBy="usuario")
     */
    public $acompanhamentos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parecer", mappedBy="usuario")
     */
    public $pareceres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormularioRegistro", mappedBy="usuario")
     */
    public $formularioRegistros;

    public $plainPassword;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPerfil(): ?Perfil
    {
        return $this->perfil;
    }

    public function setPerfil(?Perfil $perfil): self
    {
        $this->perfil = $perfil;

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
            $comentario->setUsuario($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->contains($comentario)) {
            $this->comentarios->removeElement($comentario);
            // set the owning side to null (unless already changed)
            if ($comentario->getUsuario() === $this) {
                $comentario->setUsuario(null);
            }
        }

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
            $acompanhamento->setUsuario($this);
        }

        return $this;
    }

    public function removeAcompanhamento(Acompanhamento $acompanhamento): self
    {
        if ($this->acompanhamentos->contains($acompanhamento)) {
            $this->acompanhamentos->removeElement($acompanhamento);
            // set the owning side to null (unless already changed)
            if ($acompanhamento->getUsuario() === $this) {
                $acompanhamento->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Parecer[]
     */
    public function getPareceres(): Collection
    {
        return $this->pareceres;
    }

    public function addParecerer(Parecer $parecere): self
    {
        if (!$this->pareceres->contains($parecere)) {
            $this->pareceres[] = $parecere;
            $parecere->setUsuario($this);
        }

        return $this;
    }

    public function removeParecerer(Parecer $parecere): self
    {
        if ($this->pareceres->contains($parecere)) {
            $this->pareceres->removeElement($parecere);
            // set the owning side to null (unless already changed)
            if ($parecere->getUsuario() === $this) {
                $parecere->setUsuario(null);
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
            $formularioRegistro->setUsuario($this);
        }

        return $this;
    }

    public function removeFormularioRegistro(FormularioRegistro $formularioRegistro): self
    {
        if ($this->formularioRegistros->contains($formularioRegistro)) {
            $this->formularioRegistros->removeElement($formularioRegistro);
            // set the owning side to null (unless already changed)
            if ($formularioRegistro->getUsuario() === $this) {
                $formularioRegistro->setUsuario(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNome();
    }
}
