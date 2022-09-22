<?php
    
    namespace App\Manager;

    use Doctrine\Persistence\ManagerRegistry;

    class CarritoManager {
        private $entityManager;

        public function __construct(ManagerRegistry $doctrine) {
            $this->entityManager = $doctrine->getManager();
        }

        public function agregarProducto(
            Usuario $usuario,
            int $productoId,
            int $cantidad
        ) {
            // ...
            // doctrine === entityManager
            $producto = $this->entityManager->getRepository(Producto::class)->find($productoId);

            // Definición e iniciación de un objeto Carrito.
            $carrito = new Carrito();

            // Se configura dicho objeto.
            $carrito->setEstado('Iniciado');
            $carrito->setIniciado(new \DateTime());
            $carrito->setUsuario($usuario);

            // ...
            $item = $carrito->agregarItem($producto, $cantidad);

            // Se persiste en la base de datos ...
            // Objeto Item.
            $entityManager->persist($item);
            // Objeto Carrito.
            $entityManager->persist($carrito);
            // Se realiza ...
            $entityManager->flush();
        }
    }
?>