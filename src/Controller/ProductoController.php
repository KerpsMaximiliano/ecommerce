<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    
    use App\Manager\ProductoManager;

    class ProductoController extends AbstractController{
        /**
        * @Route("/", name="listar_productos")
        */
        public function listarProductos(ProductoManager $productoManager): Response {
            $productos = $productoManager->getProductos();
            if (!$productos){
                throw $this->createNotFoundException($productos.' no encontrado.');
            }
            return $this->render('producto/lista.html.twig', compact('productos'));
        }
        
        /**
        * @Route("/producto/{id}", name="detalle_producto")
        */
        public function detalleProducto(ProductoManager $productoManager, int $id): Response{
            $producto = $productoManager->getProducto($id);
            if (!$producto){
                throw $this->createNotFoundException($producto.' no encontrado.');
            }
            return $this->render('producto/detalle.html.twig', compact('producto'));
        }
    }
?>