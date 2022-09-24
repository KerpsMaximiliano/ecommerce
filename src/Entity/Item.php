<?php
    namespace App\Entity;

    use Doctrine\ORM\Mapping as ORM;

    use App\Repository\ItemRepository;

    /**
     * @ORM\Entity(repositoryClass=ItemRepository::class)
     */
    class Item{
        /**
         * @ORM\Id
         * @ORM\GeneratedValue
         * @ORM\Column(type="integer")
         */
        private $id;

        /**
         * @ORM\Column(type="integer")
         */
        private $cantidad;

        /**
         * @ORM\ManyToOne(targetEntity=Producto::class, inversedBy="items")
         * @ORM\JoinColumn(nullable=false)
         */
        private $producto;

        /**
         * @ORM\ManyToOne(targetEntity=Carrito::class, inversedBy="items")
         * @ORM\JoinColumn(nullable=false)
         */
        private $carrito;

        public function getId(): ?int {
            return $this->id;
        }

        public function getCantidad(): ?int {
            return $this->cantidad;
        }

        public function setCantidad(int $cantidad): self {
            $this->cantidad = $cantidad;
            return $this;
        }

        public function getProducto(): ?Producto {
            return $this->producto;
        }

        public function setProducto(?Producto $producto): self {
            $this->producto = $producto;
            return $this;
        }

        public function getCarrito(): ?Carrito {
            return $this->carrito;
        }

        public function setCarrito(?Carrito $carrito): self {
            $this->carrito = $carrito;
            return $this;
        }

        public function equals (Item $item): bool {
            return $this->getProducto()->getId() === $item->getProducto()->getId();
        }

        public function getTotal(): int {
            return $this->getCantidad() * $this->getProducto()->getPrecio();
        }
    }
?>