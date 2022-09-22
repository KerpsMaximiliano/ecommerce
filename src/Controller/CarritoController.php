<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;

    use App\Manager\CarritoManager;
    use App\Entity\Usuario;

    class CarritoController extends AbstractController{
        /**
        * @Route("/carrito/agregar", name="agregar_producto")
        */
        public function agregarProducto(Request $request, CarritoManager $carritoManager): Response {
            $idProducto = $request->request->get('idProducto');
            $cantidad = $request->request->get('cantidad');

            $carritoManager->agregarProducto($this->getUser(), $idProducto, $cantidad);

            $this->addFlash('notice', "Se ingreso al carrito $cantidad unidades del producto $idProducto");
            return $this->redirectToRoute('listar_productos');
        }

        /**
        * @Route("/carrito/eliminar/{idItem}", name="eliminar_item")
        */
        public function eliminarItem(int $idItem, CarritoManager $carritoManager): Response{
            $carrito = $carritoManager->eliminarItem($idItem, $this->getUser());

            return $this->render('carrito/detalle.html.twig', compact('carrito'));
        }

        /**
        * @Route("/carrito/ver", name="ver_carrito")
        */
        public function verCarrito(CarritoManager $carritoManager): Response{
            $carrito = $carritoManager->verCarrito($this->getUser());

            return $this->render('carrito/detalle.html.twig', compact('carrito'));
        }

        /**
        * @Route("/carrito/vaciar", name="vaciar_carrito")
        */
        public function vaciarCarrito(CarritoManager $carritoManager): Response{
            $carrito = $carritoManager->vaciarCarrito($this->getUser());

            return redirectToRoute('producto/lista.html.twig', compact('carrito'));
        }
    }
?>