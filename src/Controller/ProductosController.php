<?php

namespace App\Controller;

use App\Entity\Productos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductosController extends AbstractController
{
    private $em;

    /**
     * @param em
    */

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Agregar productos nuevos (Create)
    #[Route('/producto/agregar', name: 'agregar', methods:['POST'])]
    public function agregar(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $productos_agregados = [];
        
        foreach($data as $d) {

            $em = $this->em;
            $producto = new Productos();
            
            $producto->setSku($d['sku']);
            $producto->setNombreProducto($d['nombre_producto']);
            $producto->setDescripcion($d['descripcion']);
            $producto->setCreateAt(new \DateTime(date("Y-m-d H:i:s")));
        
            $em->persist($producto);
            $em->flush();

            $productos_agregados[] = 'Producto agregado: ' . $d['sku'];
        }

        return new JsonResponse($productos_agregados);
    }

    // Listar productos (Read)
    #[Route('/producto/lista', name: 'lista', methods:['GET'])]
    public function lista(): JsonResponse
    {
        $producto = $this->em->getRepository(Productos::class)->findAll();
        $lista = [];

        foreach($producto as $p) {
            $lista[] = ['id'                =>  $p->getId(),
                        'sku'               =>  $p->getSku(),
                        'nombre_producto'   =>  $p->getNombreProducto(),
                        'descripcion'       =>  $p->getDescripcion(),
                        'create_at'         =>  $p->getCreateAt(),
                        'update_at'         =>  $p->getUpdateAt()
                        ];
        } 

        return new JsonResponse($lista);
    }

    //Editar productos (Update)
    #[Route('/producto/editar', name: 'editar', methods:['PUT'])]
    public function editar(Request $request): JsonResponse{
    $data = json_decode($request->getContent(), true);

    foreach($data as $d) {
        $producto = $this->em->getRepository(Productos::class)->findOneBy(['sku' => $d['sku']]);

        if ($producto) {
            $producto->setNombreProducto($d['nombre_producto']);
            $producto->setDescripcion($d['descripcion']);
            $producto->setUpdateAt(new \DateTime(date("Y-m-d H:i:s")));

            $this->em->flush();

            $productos_editados[] = 'Producto actualizado: ' . $d['sku'];
        } else {
            // Muestra mensaje de error
            return new JsonResponse(['error' => 'Producto no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }
    }
        return new JsonResponse($productos_editados);
    }

    //Eliminar productos (Delete)
    #[Route('/producto/eliminar/{sku}', name: 'eliminar', methods:['DELETE'])]
    public function delete(Request $request, #[required] $sku): JsonResponse
    {
        $em = $this->em;
        $producto = $em->getRepository(Productos::class)->findOneBy(['sku' => $sku]);
        if (!$producto) {
            return new JsonResponse(['error' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $em->remove($producto);
        $em->flush();

        return new JsonResponse(['mensaje' => 'El producto ' . $sku . ' ha sido eliminado.']);
            
    }
}
