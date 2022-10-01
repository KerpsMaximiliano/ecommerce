<?php
    namespace App\Manager;

    use App\Repository\ProductoRepository;

    class ProductoManager {
        private $repository;

        public function __construct(ProductoRepository $repository) {
            $this->repository = $repository;
        }

        public function getProductos() {
            return $this->repository->findAll();
        }
        
        public function getProducto(int $id) {
            return $this->repository->find($id);
        }
    }
?>