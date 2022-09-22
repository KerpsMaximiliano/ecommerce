<?php
    namespace App\Entity;

    use App\Repository\ProductoRepository;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity(repositoryClass=ProductoRepository::class)
     */
    class Producto
    {
        /**
         * @ORM\Id
         * @ORM\GeneratedValue
         * @ORM\Column(type="integer")
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=30)
         */
        private $nombre;

        /**
         * @ORM\Column(type="string", length=100)
         */
        private $descripcion;

        /**
         * @ORM\Column(type="float")
         */
        private $precio;

        /**
         * @ORM\Column(type="string", length=50)
         */
        private $imagen;

        /**
         * @ORM\OneToMany(targetEntity=Item::class, mappedBy="producto")
         */
        private $items;

        public function __construct()
        {
            $this->items = new ArrayCollection();
        }

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getNombre(): ?string
        {
            return $this->nombre;
        }

        public function setNombre(string $nombre): self
        {
            $this->nombre = $nombre;

            return $this;
        }

        public function getDescripcion(): ?string
        {
            return $this->descripcion;
        }

        public function setDescripcion(string $descripcion): self
        {
            $this->descripcion = $descripcion;

            return $this;
        }

        public function getPrecio(): ?float
        {
            return $this->precio;
        }

        public function setPrecio(float $precio): self
        {
            $this->precio = $precio;

            return $this;
        }

        public function getImagen(): ?string
        {
            return $this->imagen;
        }

        public function setImagen(string $imagen): self
        {
            $this->imagen = $imagen;

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
                $item->setProducto($this);
            }

            return $this;
        }

        public function removeItem(Item $item): self
        {
            if ($this->items->removeElement($item)) {
                // set the owning side to null (unless already changed)
                if ($item->getProducto() === $this) {
                    $item->setProducto(null);
                }
            }

            return $this;
        }
    }
?>