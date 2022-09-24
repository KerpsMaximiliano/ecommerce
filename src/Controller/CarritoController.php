<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    use App\Manager\CarritoManager;

    class CarritoController extends AbstractController{
        /**
        * @Route("/carrito/agregar", name="agregar_producto")
        */
        public function agregarProducto(Request $request, CarritoManager $carritoManager): Response {
            $productoId = $request->get('productoId');
            $productoNombre = $request->get('productoNombre');
            $productoCantidad = $request->get('productoCantidad');
            $usuario = $this->getUser();
            $carritoManager->agregarProducto($usuario, $productoId, $productoCantidad);
            if($productoCantidad>1){
                $this->addFlash('notice', "Se ingreson $productoCantidad unidades del producto $productoNombre");
            } else {
                $this->addFlash('notice', "Se ingreso $productoCantidad unidad del producto $productoNombre");
            }
            return $this->redirectToRoute('listar_productos');
        }

        /**
        * @Route("/carrito/ver", name="ver_carrito")
        */
        public function verCarrito(CarritoManager $carritoManager): Response {
            $usuario = $this->getUser();
            $carrito = $carritoManager->verCarrito($usuario);
            return $this->render('carrito/detalle.html.twig', compact('carrito'));
        }

        /**
        * @Route("/carrito/finalizar", name="finalizar_compra")
        */
        public function finalizarCompra(CarritoManager $carritoManager): Response {
            $usuario = $this->getUser();
            $carrito = $carritoManager->finalizarCompra($usuario);
            $this->addFlash('notice', "¡Compra exitosa!");
            return $this->redirectToRoute('listar_productos');
        }

        /**
        * @Route("/carrito/eliminar/{itemId}", name="eliminar_item")
        */
        public function eliminarItem(CarritoManager $carritoManager, int $itemId): Response {
            $usuario = $this->getUser();
            $carrito = $carritoManager->eliminarItem($usuario, $itemId);
            return $this->redirectToRoute('ver_carrito');
        }
    }
?>