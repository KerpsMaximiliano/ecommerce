<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Response;

    use App\Manager\ProductoManager;

    class ProductoController extends AbstractController{
        /**
        * @Route("/", name="listar_productos")
        */
        public function listarProductos(ProductoManager $productoManager): Response {
            $products = $productoManager->getProductos();
            if (!$products){
                throw $this->createNotFoundException($products.' no encontrado.');
            }
            return $this->render('product/home.html.twig', compact('products'));
        }
        
        /**
        * @Route("/producto/{id}", name="detalle_producto")
        */
        public function detalleProducto(ProductoManager $productoManager, int $id): Response{
            $product = $productoManager->getProducto($id);
            if (!$product){
                throw $this->createNotFoundException($producto.' no encontrado.');
            }
            return $this->render('product/detail.html.twig', compact('product'));
        }
    }
?>