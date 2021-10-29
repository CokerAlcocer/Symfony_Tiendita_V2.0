<?php

namespace App\Controller;

header('Access-Control-Allow-Origin: *');

use Doctrine\DBAL\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends AbstractController{

    public function findAllProducts(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p.idproduct, p.name, p.precio, p.status FROM App:Products p');
        $listProducts = $query->getResult();

        $data = [
            'status' => 200,
            'message' => 'No existen datos...'
        ];

        if(count($listProducts) > 0){
            $data = [
                'status' => 200,
                'message' => 'Se encontraron '.count($listProducts).' resultados.',
                'listProducts' => $listProducts
            ];
        }

        return new JsonResponse($data);
    }

    public function findById($id){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p.idproduct, p.name, p.precio, p.status FROM App:Products p WHERE p.idproduct = :id');
        $query->setParameter(':id', $id);
        $product = $query->getResult();

        $data = [
            'status' => 200,
            'message' => 'Se encontró el producto',
            'product' => $product
        ];

        return new JsonResponse($data);
    }

    public function create(Request $request){
        $em = $this->getDoctrine()->getManager();
        
        $name = $request->get('name', null);
        $price = $request->get('precio', null);

        $product = new \App\Entity\Products();

        $product->setName($name);
        $product->setPrecio($price);
        $product->setStatus(1);
        
        $em->persist($product);
        $em->flush();

        $data = [
            'status' => 200,
            'message' => 'Se ha creado correctamente'
        ];

        return new JsonResponse($data);
    }

    public function update(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('UPDATE App:Products p SET p.name = :name, p.precio = :precio WHERE p.idproduct = :id');
        
        $name = $request->get('name', null);
        $price = $request->get('precio', null);

        $query->setParameter(':name', $name);
        $query->setParameter(':precio', $price);
        $query->setParameter(':id', $id);
        $flag = $query->getResult();
        
        if($flag == 1){
            $data = ['status' => 200, 'message' => 'Producto actualizado'];
        }else{
            $data = ['status' => 400, 'message' => 'Error de actualización'];
        }

        return new JsonResponse($data);
    }

    public function delete($id){
        $em = $this->getDoctrine()->getManager();
        
        $query = $em->createQuery('UPDATE App:Products SET p.status = 0 WHERE p.idproduct = :id');
        $query->setParameter(':id', $id);
        $product = $query->getResult();

        $data = [
            'status' => 200,
            'message' => 'Se se deshabilitó el producto',
            'product' => $product
        ];

        return new JsonResponse($data);
    }
}
