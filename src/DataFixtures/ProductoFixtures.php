<?php
    namespace App\DataFixtures;

    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Persistence\ObjectManager;

    use App\Entity\Producto;

    class ProductoFixtures extends Fixture{
        public function load(ObjectManager $manager): void {
            for ($i = 1; $i < 11; $i++) {
                $producto = new Producto();
                $producto->setNombre('Producto'.$i);
                $producto->setDescripcion('Lorem ipsum dolor sit amet');
                $producto->setPrecio(100+$i);
                $producto->setImagen('producto'.$i.'.svg');
                $manager->persist($producto);
            }
            $manager->flush();
        }
    }
?>