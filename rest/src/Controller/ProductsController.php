<?php

namespace App\Controller;

header('Access-Control-Allow-Origin: *');

use Doctrine\DBAL\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

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
}
