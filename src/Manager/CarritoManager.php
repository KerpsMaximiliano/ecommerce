<?php
    namespace App\Manager;

    use Doctrine\Persistence\ManagerRegistry;
    use App\Entity\Producto;
    use App\Entity\Usuario;
    use App\Entity\Carrito;
    use App\Entity\Item;

    class CarritoManager {
        public function __construct(ManagerRegistry $doctrine) {
            $this->doctrine = $doctrine;
        }

        public function verCarrito(Usuario $usuario){
            $estado = 'Iniciado';
            return $carrito = $this->doctrine->getRepository(Carrito::class)->findOneBy(compact('usuario', 'estado'));
        }

        public function agregarProducto(Usuario $usuario, int $productoId, int $productoCantidad) {
            $producto = $this->doctrine->getRepository(Producto::class)->find($productoId);
            $carrito = $this->obtenerCarrito($usuario);
            $item = $carrito->agregarItem($producto, $productoCantidad);
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($carrito);
            $entityManager->persist($item);
            $entityManager->flush();
        }

        public function finalizarCompra(Usuario $usuario){
            $estado = 'Iniciado';
            $carrito = $this->doctrine->getRepository(Carrito::class)->findOneBy(compact('usuario', 'estado'));
            $carrito->setEstado('Finalizado');
            $carrito->setConfirmado(new \DateTime());
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($carrito);
            $entityManager->flush();
        }

        public function eliminarItem(Usuario $usuario, int $itemId){
            $item = $this->doctrine->getRepository(Item::class)->find($itemId);
            $estado = 'Iniciado';
            $carrito = $this->doctrine->getRepository(Carrito::class)->findOneBy(compact('usuario', 'estado'));
            $carrito->removeItem($item);
            $entityManager = $this->doctrine->getManager();
            $entityManager->remove($item);
            $entityManager->flush();
        }

        public function vaciarCarrito(Usuario $usuario){
            $estado = 'Iniciado';
            $carrito = $this->doctrine->getRepository(Carrito::class)->findOneBy(compact('usuario', 'estado'));
            $items = $carrito->getItems();
            $entityManager = $this->doctrine->getManager();
            foreach($items as $item ){
                $carrito->removeItem($item);
                $entityManager->remove($item);
            }
            $entityManager->flush();
        }

        private function obtenerCarrito($usuario){
            $estado = 'Iniciado';
            $carrito = $this->doctrine->getRepository(Carrito::class)->findOneBy(compact('usuario', 'estado'));
            if(!$carrito){
                $carrito = new Carrito();
                $carrito->setEstado('Iniciado');
                $carrito->setIniciado(new \DateTime());
                $carrito->setUsuario($usuario);
            }
            return $carrito;
        }
    }
?>