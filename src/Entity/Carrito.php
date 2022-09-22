<?php

namespace App\Entity;

use App\Repository\CarritoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarritoRepository::class)
 */
class Carrito
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $estado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $iniciado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $confirmado;

    /**
     * @ORM\OneToMany(targetEntity=Item::class, mappedBy="carrito")
     */
    private $items;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="carritos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIniciado(): ?\DateTimeInterface
    {
        return $this->iniciado;
    }

    public function setIniciado(\DateTimeInterface $iniciado): self
    {
        $this->iniciado = $iniciado;

        return $this;
    }

    public function getConfirmado(): ?\DateTimeInterface
    {
        return $this->confirmado;
    }

    public function setConfirmado(\DateTimeInterface $confirmado): self
    {
        $this->confirmado = $confirmado;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setCarrito($this);
        }

        return $this;
    }

    public function agregarItem($producto, $cantidad){
        $item = new Item();
        $item->setProducto($producto);
        $item->setCantidad($cantidad);
        addItem($item);
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getCarrito() === $this) {
                $item->setCarrito(null);
            }
        }

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
