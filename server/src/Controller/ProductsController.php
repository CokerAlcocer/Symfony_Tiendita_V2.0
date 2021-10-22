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
        $product = $em->getRepository('App:Products')->findOneBy(['idproduct' => $id]);

        $data = [
            'status' => 200,
            'message' => 'Se encontró el producto',
            'product' => $product
        ];

        return new JsonResponse($data);
    }

    public function create(Request $request){
        $em = $this->getDoctrine()->getManager();
        $json = $request->get('data', null);
        $params = json_decode($json);

        if($params != null){
            $product = new \App\Entity\Products();

            $product->setName($params->name);
            $product->setName($params->precio);
            $product->setStatus(1);
            $em->persist($product);
            $em->flush();
    
            $data = [
                'status' => 200,
                'message' => 'Se ha creado correctamente',
                'product' => $product
            ];
        }else{
            $data = [
                'status' => 404,
                'message' => 'No se ha encontrado correctamente'
            ];
        }

        return new JsonResponse($data);
    }

    public function delete($id){
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('App:Products')->findOneBy(['idproduct' => $id]);

        // BAJA LÓGICA
        $product->setStatus(0);
        $em->presist($product);
        $em->flush();

        $data = [
            'status' => 200,
            'message' => 'Se ha eliminado correctamente',
            'product' => $product
        ];

        return new JsonResponse($data);
    }
}
