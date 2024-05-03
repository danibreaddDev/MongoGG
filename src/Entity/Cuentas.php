<?php

namespace App\Entity;

use App\Repository\CuentasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CuentasRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Cuentas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $enlace = null;

    #[ORM\ManyToOne(inversedBy: 'cuentas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Usuario = null;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creadoEn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Juego = null;
    #[ORM\PrePersist]
    public function setValoresCreadoEn()
    {
        $this->creadoEn = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEnlace(): ?string
    {
        return $this->enlace;
    }

    public function setEnlace(string $enlace): static
    {
        $this->enlace = $enlace;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->Usuario;
    }

    public function setUsuario(?User $Usuario): static
    {
        $this->Usuario = $Usuario;

        return $this;
    }

    public function getCreadoEn(): ?\DateTimeInterface
    {
        return $this->creadoEn;
    }

    public function setCreadoEn(?\DateTimeInterface $creadoEn): static
    {
        $this->creadoEn = $creadoEn;

        return $this;
    }

    public function getJuego(): ?string
    {
        return $this->Juego;
    }

    public function setJuego(?string $Juego): static
    {
        $this->Juego = $Juego;

        return $this;
    }
}
